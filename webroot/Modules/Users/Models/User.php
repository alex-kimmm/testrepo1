<?php

namespace TypiCMS\Modules\Users\Models;

use Carbon\Carbon;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Laracasts\Presenter\PresentableTrait;
use TypiCMS\Modules\Core\Models\Base;
use TypiCMS\Modules\History\Traits\Historable;

class User extends Base implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    use Authenticatable;
    use Authorizable;
    use CanResetPassword;
    use Historable;
    use PresentableTrait;

    protected $presenter = 'TypiCMS\Modules\Users\Presenters\ModulePresenter';

    public static $profile_rules = [
        'first_name'   => 'required|max:255',
        'last_name'    => 'required|max:255'
    ];

    public static $profile_password_rules = [
        'old_password'	        => 'required|min:8',
        'password' 		        => 'required|min:8|different:old_password',
        'password_confirmation' => 'required|same:password'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'oauth_id',
        'oauth_service',
        'first_name',
        'last_name',
        'gender',
        'password',
        'permissions',
        'preferences',
        'usertitle_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'permissions' => 'array',
        'preferences' => 'array',
    ];

    /**
     * Get front office uri.
     *
     * @param string $locale
     *
     * @return string
     */
    public function uri($locale = null)
    {
        return '/';
    }

    /**
     * Returns an array of merged permissions for each group the user is in.
     *
     * @return array
     */
    public function getMergedPermissions()
    {
        if (!$this->mergedPermissions) {
            $permissions = [];
            foreach ($this->groups as $group) {
                $permissions = array_merge($permissions, (array) $group->permissions);
            }
            $this->mergedPermissions = array_merge($permissions, (array) $this->permissions);
        }

        return $this->mergedPermissions;
    }

    /**
     * See if a user has access to the passed permission(s).
     *
     * @param string|array $permissions
     *
     * @return bool
     */
    public function hasAccess($permissions)
    {
        if ($this->superuser) {
            return true;
        }

        return $this->hasPermission($permissions);
    }

    /**
     * See if a user has access to the passed permission(s).
     *
     * @param string|array $permissions
     *
     * @return bool
     */
    public function hasPermission($permissions)
    {
        $mergedPermissions = $this->getMergedPermissions();
        if (!is_array($permissions)) {
            $permissions = (array) $permissions;
        }
        foreach ($permissions as $permission) {
            $matched = false;
            foreach ($mergedPermissions as $mergedPermission => $value) {
                if ($permission == $mergedPermission and $mergedPermissions[$permission] == 1) {
                    $matched = true;
                    break;
                }
            }
            if ($matched === false) {
                return false;
            }
        }

        return true;
    }

    /**
     * Is the user in group ?
     *
     * @param [type] $group [description]
     *
     * @return [type] [description]
     */
    public function hasRole($group)
    {
        if ($this->superuser) {
            return true;
        }

        return in_array($group, $this->groups->pluck('name')->all());
    }

    /**
     * Confirm the user.
     *
     * @return void
     */
    public function confirmEmail()
    {
        $this->activated = true;
        $this->token = null;
        $this->token_created_at = null;
        $this->save();
    }

    public function isActivated(){
        return $this->activated;
    }

    /**
     * Boot the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();
        static::creating(function ($user) {
            $user->setNewActivationToken();
        });
    }

    public function setNewActivationToken(){
        $this->token = str_random(30);
        $this->token_created_at = Carbon::now();
    }

    /**
     * One user has many groups.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function groups()
    {
        return $this->belongsToMany('TypiCMS\Modules\Groups\Models\Group');
    }

    public function userTitle() {
        return $this->belongsTo('TypiCMS\Modules\Usertitles\Models\Usertitle','usertitle_id','id');
    }

}
