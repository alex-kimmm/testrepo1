<?php

namespace TypiCMS\Modules\Insurancepages\Models;

use Dimsav\Translatable\Translatable;
use Laracasts\Presenter\PresentableTrait;
use TypiCMS\Modules\Core\Models\Base;
use TypiCMS\Modules\History\Traits\Historable;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Insurancepage extends Base {

    use Historable;
    use PresentableTrait;
    use Translatable;

    protected $presenter = 'TypiCMS\Modules\Insurancepages\Presenters\ModulePresenter';
    
    /**
     * Declare any properties that should be hidden from JSON Serialization.
     *
     * @var array
     */
    protected $hidden = [];

    protected $fillable = [
        'image',
        'video',
        'step',
        'category_id',
        'gradient_id',
        // Translatable columns
        'title',
        'subtitle',
        'menu_title',
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
        'menu_title',
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

    public static $steps = [
        '1' => '1',
        '2' => '2',
        '3' => '3'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category() {
        return $this->belongsTo('TypiCMS\Modules\Categories\Models\Category');
    }

    /**
     * @return string
     */
    public function getImageUrl() {
        if($this->image){
            return env('INSURANCE_PAGES_IMAGE_VIDEO_UPLOAD_PATH')  . $this->image;
        }
        return '';
    }

    /**
     * @return string
     */
    public function getVideoUrl() {

        if($this->video){
            return env('INSURANCE_PAGES_IMAGE_VIDEO_UPLOAD_PATH')  . $this->video;
        }
        return '';
    }

    public function blocks() {
        return $this->hasMany('TypiCMS\Modules\Insuranceblocks\Models\Insuranceblock', 'insurancepage_id')->online();
    }

    public function scopeStep($query, $step) {
        return $query->where('step', $step);
    }

    public function gradient() {
        return $this->belongsTo('TypiCMS\Modules\Gradients\Models\Gradient');
    }

    /**
     * A insurance page has many insuranceBlocks.
     *
     * @return MorphToMany
     */
    public function insuranceBlocks() {
        return $this->morphToMany('TypiCMS\Modules\Insuranceblocks\Models\Insuranceblock', 'insurancepages_insuranceblock', 'insurancepages_insuranceblocks', 'insurancepage_id', 'insuranceblock_id')
            ->withPivot('insuranceblock_id')
            ->orderBy('position')
            ->withTimestamps();
    }

    /**
     * A insurance page has many cards.
     *
     * @return MorphToMany
     */
    public function cards() {
        return $this->morphToMany('TypiCMS\Modules\Cards\Models\Card', 'insurancepages_card', 'insurancepages_cards', 'insurancepage_id', 'card_id')
            ->withPivot('card_id')
            ->orderBy('position')
            ->withTimestamps();
    }
}
