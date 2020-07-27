<?php

namespace Core\Model;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //
    protected $guarded = ['email_verified_at', 'remember_token'];
    
    public function setPasswordAttribute($pass){
        $this->attributes['password'] = Hash::make($pass);
    }
}
