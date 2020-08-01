<?php

namespace Core\Model;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ['url', 'title', 'description', 'javascripts', 'css', 'template', 'template_html'];
}
