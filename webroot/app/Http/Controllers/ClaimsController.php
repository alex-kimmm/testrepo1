<?php

namespace App\Http\Controllers;

use App\Http\IWEPApiController;
use TypiCMS\Modules\Claims\Models\ClaimTranslation;
use Validator;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Mail\Message;

use TypiCMS\Modules\Claims\Models\Claim;
use TypiCMS\Modules\Claims\Repositories\ClaimInterface;
use TypiCMS\Modules\Claims\Repositories\ClaimGadgetInterface;
use TypiCMS\Modules\Products\Repositories\ProductInterface;
use TypiCMS\Modules\Settings\Repositories\SettingInterface;

class ClaimsController extends Controller {

    public function __construct(ClaimInterface $claimRepository,
                                ClaimGadgetInterface $claimGadgetInterface,
                                ProductInterface $productRepository,
                                SettingInterface $settingInterface) {
        $this->middleware('auth');
        $this->claimRepository = $claimRepository;
        $this->claimGadgetInterface = $claimGadgetInterface;
        $this->productRepository = $productRepository;
        $this->settingInterface = $settingInterface;
    }

    public function getCreate($quoteId){
        $claimGadgets = $this->claimGadgetInterface->claimGadgetsGroupBy('category');
        $reasons = Claim::$reasons;

        //Get random policy
        $IWEPApiController = IWEPApiController::getInstance();

        $authUser = Auth::user();

        //Check if policy exist, and it belongs to current user
        $currentPolicy = null;
        try {
            $currentPolicy = $IWEPApiController->getPolicy($quoteId);
        } catch (\Exception $e){}

        if ( is_null($currentPolicy) ||
            (isset($currentPolicy->is_expired) && $currentPolicy->is_expired) ||
            (isset($currentPolicy->holder_id) && $currentPolicy->holder_id != $authUser->id)
        ) abort(404);

        $validFileExtensions = Claim::$claim_rules_valid_files_extensions;

        return view('frontend_zz.claims.create', compact('quoteId', 'claimGadgets', 'reasons', 'validFileExtensions', 'authUser'));
    }

    public function getSuccess(){
        return view('frontend_zz.claims.success_created');
    }

    public function postCreate(Mailer $mailer) {
        $user = Auth::user();
        $data = Input::except(['_method', '_token', '_url']);
        $quoteId = $data['quote_id'];

        //Check if policy exist, and it belongs to current user
        $currentPolicy = null;
        try {
            $IWEPApiController = IWEPApiController::getInstance();
            $currentPolicy = $IWEPApiController->getPolicy($quoteId);
        } catch (\Exception $e){}

        if ( is_null($currentPolicy) ||
            (isset($currentPolicy->is_expired) && $currentPolicy->is_expired) ||
            (isset($currentPolicy->holder_id) && $currentPolicy->holder_id != $user->id)
        ) {
            return redirect()->back()->withInput()->withErrors(['Not policy found']);
        }

        $validator = Validator::make($data, Claim::claim_rules());
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $data['user_id'] = $user->id; // created by

        $data['title'] = substr($data['description'], 0, 32);
        $data['summary'] = $data['description'];
        $data['body'] = $data['description'];

        $claim = $this->claimRepository->create($data);

        if(Input::file('files')) {
            $allFiles = Input::file('files');

            try {
                foreach($allFiles as $file){
                    $this->uploadFile((env('CLAIM_FILE_UPLOAD_PATH') . $claim->id), $file);
                }
            } catch(\Exception $exception) {
                return redirect()->back()->with('fail', $exception->getMessage());
            }
        }

        // send email
        $settings = $this->settingInterface->allToArray();
        $subject = 'ZugarZnap Claim Acknowledgement';
        $mailer->queue('users::emails.claim_acknowledgement',compact('user'), function (Message $message) use ($user,$subject) {
            $message->to($user->email)->subject($subject);
        });

        $subject = 'User added a claim';
        $mailer->queue('users::emails.user_added_claim',compact('user','data','claim'), function (Message $message) use ($user,$subject,$settings) {
            $message->to($settings['webmaster_email'])->subject($subject);
        });

        return redirect('/claims/success');
    }

}
