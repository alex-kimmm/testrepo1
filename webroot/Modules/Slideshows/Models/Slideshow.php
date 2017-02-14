<?php

namespace TypiCMS\Modules\Slideshows\Models;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Laracasts\Presenter\PresentableTrait;
use TypiCMS\Modules\Core\Models\Base;
use TypiCMS\Modules\History\Traits\Historable;

class Slideshow extends Base
{
    use Historable;
    use PresentableTrait;
    use Translatable;

    protected $presenter = 'TypiCMS\Modules\Slideshows\Presenters\ModulePresenter';
    
    /**
     * Declare any properties that should be hidden from JSON Serialization.
     *
     * @var array
     */
    protected $hidden = [];

    protected $fillable = [
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
     * A slideshow has many slideshowitems.
     *
     * @return MorphToMany
     */
    public function slideshowitems()
    {
        return $this->morphToMany('TypiCMS\Modules\Slideshowitems\Models\Slideshowitem', 'slideshow_slideshowitem', 'slideshow_slideshowitems','slideshow_id','slideshowitem_id')
            // products
            ->join('products', 'slideshowitems.product_id', '=', 'products.id')
            ->join('product_translations', 'products.id', '=', 'product_translations.product_id')
            ->where('product_translations.status', 1) // if is enabled

            ->join('slideshowitem_translations', 'slideshowitems.id', '=', 'slideshowitem_translations.slideshowitem_id')
            ->where('slideshowitem_translations.status', 1)
            ->withPivot('slideshowitem_id')
            ->orderBy('position')
            ->withTimestamps();
    }
}
