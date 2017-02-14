<?php

namespace TypiCMS\Modules\Claims\Models;

use App\Libraries\ZZUtils;
use Dimsav\Translatable\Translatable;
use Laracasts\Presenter\PresentableTrait;
use TypiCMS\Modules\Core\Models\Base;
use TypiCMS\Modules\History\Traits\Historable;
use TypiCMS\Modules\Orders\Models\OrderPolicy;

class Claim extends Base
{
    use Historable;
    use PresentableTrait;
    use Translatable;

    protected $presenter = 'TypiCMS\Modules\Claims\Presenters\ModulePresenter';
    
    /**
     * Declare any properties that should be hidden from JSON Serialization.
     *
     * @var array
     */
    protected $hidden = [];

    private static $MAX_FILE_SIZE_IN_MB = 5;

    protected $fillable = [
        'user_id',
        'quote_id',
        'status_id',
        'was',
        'description',
        'name',
        'email',
        'contact_number',
        'claim_gadget_id',
        // Translatable columns
        'title',
        'slug',
        'status',
        'summary',
        'body',
    ];

    /**
     * Translatable model configs.
     *
     * @var array
     */
    public $translatedAttributes = [
        'title',
        'slug',
        'status',
        'summary',
        'body',
    ];

    protected $appends = ['status', 'title', 'thumb'];

    public static function claim_rules(){
        return [
            'quote_id' => 'required',
            'was' => 'required',
            'description' => 'required|min:5|max:5000',
            'files.*' => 'min:1|max:'. (ZZUtils::convertMB2KB(self::$MAX_FILE_SIZE_IN_MB)) .'|mimes:jpg,jpeg,bmp,png,pdf,doc',
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'contact_number' => 'required|max:255'
        ];
    }

    public static $claim_rules_valid_files_extensions = '.jpg, .jpeg, .bmp, .png, .pdf, .doc';

    public static $reasons = [
        '0' => '-- select a reason --',
        'lost' => 'lost',
        'stolen' => 'stolen',
        'damaged' => 'damaged'
    ];

    public function user() {
        return $this->belongsTo('TypiCMS\Modules\Users\Models\User');
    }

    public function gadget() {
        return $this->belongsTo('TypiCMS\Modules\Claims\Models\ClaimGadget', 'claim_gadget_id');
    }

    public function claimStatus() {
        return $this->belongsTo('TypiCMS\Modules\Claims\Models\ClaimStatus','status_id');
    }

    public function order(){
        $orderPolicy = OrderPolicy::where('policy_id',$this->quote_id)->first();
        if(!is_null($orderPolicy)){
            return $orderPolicy->order();
        }
        return null;
    }

}
