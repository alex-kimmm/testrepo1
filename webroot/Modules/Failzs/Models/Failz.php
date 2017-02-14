<?php

namespace TypiCMS\Modules\Failzs\Models;

use Dimsav\Translatable\Translatable;
use Laracasts\Presenter\PresentableTrait;
use TypiCMS\Modules\Core\Models\Base;
use TypiCMS\Modules\History\Traits\Historable;

class Failz extends Base
{
    use Historable;
    use PresentableTrait;
    use Translatable;

    public static $giphyApiUrl = "https://api.giphy.com/v1/gifs/search?q=#search&limit=#limit&api_key=dc6zaTOxFJmzC";

    public static $contentType = [
        'PICTURE' => 0,
        'VIDEO'   => 1
    ];

    protected $presenter = 'TypiCMS\Modules\Failzs\Presenters\ModulePresenter';

    protected $table = 'failzs';

    /**
     * Declare any properties that should be hidden from JSON Serialization.
     *
     * @var array
     */
    protected $hidden = [];

    protected $fillable = [
        'title',
        'giphy_id',
        'slug',
        'status',
        'summary',
        'body',
        'obj_link',
        'obj_link_placeholder',
        'content_type',
        'user_id',
        'inappropriate',
        'is_giphy'
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


    public function getUrl(){
        return env('APP_URL') . '/failz/' . $this->slug;
    }

    public function likes() {
        return $this->hasMany('TypiCMS\Modules\Failzs\Models\FailzLike');
    }

    public function tags() {
        return $this->belongsToMany('TypiCMS\Modules\Failzs\Models\FailzTag', 'failz_tags_pivot', 'failz_id', 'tag_id');
    }
}
