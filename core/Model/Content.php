<?php

namespace Core\Model;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'html_template', 'type', 'class_namespace', 'method_name', 'created_by', 'updated_by', 'created_at', 'updated_at'
    ];
}
