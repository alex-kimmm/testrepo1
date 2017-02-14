<?php

namespace TypiCMS\Modules\Users\Http\Controllers;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Mail\Message;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Users\Http\Requests\FormRequestEmail;
use TypiCMS\Modules\Users\Http\Requests\FormRequestPassword;
use TypiCMS\Modules\Users\Repositories\UserInterface;

class PasswordController extends Controller
{
    protected $userRepository;
    /**
     * Create a new password controller instance.
     *
     * @param \Illuminate\Contracts\Auth\Guard          $auth
     * @param \Illuminate\Contracts\Auth\PasswordBroker $passwords
     *
     * @return void
     */
    public function __construct(Guard $auth, PasswordBroker $passwords, UserInterface $user)
    {
        $this->auth = $auth;
        $this->passwords = $passwords;
        $this->userRepository = $user;

        $this->middleware('guest');
    }

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Support\Facades\Response
     */
    public function getEmail()
    {
        return view('users::password');
    }

    /**
     * Send a reset link to the given user.
     *
     * @param FormRequestEmail $request
     *
     * @return \Illuminate\Support\Facades\Response
     */
    public function postEmail(FormRequestEmail $request)
    {
        if($this->userRepository->isOauthUser($request->only('email')))
            return redirect()->back()->withErrors(['email' => trans('passwords.user')]);

        $response = $this->passwords->sendResetLink($request->only('email'), function (Message $message) {
            $subject = 'ZugarZnap '.trans('users::global.Your Password Reset Link');
            $message->subject($subject);
        });

        switch ($response) {
            case PasswordBroker::RESET_LINK_SENT:
                return redirect()->back()->with('success', trans($response));

            case PasswordBroker::INVALID_USER:
                return redirect()->back()->withErrors(['email' => trans($response)]);
        }
    }

    /**
     * Display the password reset view for the given token.
     *
     * @param string $token
     *
     * @return \Illuminate\Support\Facades\Response
     */
    public function getReset($token = null)
    {
        if (is_null($token)) {
            throw new NotFoundHttpException();
        }

        $existToken = DB::table( config('auth.passwords.users.table'))->where('token', $token)->count();
        $existToken = ($existToken > 0)? true : false;

        if(!$existToken){
            abort('404');
        }

        return view('users::reset')->with(compact('token'));
    }

    /**
     * Reset the given user's password.
     *
     * @param FormRequestPassword $request
     *
     * @return \Illuminate\Support\Facades\Response
     */
    public function postReset(FormRequestPassword $request)
    {
        $credentials = $request->only(
            'password', 'password_confirmation', 'token'
        );

        $passReset = DB::table( config('auth.passwords.users.table'))->where('token', $request->get('token'))->first();

        if(is_null($passReset) || empty($passReset->email) || is_null($passReset->email)){
            abort('404');
        }

        $credentials['email'] = $passReset->email;

        $response = $this->passwords->reset($credentials, function ($user, $password) {
            $user->password = bcrypt($password);

            $user->save();
        });

        switch ($response) {
            case PasswordBroker::PASSWORD_RESET:
                return redirect(route('login'))->with('success', 'You have successfully reset your password.');

            default:
                return redirect()->back()
                            ->withInput($request->only('email'))
                            ->withErrors(['email' => trans($response)]);
        }
    }
}
