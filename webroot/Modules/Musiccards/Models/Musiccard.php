<?php

namespace TypiCMS\Modules\Musiccards\Models;

use Dimsav\Translatable\Translatable;
use Laracasts\Presenter\PresentableTrait;
use TypiCMS\Modules\Core\Models\Base;
use TypiCMS\Modules\History\Traits\Historable;

class Musiccard extends Base
{
    use Historable;
    use PresentableTrait;
    use Translatable;

    protected $presenter = 'TypiCMS\Modules\Musiccards\Presenters\ModulePresenter';
    
    /**
     * Declare any properties that should be hidden from JSON Serialization.
     *
     * @var array
     */
    protected $hidden = [];

    protected $fillable = [
        'image',
        'track_file',
        'position',
        // Translatable columns
        'title',
        'slug',
        'status',
        'summary',
        'body',
        'song_name',
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
        'song_name',
    ];

    protected $appends = ['status', 'title', 'thumb'];

    /**
     * Columns that are file.
     *
     * @var array
     */
    public $attachments = [
        'image',
        'track_file',
    ];

    public function getImageUrl() {
        if($this->image){
            return env('MUSIC_CARD_IMAGE_UPLOAD_PATH')  . $this->image;
        }
        return '';
    }

    public function getTrackFileUrl(){
        if($this->track_file){
            return env('MUSIC_CARD_IMAGE_UPLOAD_PATH')  . $this->track_file;
        }
        return '';
    }

}
