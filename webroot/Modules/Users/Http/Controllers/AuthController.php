<?php

namespace TypiCMS\Modules\Users\Http\Controllers;

use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Laravel\Socialite\Facades\Socialite;
use TypiCMS\Modules\Users\Http\Requests\FormRequestLogin;
use TypiCMS\Modules\Users\Models\User;
use TypiCMS\Modules\Usertitles\Models\Usertitle;

class AuthController extends Controller
{

    const OAUTH_FACEBOOK = 'facebook';

    use ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Show the application login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {
        return view('users::login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param FormRequestLogin $request
     *
     * @return \Illuminate\Http\Response
     */
    public function postLogin(FormRequestLogin $request)
    {
        if ($this->hasTooManyLoginAttempts($request)) {
            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->getCredentials($request);

        if (Auth::attempt($credentials, $request->has('remember'))) {
            return $this->handleUserWasAuthenticated($request);
        }

        $this->incrementLoginAttempts($request);

        $user = User::where('email', $credentials['email'])->first();
        if (!$user) {
            $message = trans('users::global.The username or password you entered is incorrect.');
            return redirect()
                ->route('login')
                ->withInput($request->only('email', 'remember'))
                ->withErrors([
                    'email' => $message,
                ]);
        } elseif (!$user->activated) {
            $message = trans('users::global.User not activated');
        } else {
            $message = trans('users::global.Wrong password, try again');
        }

        return redirect()
            ->route('login')
            ->with('auth_user_activated',$user->activated)
            ->withInput($request->only('email', 'remember'))
            ->withErrors([
                'email' => $message,
            ]);
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param \Illuminate\Http\Request $request
     * @param bool                     $throttles
     *
     * @return \Illuminate\Http\Response
     */
    protected function handleUserWasAuthenticated(Request $request)
    {
        $this->clearLoginAttempts($request);

        if (method_exists($this, 'authenticated')) {
            return $this->authenticated($request, Auth::user());
        }

        return redirect()->intended(route('profile.account.get'))->with('success', 'You have successfully signed in.');
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogout()
    {
        Auth::logout();

        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/')->with('success', 'You have successfully signed out.');
    }

    /**
     * Get the login credentials and requirements.
     *
     * @param Request $request
     *
     * @return array
     */
    protected function getCredentials(Request $request)
    {
        return [
            'email'     => $request->input('email'),
            'password'  => $request->input('password'),
            'activated' => 1,
        ];
    }

    /**
     * Get the path to the login route.
     *
     * @return string
     */
    public function loginPath()
    {
        return property_exists($this, 'loginPath') ? $this->loginPath : '/auth/login';
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function loginUsername()
    {
        return property_exists($this, 'username') ? $this->username : 'email';
    }


    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        if(Input::has('error') && Input::get('error') != "")
            return Redirect::to('auth/login');

        try {
            $user = Socialite::driver('facebook')->user();
        } catch (Exception $e) {
            return Redirect::to('auth/facebook');
        }

        $authUser = $this->findOrCreateUser($user, self::OAUTH_FACEBOOK);

        Auth::login($authUser, true);

        return redirect()->intended(route('profile.account.get'))->with('success', 'You have successfully signed in.');
    }

    /**
     * Return user if exists; create and return if doesn't
     *
     * @param $facebookUser
     * @return User
     */
    private function findOrCreateUser($facebookUser, $oauth_service)
    {
        $facebookUserEmail = mb_strtolower(trim($facebookUser->email));
        if ($byEmailUser = User::where('email', $facebookUserEmail)->first()) {
            return $byEmailUser;
        }

        if ($authUser = User::where('oauth_id', $facebookUser->id)->where('oauth_service',$oauth_service)->first()) {
            return $authUser;
        }

        $names = explode(' ', $facebookUser->name);
        $f_name = isset($names[0]) ? $names[0] : $facebookUser->name;
        $l_name = isset($names[1]) ? $names[1] : '';

        $user_data = [
            'first_name' => $f_name,
            'last_name' => $l_name,
            'email' => $facebookUserEmail,
            'oauth_id' => $facebookUser->id,
            'oauth_service' => $oauth_service,
            'gender' => isset($facebookUser->getRaw()['gender']) ? $facebookUser->getRaw()['gender'] : "",
        ];

        $user_titles = Usertitle::whereIn('id', [1, 2, 4])->get();

        if(count($user_titles) == 3) {
            $user_data['usertitle_id'] = ($user_data['gender'] == 'male') ? 2 : (($user_data['gender'] == 'female') ? 4 : 1);
        }

        $user = User::create($user_data);

        return $user;
    }

}
