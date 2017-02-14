<?php

namespace TypiCMS\Modules\Users\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Mail\Message;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Users\Http\Requests\FormRequestEmail;
use TypiCMS\Modules\Users\Http\Requests\FormRequestRegister;
use TypiCMS\Modules\Users\Models\User;
use TypiCMS\Modules\Users\Repositories\UserInterface;
use App\Services\MailService;

class RegistrationController extends Controller
{
    protected $repository;

    /**
     * Create a new registration controller instance.
     *
     * @return void
     */
    public function __construct(UserInterface $user)
    {
        $this->repository = $user;

        $this->middleware('guest');
        $this->middleware('registrationAllowed');
    }

    /**
     * Show the register page.
     *
     * @return \Response
     */
    public function getRegister()
    {
        return view('users::register');
    }

    /**
     * Perform the registration.
     *
     * @param FormRequestRegister $request
     * @param Mailer              $mailer
     *
     * @return \Redirect
     */
    public function postRegister(FormRequestRegister $request, Mailer $mailer)
    {
        try {
            $user = $this->repository->create($request->except(['_url', '_token']));
        } catch (\Exception $e){
            return redirect()
                ->back()
                ->with('fail', trans('users::global.Error creating account, please try again later'));
        }

        $subject = 'ZugarZnap '.trans('users::global.Welcome');
        $view = 'vendor.users.emails.welcome';
        MailService::sendMailActivation($view, $user, $subject);

        return redirect()
            ->back()
            ->with('success', trans('users::global.Your account has been created, check your email for the confirmation link'));
    }

    /**
     * Show the application login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getResendConfirmationEmail()
    {
        return view('users::confirmationemail');
    }

    /**
     * Perform resend email activation.
     *
     * @param FormRequestRegister $request
     * @param Mailer              $mailer
     *
     * @return \Redirect
     */
    public function postResendConfirmationEmail(FormRequestEmail $request, Mailer $mailer){
        $email = $request->input('email');

        /* @param User $request */
        $user = User::where('email',$email)
            ->where('oauth_id','')
            ->where('oauth_service','')
            ->first();

        if(!$user){
            return redirect()
                ->back()
                ->with('fail', trans('users::global.Invalid user'));
        }

        if($user->isActivated()){
            return redirect()
                ->back()
                ->with('success', trans('users::global.User has been activated'));
        }

        $user->setNewActivationToken();
        $user->save();

        $subject = 'ZugarZnap '.trans('users::global.Activation');
        $view = 'vendor.users.emails.activation';
        MailService::sendMailActivation($view, $user, $subject);

        return redirect()
            ->route('login')
            ->with('success', trans('users::global.Check your email for the activation link'));
    }

    /**
     * Confirm a user’s email address.
     *
     * @param string $token
     *
     * @return mixed
     */
    public function confirmEmail($token)
    {
        $user = $this->repository->byToken($token);

        if (!$user) {
            abort(404);
        }

        $user->confirmEmail();

        Auth::loginUsingId($user->id);

        return redirect()->intended(route('profile.account.get'))->with('success', 'You have successfully signed in.');
    }
}
