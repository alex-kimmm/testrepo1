<?php

namespace TypiCMS\Modules\Failzs\Models;


use Illuminate\Database\Eloquent\Model;

class FailzLike extends Model
{

    protected $fillable = [
        'user_id',
        'failz_id'
    ];

    public function user() {
        return $this->belongsTo('TypiCMS\Modules\Users\Models\User');
    }
}
