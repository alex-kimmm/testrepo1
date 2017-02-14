<?php

namespace TypiCMS\Modules\Faceofzzlandings\Models;

use Dimsav\Translatable\Translatable;
use Laracasts\Presenter\PresentableTrait;
use TypiCMS\Modules\Core\Models\Base;
use TypiCMS\Modules\History\Traits\Historable;

class Faceofzzlanding extends Base
{
    use Historable;
    use PresentableTrait;
    use Translatable;

    protected $presenter = 'TypiCMS\Modules\Faceofzzlandings\Presenters\ModulePresenter';
    
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

    protected $appends = ['status', 'title', 'thumb'];

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
    public function homePageBlocks() {
        return $this->morphToMany('TypiCMS\Modules\Homepageblocks\Models\Homepageblock', 'faceofzzlandings_homepageblock', 'faceofzzlandings_homepageblocks', 'faceofzzlanding_id', 'homepageblock_id')
            ->withPivot('homepageblock_id')
            ->orderBy('position')
            ->withTimestamps();
    }

    /**
     * A product has many cards.
     *
     * @return MorphToMany
     */
    public function cards() {
        return $this->morphToMany('TypiCMS\Modules\Cards\Models\Card', 'faceofzzlandings_card', 'faceofzzlandings_cards', 'faceofzzlanding_id', 'card_id')
            ->withPivot('card_id')
            ->orderBy('position')
            ->withTimestamps();
    }
}
