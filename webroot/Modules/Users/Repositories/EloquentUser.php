<?php

namespace TypiCMS\Modules\Users\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Facades\Request;
use TypiCMS\Modules\Core\Repositories\RepositoriesAbstract;
use Illuminate\Database\Eloquent\Model;

class EloquentUser extends RepositoriesAbstract implements UserInterface
{
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Create a new model.
     *
     * @param array $data
     *
     * @return mixed Model or false on error during save
     */
    public function create(array $data)
    {
        $model = $this->model;

        $userData = array_except($data, ['_method', '_token', 'id', 'exit', 'groups', 'password_confirmation']);
        $userData['password'] = bcrypt($data['password']);

        foreach ($userData as $key => $value) {
            $model->$key = $value;
        }

        if ($model->save()) {
            $this->syncGroups($model, $data);

            return $model;
        }

        return false;
    }

    /**
     * Update an existing model.
     *
     * @param array $data
     *
     * @return bool
     */
    public function update(array $data)
    {
        $user = $this->model->find($data['id']);

        $userData = array_except($data, ['_method', '_token', 'exit', 'groups', 'password_confirmation']);

        if (!$userData['password']) {
            $userData = array_except($userData, 'password');
        } else {
            $userData['password'] = bcrypt($data['password']);
        }

        foreach ($userData as $key => $value) {
            $user->$key = $value;
        }

        $this->syncGroups($user, $data);

        if ($user->save()) {
            return true;
        }

        return false;
    }

    /**
     * Find user by token.
     *
     * @param string $key
     * @param string $value
     * @param array  $with
     */
    public function byToken($token)
    {
        return $this->model->where('token', $token)
                            ->where('token_created_at', '>=',
                                Carbon::now()->subHours(config('auth.providers.users.confirmation_token_expire_hours')))
                            ->first();
    }

    /**
     * Sync groups.
     *
     * @param Model $user
     * @param array $groups
     *
     * @return void
     */
    private function syncGroups($user, $data)
    {
        if (!isset($data['groups'])) {
            return;
        }
        $array = [];
        foreach ($data['groups'] as $id => $value) {
            if ($value) {
                $array[] = $id;
            }
        }
        $user->groups()->sync($array);
    }

    /**
     * Update current user preferences.
     *
     * @return mixed
     */
    public function updatePreferences(array $data)
    {
        $user = Request::user();
        $user->preferences = array_merge((array) $user->preferences, $data);
        $user->save();
    }

    /**
     * Current user has access ?
     *
     * @param string|array $permissions
     *
     * @return bool
     */
    public function hasAccess($permissions)
    {
        if ($user = Request::user()) {
            return $user->hasAccess($permissions);
        }

        return false;
    }

    /**
     * @param $fieldName
     * @param $value
     * @return mixed
     */
    public function findOneBy($fieldName, $value) {
        return $this->model->where($fieldName, $value)->first();
    }

    /**
     * @param $email
     * @return mixed
     */
    public function getOauthUser($email){
        return $this->model
                        ->where('email',$email)
                        ->where('oauth_id','<>', '')
                        ->where('oauth_service','<>','')
                        ->first();
    }

    public function isOauthUser($email){
        return $this->getOauthUser($email) != null ? true : false;
    }

}
