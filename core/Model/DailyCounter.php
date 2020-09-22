<?php

namespace Core\Model;

use Illuminate\Database\Eloquent\Model;

class DailyCounter extends Model
{
    //
    protected $primaryKey = 'date';
    
    public $incrementing = false;
    public $timestamps = false;
    
    protected $fillable = [
        'date', 'ctr'
    ];
}
