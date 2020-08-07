<?php

namespace Core\Model;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'parent_id', 'page_id', 'lft', 'rgt', 'lvl', 'created_by', 'created_at', 'updated_at'
    ];

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
