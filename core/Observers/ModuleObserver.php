<?php

namespace Core\Observers;

use Core\Model\Module;
use Illuminate\Support\Facades\Auth;

class ModuleObserver
{
    /**
     * Listen to the SystemConfig creating event.
     *
     * @param  \Core\Model\Module  $module
     * @return void
     */
    public function creating(Module $module)
    {
        $module->created_by = Auth::id();
    }
    
    /**
     * Listen to the SystemConfig updating event.
     *
     * @param  \Core\Model\Module  $module
     * @return void
     */
    public function updating(Module $module)
    {
        $module->updated_by = Auth::id();
    }
}
