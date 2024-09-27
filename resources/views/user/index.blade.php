@extends('layouts.default')

@section('content')
    {{-- @include('role-permission/nav-links') --}}
    <div class="col-lg-12">
        @if(session('status'))
            <div class="alert alert-success">{{session('status')}}</div>
        @endif
        <div class="card mt-3">
            <div class="card-header">
                <a href="{{url('users/create')}}" class="btn btn-primary float-end"> <i class="mdi mdi-plus"></i> Add User</a>
            </div>
            <div class="card-body">
                <h4 class="card-title">Roles</h4>
                <div class="table-responsive">
                  <table class="table table-striped table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($users as $user)
                          <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                @if ($user->getRoleNames())
                                   @foreach ($user->getRoleNames() as $rolename)
                                       <label for="" class="badge badge-primary">{{$rolename}}</label>
                                   @endforeach 
                                @endif
                            </td>
                            <td>
                                <a href="{{url('users/'.$user->id.'/edit')}}" class="btn btn-success btn-sm"> <i class="mdi mdi-pencil"></i> Edit</a>
                                <a href="{{url('users/'.$user->id.'/delete')}}" class="btn btn-danger btn-sm"> <i class="mdi mdi-delete"></i> Delete</a>
                                {{-- <a href="{{url('roles/'.$role->id.'/give-permission')}}" class="btn btn-warning btn-sm"> <i class="mdi mdi-lock"></i> Add/Edit Permissions</a> --}}
                            </td>
                          </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
@endsection