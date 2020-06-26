<?php

namespace Core\Model;

use Illuminate\Database\Eloquent\Model;

class SystemConfig extends Model
{
    //
    protected $primaryKey = 'keyword';
    public $incrementing = false;
    
    public static function scopeDefaults($query, $params) {
        
        return $query->where('keyword', $params)->first();
    }
}
