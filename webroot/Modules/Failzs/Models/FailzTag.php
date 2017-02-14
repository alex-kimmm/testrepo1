<?php

namespace TypiCMS\Modules\Failzs\Models;


use Illuminate\Database\Eloquent\Model;

class FailzTag extends Model
{
    protected $table = 'failz_tags';

    protected $fillable = [ 'name' ];
}
