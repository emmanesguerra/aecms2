<?php

namespace Core\Model;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Module extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'module_name', 'description', 'route_index_url', 'created_by', 'updated_by', 'created_at', 'updated_at'
    ];

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
