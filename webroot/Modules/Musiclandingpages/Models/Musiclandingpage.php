<?php
namespace TypiCMS\Modules\Musiclandingpages\Models;

use Dimsav\Translatable\Translatable;
use Laracasts\Presenter\PresentableTrait;
use TypiCMS\Modules\Core\Models\Base;
use TypiCMS\Modules\History\Traits\Historable;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Musiclandingpage extends Base {
    use Historable;
    use PresentableTrait;
    use Translatable;

    protected $presenter = 'TypiCMS\Modules\Musiclandingpages\Presenters\ModulePresenter';
    
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
    public function homePageBlocks() {
        return $this->morphToMany('TypiCMS\Modules\Homepageblocks\Models\Homepageblock', 'musiclandingpages_homepageblock', 'musiclandingpages_homepageblocks', 'musiclandingpage_id', 'homepageblock_id')
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
        return $this->morphToMany('TypiCMS\Modules\Cards\Models\Card', 'musiclandingpages_card', 'musiclandingpages_cards', 'musiclandingpage_id', 'card_id')
            ->withPivot('card_id')
            ->orderBy('position')
            ->withTimestamps();
    }

    /**
     * A product has many card.
     *
     * @return MorphToMany
     */
    public function cardCoverBlocks() {
        return $this->morphToMany('TypiCMS\Modules\Cardcoverblocks\Models\Cardcoverblock', 'musiclandingpages_cardcoverblock', 'musiclandingpages_cardcoverblocks', 'musiclandingpage_id', 'cardcoverblock_id')
            ->withPivot('cardcoverblock_id')
            ->orderBy('position')
            ->withTimestamps();
    }
}
