<?php

namespace Core\Observers;

use Core\Model\User;
use Illuminate\Support\Facades\Auth;

class UserObserver
{
    //
    /**
     * Listen to the SystemConfig creating event.
     *
     * @param  \App\SystemConfig  $config
     * @return void
     */
    public function creating(User $user)
    {
        $user->created_by = Auth::id();
    }
    
    /**
     * Listen to the SystemConfig updating event.
     *
     * @param  \App\SystemConfig  $config
     * @return void
     */
    public function updating(User $user)
    {
        $user->updated_by = Auth::id();
    }
}
