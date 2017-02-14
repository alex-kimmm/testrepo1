<?php
namespace App\Services;

use Illuminate\Support\Facades\Mail;

class MailService {

    public static $ZUGARZNAP_ADMIN_EMAIL = "no-reply@zugar-znap.com";

    public static function sendMailWhenUserAddClaim($to_user, $data) {
        $subject = $data['subject'];
        $content_message = $data['body'];

        Mail::queue('vendor.users.emails.user_add_claim', ['to_user' => $to_user, 'content_message' => $content_message], function ($m) use ($to_user, $subject) {
            $m->from(self::$ZUGARZNAP_ADMIN_EMAIL, 'Zugar Znap');
            $m->to($to_user->email, $to_user->last_name . $to_user->first_name)->subject($subject);
        });
    }

    public static function sendMailUserCheckout($to_user, $data) {
        $subject = $data['subject'];
        $content_message = $data['body'];

        Mail::queue('vendor.users.emails.user_order_checkout', ['to_user' => $to_user, 'content_message' => $content_message], function ($m) use ($to_user, $subject) {
            $m->from(self::$ZUGARZNAP_ADMIN_EMAIL, 'Zugar Znap');
            $m->to($to_user->email, $to_user->last_name . $to_user->first_name)->subject($subject);
        });
    }

    public static function sendMailUserOrder($to_user, $data) {
        $subject = $data['subject'];

        Mail::send('vendor.users.emails.order_acknowledgment', ['to_user' => $to_user, 'order' => $data['order']], function ($m) use ($to_user, $subject) {
            $m->from(self::$ZUGARZNAP_ADMIN_EMAIL, 'Zugar Znap');
            $m->to($to_user->email, $to_user->first_name)->subject($subject);
        });
    }

    public static function sendMailUserOrderDocs($to_user, $data) {
        $subject = $data['subject'];

        Mail::send('vendor.users.emails.insurance.policy_documents', ['user' => $to_user], function ($m) use ($to_user, $subject, $data) {
            $m->from(self::$ZUGARZNAP_ADMIN_EMAIL, 'Zugar Znap');
            $m->to($to_user->email, $to_user->first_name)->subject($subject);
            $m->attach($data['pdf_documents']->policySummaryFileRef, ['as' => 'Key facts', 'mime' => 'application/pdf']);
            $m->attach($data['pdf_documents']->policyFileRef, ['as' => 'Policy wording', 'mime' => 'application/pdf']);
            $m->attach($data['pdf_documents']->download_certificate_url, ['as' => 'Certificate', 'mime' => 'application/pdf']);
        });
    }

    public static function sendMailUserOrderInsuranceInfo($to_user, $insurance_type, $order) {

        if($insurance_type == CATEGORY_GADGET_INSURANCE) {
            $subject = "You ZugarZnap Gadget Cover";
            $view = 'vendor.users.emails.insurance.info_gadget_cover';
        }
        else if($insurance_type == CATEGORY_XS_COVER) {
            $subject = "XS Cover";
            $view = 'vendor.users.emails.insurance.info_xs_cover';
        }
        else {
            return;
        }

        Mail::send($view, ['to_user' => $to_user, 'subject' => $subject, 'order' => $order], function ($m) use ($to_user, $subject) {
            $m->from(self::$ZUGARZNAP_ADMIN_EMAIL, 'Zugar Znap');
            $m->to($to_user->email, $to_user->first_name)->subject($subject);
        });
    }

    public static function sendMailActivation($view, $user, $subject){
        Mail::send($view, ['user' => $user, 'subject' => $subject], function ($m) use ($user, $subject) {
            $m->from(self::$ZUGARZNAP_ADMIN_EMAIL, 'Zugar Znap');
            $m->to($user->email, $user->first_name)->subject($subject);
        });
    }

}
