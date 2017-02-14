<?php

namespace TypiCMS\Modules\Usertitles\Models;

use Dimsav\Translatable\Translatable;
use Laracasts\Presenter\PresentableTrait;
use TypiCMS\Modules\Core\Models\Base;
use TypiCMS\Modules\History\Traits\Historable;

class Usertitle extends Base
{
    use Historable;
    use PresentableTrait;
    use Translatable;

    protected $presenter = 'TypiCMS\Modules\Usertitles\Presenters\ModulePresenter';
    
    /**
     * Declare any properties that should be hidden from JSON Serialization.
     *
     * @var array
     */
    protected $hidden = [];

    protected $fillable = [
        // Translatable columns
        'title',
    ];

    /**
     * Translatable model configs.
     *
     * @var array
     */
    public $translatedAttributes = [
        'title',
    ];

    protected $appends = ['title'];

    public static $titles = [
        '1' => '-',
        '2' => 'Mr.',
        '3' => 'Mrs.',
        '4' => 'Miss'
    ];

    public function users() {
        return $this->hasMany('TypiCMS\Modules\Users\Models');
    }
}
