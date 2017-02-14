<?php

namespace TypiCMS\Modules\Insuranceblocks\Models;

use Dimsav\Translatable\Translatable;
use Laracasts\Presenter\PresentableTrait;
use TypiCMS\Modules\Core\Models\Base;
use TypiCMS\Modules\History\Traits\Historable;

class Insuranceblock extends Base
{
    use Historable;
    use PresentableTrait;
    use Translatable;

    protected $presenter = 'TypiCMS\Modules\Insuranceblocks\Presenters\ModulePresenter';
    
    /**
     * Declare any properties that should be hidden from JSON Serialization.
     *
     * @var array
     */
    protected $hidden = [];

    protected $fillable = [
        'image',
        'image_mobile',
        'first_logo',
        'second_logo',
        'third_logo',
        // Translatable columns
        'title',
        'slug',
        'status',
        'summary',
        'order',
        'in_menu',
        'menu_title',
        'button_title',
        'button_link',
        'title_hidden',
        'heading',
        'second_heading',
        'decor_heading',
        'position',
        'insurancepage_id',
        'first_logo_text',
        'first_logo_description',
        'second_logo_text',
        'second_logo_description',
        'third_logo_text',
        'third_logo_description',
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
        'in_menu',
        'menu_title',
        'button_title',
        'button_link',
        'title_hidden',
        'heading',
        'second_heading',
        'decor_heading',
        'position',
        'first_logo_text',
        'first_logo_description',
        'second_logo_text',
        'second_logo_description',
        'third_logo_text',
        'third_logo_description',
    ];

    protected $appends = ['status', 'title', 'thumb'];

    /**
     * Columns that are file.
     *
     * @var array
     */
    public $attachments = [
        'image',
        'image_mobile',
        'first_logo',
        'second_logo',
        'third_logo',
    ];

    public $POSITIONS = [
        'left'  => 'Left',
        'right' => 'Right',
    ];

    public function page() {
        return $this->belongsTo('TypiCMS\Modules\Insurancepages\Models\Insurancepage', 'insurancepage_id')->online();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function files() {
        return $this->hasMany('TypiCMS\Modules\Insuranceblocks\Models\InsuranceblockFile');
    }

    /**
     * @return string
     */
    public function getImageUrl(){
        if($this->image){
            return env('INSURANCE_BLOCKS_IMAGE_VIDEO_UPLOAD_PATH') . $this->image;
        }
        return '';
    }

    public function getImageMobileUrl(){
        if($this->image_mobile){
            return env('INSURANCE_BLOCKS_IMAGE_VIDEO_UPLOAD_PATH') . $this->image_mobile;
        }
        return '';
    }

    public function getFirstLogoImageUrl() {
        if($this->first_logo){
            return env('INSURANCE_BLOCKS_IMAGE_VIDEO_UPLOAD_PATH') . $this->first_logo;
        }
        return '';
    }

    public function getSecondLogoImageUrl() {
        if($this->second_logo){
            return env('INSURANCE_BLOCKS_IMAGE_VIDEO_UPLOAD_PATH') . $this->second_logo;
        }
        return '';
    }

    public function getThirdLogoImageUrl() {
        if($this->third_logo){
            return env('INSURANCE_BLOCKS_IMAGE_VIDEO_UPLOAD_PATH') . $this->third_logo;
        }
        return '';
    }
}
