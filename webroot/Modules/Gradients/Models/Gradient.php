<?php

namespace TypiCMS\Modules\Gradients\Models;

use Dimsav\Translatable\Translatable;
use Laracasts\Presenter\PresentableTrait;
use TypiCMS\Modules\Core\Models\Base;
use TypiCMS\Modules\History\Traits\Historable;

class Gradient extends Base
{
    use Historable;
    use PresentableTrait;
    use Translatable;

    protected $presenter = 'TypiCMS\Modules\Gradients\Presenters\ModulePresenter';
    
    /**
     * Declare any properties that should be hidden from JSON Serialization.
     *
     * @var array
     */
    protected $hidden = [];

    protected $fillable = [
        // Translatable columns
        'title',
        'status',
        'summary',
    ];

    /**
     * Translatable model configs.
     *
     * @var array
     */
    public $translatedAttributes = [
        'title',
        'status',
        'summary',
    ];

    protected $appends = ['status', 'title', 'thumb'];

    public function pages() {
        return $this->hasMany('TypiCMS\Modules\Insurancepages\Models\Insurancepage');
    }
}
