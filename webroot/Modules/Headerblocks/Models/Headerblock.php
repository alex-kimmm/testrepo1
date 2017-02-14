<?php

namespace TypiCMS\Modules\Headerblocks\Models;

use Dimsav\Translatable\Translatable;
use Laracasts\Presenter\PresentableTrait;
use TypiCMS\Modules\Core\Models\Base;
use TypiCMS\Modules\History\Traits\Historable;

class Headerblock extends Base {
    use Historable;
    use PresentableTrait;
    use Translatable;

    protected $presenter = 'TypiCMS\Modules\Headerblocks\Presenters\ModulePresenter';
    
    /**
     * Declare any properties that should be hidden from JSON Serialization.
     *
     * @var array
     */
    protected $hidden = [];

    protected $fillable = [
        'image',
        'image_mobile',
        'video',
        'gradient_id',
        // Translatable columns
        'title',
        'slug',
        'auto_play',
        'quote_text',
        'quote_subtext',
        'position',
        'status',
        'summary',
        'body'
    ];

    /**
     * Translatable model configs.
     *
     * @var array
     */
    public $translatedAttributes = [
        'title',
        'slug',
        'auto_play',
        'quote_text',
        'quote_subtext',
        'position',
        'status',
        'summary',
        'body'
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
        'video'
    ];

    public $POSITIONS = [
        'left'  => 'Left',
        'right' => 'Right',
    ];

    /**
     * @return string
     */
    public function getImageUrl() {
        if($this->image){
            return env('HEADER_BLOCKS_IMAGE_VIDEO_UPLOAD_PATH') . $this->image;
        }
        return '';
    }

    public function getImageMobileUrl(){
        if($this->image_mobile){
            return env('HEADER_BLOCKS_IMAGE_VIDEO_UPLOAD_PATH') . $this->image_mobile;
        }
        return '';
    }

    /**
     * @return string
     */
    public function getVideoUrl() {
        if($this->video){
            return env('HEADER_BLOCKS_IMAGE_VIDEO_UPLOAD_PATH') . $this->video;
        }
        return '';
    }

    public function gradient() {
        return $this->belongsTo('TypiCMS\Modules\Gradients\Models\Gradient','gradient_id');
    }
}
