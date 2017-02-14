<?php

namespace TypiCMS\Modules\Cards\Models;

use Dimsav\Translatable\Translatable;
use Laracasts\Presenter\PresentableTrait;
use TypiCMS\Modules\Core\Models\Base;
use TypiCMS\Modules\History\Traits\Historable;

class Card extends Base
{
    use Historable;
    use PresentableTrait;
    use Translatable;

    protected $presenter = 'TypiCMS\Modules\Cards\Presenters\ModulePresenter';
    
    /**
     * Declare any properties that should be hidden from JSON Serialization.
     *
     * @var array
     */
    protected $hidden = [];

    protected $fillable = [
        'image',
        'gradient_id',
        // Translatable columns
        'redirect_link',
        'open_link_new_tab',
        'title',
        'title_background_color',
        'tag',
        'slug',
        'status',
        'summary',
    ];

    /**
     * Translatable model configs.
     *
     * @var array
     */
    public $translatedAttributes = [
        'redirect_link',
        'open_link_new_tab',
        'title',
        'title_background_color',
        'tag',
        'slug',
        'status',
        'summary',
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

    public function gradient() {
        return $this->belongsTo('TypiCMS\Modules\Gradients\Models\Gradient');
    }

    public function getImageUrl() {
        if($this->image){
            return env('CARD_IMAGE_UPLOAD_PATH') . $this->image;
        }
        return '';
    }
}
