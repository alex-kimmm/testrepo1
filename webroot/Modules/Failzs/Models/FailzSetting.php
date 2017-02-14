<?php

namespace TypiCMS\Modules\Failzs\Models;

use Illuminate\Database\Eloquent\Model;
use Socket\Raw\Exception;

class FailzSetting extends Model
{

    protected $table = 'failz_settings';

    protected $fillable = [ 'key', 'value' ];

    public static function getValue($key) {

        try {
            $value = self::where('key', $key)->first()->value;
        } catch(Exception $e) { $value = ''; }

        return $value;
    }

}
