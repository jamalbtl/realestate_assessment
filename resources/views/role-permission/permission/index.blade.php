@extends('layouts.default')

@section('content')
    {{-- @include('role-permission/nav-links') --}}
    <div class="col-lg-12">
        @if(session('status'))
            <div class="alert alert-success">{{session('status')}}</div>
        @endif
        <div class="card mt-3">
            <div class="card-header">
                <a href="{{url('permissions/create')}}" class="btn btn-primary float-end"> <i class="mdi mdi-plus"></i> Add Permission</a>
            </div>
            <div class="card-body">
                <h4 class="card-title">Permissions</h4>
                <div class="table-responsive">
                  <table class="table table-striped table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Permission Name</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($permissions as $permission)
                          <tr>
                            <td>{{$permission->id}}</td>
                            <td>{{$permission->name}}</td>
                            <td>
                                <a href="{{url('permissions/'.$permission->id.'/edit')}}" class="btn btn-success btn-sm"> <i class="mdi mdi-pencil"></i> Edit</a>
                                <a href="{{url('permissions/'.$permission->id.'/delete')}}" class="btn btn-danger btn-sm"> <i class="mdi mdi-delete"></i> Delete</a>
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