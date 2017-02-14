<?php

namespace TypiCMS\Modules\Homepageblocks\Models;

use Dimsav\Translatable\Translatable;
use Laracasts\Presenter\PresentableTrait;
use TypiCMS\Modules\Core\Models\Base;
use TypiCMS\Modules\History\Traits\Historable;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Homepageblock extends Base {
    use Historable;
    use PresentableTrait;
    use Translatable;

    protected $presenter = 'TypiCMS\Modules\Homepageblocks\Presenters\ModulePresenter';
    
    /**
     * Declare any properties that should be hidden from JSON Serialization.
     *
     * @var array
     */
    protected $hidden = [];

    protected $fillable = [
        'image',
        'block_background_image',
        // Translatable columns
        'title',
        'subtitle',
        'slug',
        'status',
        'position',
        'benefits_url',
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
        'position',
        'benefits_url',
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
        'block_background_image'
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
            return env('HOME_PAGE_BLOCKS_IMAGE_UPLOAD_PATH') . $this->image;
        }
        return '';
    }

    /**
     * @return string
     */
    public function getBlockBackgroundImageUrl() {
        if($this->block_background_image){
            return env('HOME_PAGE_BLOCKS_IMAGE_UPLOAD_PATH') . $this->block_background_image;
        }
        return '';
    }
}
