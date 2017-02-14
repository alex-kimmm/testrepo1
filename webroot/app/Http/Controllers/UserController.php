<?php

namespace App\Http\Controllers;

use App\Http\IWEPApiController;
use App\Services\MailService;
use Validator;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

use TypiCMS\Modules\Users\Models\User;
use TypiCMS\Modules\Claims\Models\Claim;
use TypiCMS\Modules\Users\Repositories\UserInterface;
use TypiCMS\Modules\Usertitles\Models\Usertitle;
use TypiCMS\Modules\Claims\Repositories\ClaimInterface;
use TypiCMS\Modules\Orders\Repositories\OrderInterface;
use TypiCMS\Modules\Products\Repositories\ProductInterface;

class UserController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @param UserInterface $userRepository
     * @param OrderInterface $orderRepository
     * @param ClaimInterface $claimRepository
     * @param ProductInterface $productRepository
     * @return \App\Http\Controllers\UserController
     */
    public function __construct(UserInterface $userRepository,
                                OrderInterface $orderRepository,
                                ClaimInterface $claimRepository,
                                ProductInterface $productRepository) {
        $this->middleware('auth');

        $this->userRepository = $userRepository;
        $this->orderRepository = $orderRepository;
        $this->claimRepository = $claimRepository;
        $this->productRepository = $productRepository;
    }

    public function getAccount(){
        $user = Auth::user();
        $isAuthWithOAuth = $this->userRepository->isOauthUser($user->email);
        $userTitles = Usertitle::$titles;

        return view('frontend_zz.users.account', compact('user', 'isAuthWithOAuth', 'userTitles'));
    }

    public function postAccount() {
        $data = Input::except(['_method', '_token', '_url']);

        $validator = Validator::make($data, User::$profile_rules);
        if($validator->fails()) {
            return redirect()->route('profile.account.update')->withErrors($validator)->withInput();
        }

        $user = $this->userRepository->findOneBy('id', Auth::user()->id);
        $user->usertitle_id  = $data['usertitle_id'];
        $user->first_name  = $data['first_name'];
        $user->last_name  = $data['last_name'];

        if(Input::get('old_password') != "" || Input::get('password') != "" || Input::get('password_confirmation') != "") {
            $pass_validator = Validator::make($data, User::$profile_password_rules);
            if($pass_validator->fails()) {
                return redirect()->route('profile.account.update')->withErrors($pass_validator)->withInput();
            }

            $old_password = $data['old_password'];
            $password 	  = $data['password'];

            if(Hash::check($old_password, $user->getAuthPassword())){
                $user->password = bcrypt($password);
            } else {
                return redirect()->route('profile.account.update')->with('fail', 'Entered Old password is incorrect')->withInput();
            }
        }

        $user->save();
        return redirect()->route('profile.account.update')->with('success', 'Your profile has been updated');
    }

    public function getOrdersView(){
        $user = Auth::user();
        $orders = $this->orderRepository->allBy('user_id', $user->id, [], true);

        return view('frontend_zz.users.my_orders', compact('user', 'orders'));
    }

    public function getOrderView($order_id){
        $user = Auth::user();

        $order = $this->orderRepository->byId($order_id);
        if($order->user_id != $user->id){
            abort(404);
        }
        return view('frontend_zz.users.order_view', compact('user', 'order'));
    }

    public function postCreateClaim() {
        $user = Auth::user();
        $data = Input::except(['_method', '_token', '_url']);

        $validator = Validator::make($data, Claim::claim_rules());
        if ($validator->fails()) {
            return redirect()->route('profile.orders.view')->withErrors($validator)->withInput();
        }

        $this->claimRepository->create($data);

        // send email to user
        $contentData['subject'] = 'Add claim';
        $contentData['body'] = 'Thank you for claim ...';
        MailService::sendMailWhenUserAddClaim($user, $contentData);

        return redirect()->route('profile.orders.view')->with('success', "The claim was posted");
    }

    public function getPolicies(){
        $IWEPApiController = IWEPApiController::getInstance();

        try {
            return view('frontend_zz.users.policies', [
                'policies' => $IWEPApiController->getAllPolicies(),
            ]);
        } catch (\Exception $e){
            return view('frontend_zz.users.policies', [
                'policies' => [],
            ]);
        }

    }
}
