<?php

namespace Core\Model;

use Illuminate\Database\Eloquent\Model;

class SystemConfig extends Model
{
    //
    protected $primaryKey = 'keyword';
    public $incrementing = false;
    
    protected $fillable = ['keyword', 'keyvalue'];
    
    public static function scopeDefaults($query, $params) {
        
        return $query->where('keyword', $params)->first();
    }
}
