<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller as BaseController;

class RoleController extends BaseController
{
    public function __construct(){
        $this->middleware('permission:view role',['only'=>['index']]);
        $this->middleware('permission:create role',['only'=>['create','store','addPermissionToRole','givePermissionToRole']]);
        $this->middleware('permission:update role',['only'=>['update','edit']]);
        $this->middleware('permission:delete role',['only'=>['destroy']]);
    }
    public function index()
    {
        
        $roles=Role::get();
        return view('role-permission.role.index',['roles'=>$roles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('role-permission.role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>[
                'required',
                'string',
                'unique:roles,name'
            ]
        ]);

        Role::create([
            'name'=>$request->name
        ]);

        return redirect('roles')->with('status','Role Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        
        return view('role-permission.role.edit',[
            'role'=>$role
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name'=>[
                'required',
                'string',
                'unique:roles,name,'.$role->id
            ]
        ]);

        $role->update([
            'name'=>$request->name
        ]);

        return redirect('roles')->with('status','Role Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($roleId)
    {
        $role=Role::findOrFail($roleId);
        $role->delete();
        return redirect('roles')->with('status','Role  Deleted');
    }

    public function addPermissionToRole($roleId){
        $role=Role::findOrFail($roleId);
        $permissions=Permission::get();
        $rolePermissions=DB::table('role_has_permissions')
                                ->where('role_has_permissions.role_id',$roleId)
                                ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
                                ->all();
        return view('role-permission.role.add-permissions',[
            'role'=>$role,
            'permissions'=>$permissions,
            'rolePermissions'=>$rolePermissions,
        ]);

    }

    public function givePermissionToRole(Request $request, $roleId){
        $request->validate([
            'permission' =>'required'
        ]);
        //dd($request->all());
        $role=Role::findOrFail($roleId);
        $role->syncPermissions($request->permission);

        return redirect()->back()->with('status','Permission Added To Role');

    }
}
