<?php

namespace TypiCMS\Modules\Cardcoverblocks\Models;

use Dimsav\Translatable\Translatable;
use Laracasts\Presenter\PresentableTrait;
use TypiCMS\Modules\Core\Models\Base;
use TypiCMS\Modules\History\Traits\Historable;

class Cardcoverblock extends Base {
    use Historable;
    use PresentableTrait;
    use Translatable;

    protected $presenter = 'TypiCMS\Modules\Cardcoverblocks\Presenters\ModulePresenter';
    
    /**
     * Declare any properties that should be hidden from JSON Serialization.
     *
     * @var array
     */
    protected $hidden = [];

    protected $fillable = [
        'image',
        // Translatable columns
        'title',
        'slug',
        'status',
        'card_title',
        'button_title',
        'button_link',
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
        'card_title',
        'button_title',
        'button_link',
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
    ];

    public function getImageUrl() {
        if($this->image){
            return env('COVER_CARD_IMAGE_UPLOAD_PATH') . $this->image;
        }
        return '';
    }
}
