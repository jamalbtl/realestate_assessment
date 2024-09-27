@extends('layouts.default')

@section('content')
    <div class="col-lg-12">
        @if(session('status'))
            <div class="alert alert-success">{{session('status')}}</div>
        @endif
        <div class="card">
            <div class="card-header">
                <a href="{{url('roles')}}" class="btn btn-danger float-end"> <i class="mdi mdi-arrow-left"></i> Back</a>
                
            </div>
            <div class="card-body">
                <h4 class="card-title">Role: {{$role->name}}</h4>
                <form action="{{url('roles/'.$role->id.'/give-permission')}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        @error('permission')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                        <label>Permissions</label>
                        <div class="row">
                            @foreach ($permissions as $permission)
                            <div class="col-md-2">
                                <div class="form-check">
                                    <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="permission[]" value="{{$permission->name}}" {{in_array($permission->id,$rolePermissions)?'checked':''}}> {{$permission->name}} <i class="input-helper"></i></label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        
                    <button type="submit" class="btn btn-primary me-2">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection