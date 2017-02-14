<?php

namespace TypiCMS\Modules\Colors\Models;

use Dimsav\Translatable\Translatable;
use Laracasts\Presenter\PresentableTrait;
use TypiCMS\Modules\Core\Models\Base;
use TypiCMS\Modules\History\Traits\Historable;

class Color extends Base {

    use Historable;
    use PresentableTrait;
    use Translatable;

    protected $presenter = 'TypiCMS\Modules\Colors\Presenters\ModulePresenter';

    protected $table = 'colors';
    
    /**
     * Declare any properties that should be hidden from JSON Serialization.
     *
     * @var array
     */
    protected $hidden = [];

    protected $fillable = [
        'color_code',
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
     * A size belongs to many products.
     *
     * @return belongsToMany
     */
    public function products() {
        return $this->belongsToMany('TypiCMS\Modules\Products\Models\Product', 'product_colors', 'color_id', 'product_id');
    }
}
