<?php

namespace TypiCMS\Modules\Categories\Models;

use Dimsav\Translatable\Translatable;
use Laracasts\Presenter\PresentableTrait;
use TypiCMS\Modules\Core\Models\Base;
use TypiCMS\Modules\History\Traits\Historable;
use TypiCMS\NestableTrait;

class Category extends Base
{
    use Historable;
    use PresentableTrait;
    use Translatable;
    use NestableTrait;

    protected $presenter = 'TypiCMS\Modules\Categories\Presenters\ModulePresenter';
    
    /**
     * Declare any properties that should be hidden from JSON Serialization.
     *
     * @var array
     */
    protected $hidden = [];

    protected $fillable = [
        'image',
        'parent_id',
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
        'category_id',
        'title',
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
    ];

    public function children() {
        return $this->hasMany('TypiCMS\Modules\Categories\Models\Category', 'parent_id');
    }

    public function parent() {
        return $this->belongsTo('TypiCMS\Modules\Categories\Models\Category', 'parent_id');
    }

    public function products() {
        return $this->hasMany('TypiCMS\Modules\Products\Models\Product');
    }

    public function insurancePage() {
        return $this->hasMany('TypiCMS\Modules\Insurancepages\Models\Insurancepage');
    }
    public function isInsurance() {
        return ( !is_null($this->parent) && $this->parent->id == CATEGORY_INSURANCE);
    }

    public function isClothing() {
        return ( !is_null($this->parent) && $this->parent->id == CATEGORY_CLOTHING);
    }

    public function isGadgetCover() {
        return ($this->isInsurance() && $this->category_id == CATEGORY_GADGET_INSURANCE);
    }

    public function isXSCover() {
        return ($this->isInsurance() && $this->category_id == CATEGORY_XS_COVER);
    }

    public function isZhitProduct() {
        return (!is_null($this->parent) && $this->category_id == CATEGORY_ZHIT);
    }

    public function isRootCategory(){
        return is_null($this->parent);
    }

    public function getSeoUrl(){
        if($this->isInsurance()) {
            return ROOT_URL_INSURANCE . '/' . $this->slug;
        } elseif( $this->isClothing() ) {
            return ROOT_URL_CLOTHING. '/' . $this->slug;
        }
        return '';
    }

}
