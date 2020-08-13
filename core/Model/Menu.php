<?php

namespace Core\Model;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Menu extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'parent_id', 'page_id', 'lft', 'rgt', 'lvl'
    ];
    
    protected $auditExclude = [
        'created_by'
    ];

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
    
    /**
     * A content may be assigned to various pages.
     */
    public function page()
    {
        return $this->hasOne(Page::class, 'id', 'page_id');
    }
    
    /**
     * A content may be assigned to various pages.
     */
    public function setting()
    {
        return $this->hasOne(MenuSetting::class);
    }
}
