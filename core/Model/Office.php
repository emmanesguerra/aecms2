<?php

namespace Core\Model;

use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    protected $fillable = ['address', 'contact_person', 'telephone', 'mobile', 'email', 'marker'];

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
    
    public function officehours()
    {
        return $this->hasMany(OfficeHour::class);
    }
}
