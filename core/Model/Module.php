<?php

namespace Core\Model;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'module_name', 'description', 'route_index_url', 'created_by', 'updated_by', 'created_at', 'updated_at'
    ];
}
