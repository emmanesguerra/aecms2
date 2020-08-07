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

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
    
    /**
     * A content may be assigned to various pages.
     */
    public function pages()
    {
        return $this->belongsToMany(
                'Core\Model\Page',
                'page_has_contents',
                'content_id',
                'page_id'
        );
    }
}
