<?php

namespace TypiCMS\Modules\Slideshowitems\Models;

use Dimsav\Translatable\Translatable;
use Laracasts\Presenter\PresentableTrait;
use TypiCMS\Modules\Core\Models\Base;
use TypiCMS\Modules\History\Traits\Historable;

class Slideshowitem extends Base
{
    use Historable;
    use PresentableTrait;
    use Translatable;

    protected $presenter = 'TypiCMS\Modules\Slideshowitems\Presenters\ModulePresenter';
    
    /**
     * Declare any properties that should be hidden from JSON Serialization.
     *
     * @var array
     */
    protected $hidden = [];

    protected $fillable = [
        'image',
        'video',
        'product_id',
        'page_id',
        // Translatable columns
        'title',
        'subtitle',
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
        'subtitle',
        'slug',
        'status',
        'summary',
        'body',
    ];

    protected $appends = ['status', 'title', 'thumb'];

    /**
     * Columns that are file.
     *
     * @var array
     */
    public $attachments = [
        'image',
        'video',
    ];

    public function product() {
        return $this->belongsTo('TypiCMS\Modules\Products\Models\Product');
    }

    public function page() {
        return $this->belongsTo('TypiCMS\Modules\Pages\Models\Page');
    }

    /**
     * @return string
     */
    public function getImageUrl() {
        if($this->image){
            return env('SLIDESHOWITEM_VIDEO_UPLOAD_PATH')  . $this->image;
        }
        return '';
    }

    /**
     * @return string
     */
    public function getVideoUrl() {

        if($this->video){
            return env('SLIDESHOWITEM_VIDEO_UPLOAD_PATH')  . $this->video;
        }
        return '';
    }
}
