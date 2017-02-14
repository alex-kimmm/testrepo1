<?php

namespace TypiCMS\Modules\Quotes\Models;

use Dimsav\Translatable\Translatable;
use Laracasts\Presenter\PresentableTrait;
use TypiCMS\Modules\Core\Models\Base;
use TypiCMS\Modules\History\Traits\Historable;

class Quote extends Base
{
    use Historable;
    use PresentableTrait;
    use Translatable;

    protected $presenter = 'TypiCMS\Modules\Quotes\Presenters\ModulePresenter';
    
    /**
     * Declare any properties that should be hidden from JSON Serialization.
     *
     * @var array
     */
    protected $hidden = [];

    protected $fillable = [
        'position',
        // Translatable columns
        'title',
        'slug',
        'uri',
        'redirect_url',
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
        'uri',
        'redirect_url',
        'status',
        'summary',
        'body',
    ];

    protected $appends = ['status', 'title', 'thumb'];

    public $POSITIONS = [
        "1"=>"left",
        "2"=>"right",
    ];

    public function processedBody(){
        return str_replace(['<p>','</p>'], ['<div><span>','</span></div>'], $this->body);
    }

    public function processedMobileBody(){
        return '<span>' . strip_tags($this->body) . '</span>';
    }
}
