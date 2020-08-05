<?php

namespace Core\Http\Controller\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Core\Http\Requests\StoreUserRequest;
use Core\Http\Requests\UpdateUserRequest;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Core\Model\User;
use DB;
use Core\Library\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        return view('admin.layouts.modules.user.list');
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function data(Request $request)
    {
        $tablecols = [
            1 => ['users.id'],
            2 => ['users.firstname'],
            3 => ['users.lastname'],
            4 => ['users.email'],
            5 => ['roles.name'],
            6 => ['users.updated_at'],
        ];
        
        $filteredmodel = DB::table('users')
                ->leftjoin('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
                ->leftjoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
                ->select(DB::raw("users.id, 
                    users.firstname, 
                    users.lastname, 
                    users.email, 
                    roles.name,
                    users.updated_at")
            );
        
        $modelcnt = $filteredmodel->count();
        
        $data = DataTables::DataTableFilters($filteredmodel, $request, $tablecols, $hasValue, $totalFiltered);
        
        return response(['data'=> $data,
            'draw' => $request->draw,
            'recordsTotal' => ($hasValue)? $data->count(): $modelcnt,
            'recordsFiltered' => ($hasValue)? $totalFiltered: $modelcnt], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'roles' => Role::get(['id', 'name as label'])
        ];
        return view('admin.layouts.modules.user.add')->with(compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        try {
            DB::beginTransaction();
            $user = User::create($request->only('firstname', 'lastname', 'middlename', 'email', 'password'));
            
            $user->assignRole($request->input('roles'));
            
            DB::commit();
            return redirect()->route('users.index')->with('status-success', 'User created successfully');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('status-failed', $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $role = $user->roles->first();
        $rolePermissions = null;
        if($role) {
            $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
                ->where("role_has_permissions.role_id",$role->id)
                ->get();
        }


        return view('admin.layouts.modules.user.show',compact('user','role','rolePermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $role = $user->roles->first();
        $data = [
            'roles' => Role::get(['id', 'name as label'])
        ];
        return view('admin.layouts.modules.user.edit')->with(compact('data', 'user', 'role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        try
        {
            DB::beginTransaction();
            $input = $request->all();

            $user = User::find($id);
            $user->update($input);
            DB::table('model_has_roles')->where('model_id',$id)->delete();


            $user->assignRole($request->input('roles'));


            DB::commit();
            return redirect()->route('users.index')
                            ->with('status-success','User updated successfully');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('status-failed', $ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try
        {
            User::find($id)->delete();
            return redirect()->route('users.index')
                            ->with('status-success','User deleted successfully');
        } catch (Exception $ex) {
            return redirect()->route('users.index')
                            ->with('status-failed', $ex->getMessage());
        }
    }
}
