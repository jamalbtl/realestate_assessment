<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller as BaseController;

class UserController extends BaseController
{
    public function __construct(){
        $this->middleware('permission:view user',['only'=>['index']]);
        $this->middleware('permission:create user',['only'=>['create','store']]);
        $this->middleware('permission:update user',['only'=>['update','edit']]);
        $this->middleware('permission:delete user',['only'=>['destroy']]);
    }

    public function index()
    {
        $users=User::get();
        
        return view('user.index',['users'=>$users]);
    }

    public function create()
    {
        $roles=Role::pluck('name','name')->all();
        return view('user.create',['roles'=>$roles]);
    }


    public function store(Request $request)
    {
        
        $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|max:255|unique:users,email',
            'password'=>'required|string|min:6|max:20',
            'roles'=>'required'
        ]);

        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);

        $user->syncRoles($request->roles);

        return redirect('/users')->with('status','User Created Successfully');


    }

  
    public function show(string $id)
    {
        //
    }

    public function edit(User $user)
    {
        $roles=Role::pluck('name','name')->all();
        $userRoles=$user->roles->pluck('name','name')->all();
        return view('user.edit',['user'=>$user,'roles'=>$roles,'userRoles'=>$userRoles]);
    }
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required',
            // 'password'=>'required|string|min:6|max:20',
            'roles'=>'required'
        ]);
        if(!empty($request->password)){
            $request->validate([
                'password'=>'string|min:6|max:20',
                
            ]); 
        }
        $data=[
            'name'=>$request->name,
            'email'=>$request->email,
            
        ];

        if(!empty($request->password)){
            $data +=[
                'password'=>Hash::make($request->password),
            ];
        }

        $user->update($data);
        $user->syncRoles($request->roles);

        return redirect('/users')->with('status','User Updated Successfully');

    }

    public function destroy( $userId)
    {
        $user=User::findOrFail($userId);
        $user->delete();

        return redirect('/users')->with('status','User Deleted');
    }
}
