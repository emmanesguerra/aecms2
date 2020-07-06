<?php

namespace Core\Observers;

use Core\Model\SystemConfig;
use Illuminate\Support\Facades\Auth;

class SystemConfigObserver
{
    //
    /**
     * Listen to the SystemConfig creating event.
     *
     * @param  \App\SystemConfig  $config
     * @return void
     */
    public function creating(SystemConfig $config)
    {
        $config->created_by = Auth::id();
    }
    
    /**
     * Listen to the SystemConfig updating event.
     *
     * @param  \App\SystemConfig  $config
     * @return void
     */
    public function updating(SystemConfig $config)
    {
        $config->updated_by = Auth::id();
    }
}
