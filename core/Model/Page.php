<?php

namespace Core\Model;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ['url', 'title', 'description', 'javascripts', 'css', 'template', 'template_html'];
    
    /**
     * A page may be given various contents.
     */
    public function contents()
    {
        return $this->belongsToMany(
                'Core\Model\Content',
                'page_has_contents',
                'page_id',
                'content_id'
        );
    }
}
