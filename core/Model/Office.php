<?php

namespace Core\Model;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Office extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    
    protected $fillable = ['address', 'contact_person', 'telephone', 'mobile', 'email', 'marker', 'm_width', 'm_height', 'store_hours'];

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
    
    public function officehours()
    {
        return $this->hasMany(OfficeHour::class);
    }
}
