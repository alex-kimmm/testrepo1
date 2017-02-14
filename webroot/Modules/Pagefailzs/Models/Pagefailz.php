<?php

namespace TypiCMS\Modules\Pagefailzs\Models;

use Dimsav\Translatable\Translatable;
use Laracasts\Presenter\PresentableTrait;
use TypiCMS\Modules\Core\Models\Base;
use TypiCMS\Modules\History\Traits\Historable;

class Pagefailz extends Base
{
    use Historable;
    use PresentableTrait;
    use Translatable;

    protected $presenter = 'TypiCMS\Modules\Pagefailzs\Presenters\ModulePresenter';
    
    /**
     * Declare any properties that should be hidden from JSON Serialization.
     *
     * @var array
     */
    protected $hidden = [];

    protected $fillable = [
        'header_block_id',
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

    protected $appends = ['status', 'title'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function headerBlock() {
        return $this->belongsTo('TypiCMS\Modules\Headerblocks\Models\Headerblock');
    }

    /**
     * A product has many homePageBlocks.
     *
     * @return MorphToMany
     */
    public function failzOptionsLeft() {
        return $this->morphToMany('TypiCMS\Modules\Failzs\Models\Failz', 'pagefailz_left_option', 'pagefailz_left_options', 'pagefailzs_id', 'failz_id')
            ->withPivot('failz_id')
            ->orderBy('position')
            ->withTimestamps();
    }

    public function failzOptionsRight() {
        return $this->morphToMany('TypiCMS\Modules\Failzs\Models\Failz', 'pagefailz_right_option', 'pagefailz_right_options', 'pagefailzs_id', 'failz_id')
            ->withPivot('failz_id')
            ->orderBy('position')
            ->withTimestamps();
    }

    /**
     * A product has many cards.
     *
     * @return MorphToMany
     */
    public function cards() {
        return $this->morphToMany('TypiCMS\Modules\Cards\Models\Card', 'pagefailz_card', 'pagefailz_cards', 'pagefailz_id', 'card_id')
            ->withPivot('card_id')
            ->orderBy('position')
            ->withTimestamps();
    }

}
