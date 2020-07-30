<?php

namespace Core\Http\Controller\Module;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Core\Http\Requests\StoreModuleRequest;
use Core\Model\Module;
use Spatie\Permission\Models\Permission;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.layouts.modules.module.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.layouts.modules.module.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreModuleRequest $request)
    {
        try
        {
            //save to db
            $module = Module::create($request->only('module_name', 'description', 'route_index_url', 'icon'));
            
            if($module) {
                //create permissions
                $this->CreatePermissions($module->module_name);

                //create controller, model, observer, request and migration
                $this->generateClassFiles($module->module_name);
            }
            
            return redirect()->route('modules.index')->with('status-success', 'Module created successfully');
        } catch (\Exception $ex) {
            return redirect()->back()->with('status-failed', $ex->getMessage());
        }
    }
    
    private function CreatePermissions($string)
    {
        // strip out all whitespace and convert to lowercase
        $clean = strtolower(preg_replace('/\s*/', '', $string));
        
        $permissions = ['-list', '-create', '-edit', '-delete'];
        
        foreach($permissions as $permission) {
            Permission::create([
                'name' => $clean . $permission, 'module' => $clean
            ]);
        }
    }
    
    private function generateClassFiles($string)
    {
        // strip out all whitespace and convert to lowercase
        $title = \Illuminate\Support\Str::title($string);
        $clean = preg_replace('/\s*/', '', $title);
        
        Artisan::call("make:controller", ['name' => $clean.'/'.$clean.'Controller']);
        
        Artisan::call("make:controller", ['name' => $clean.'/Admin/'.$clean.'Controller']);
        
        Artisan::call("make:model", ['name' => 'Model/'.$clean]);
        
        Artisan::call("make:observer", ['name' => $clean.'Observer']);
        
        Artisan::call("make:request", ['name' => 'Store'.$clean.'Request']);
        
        Artisan::call("make:request", ['name' => 'Update'.$clean.'Request']);
        
        Artisan::call("make:migration", ['name' => 'create_'.$clean.'_table']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
