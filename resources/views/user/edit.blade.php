@extends('layouts.default')

@section('content')
<div class="col-md-6 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Edit User</h4>
            {{-- <p class="card-description"> Basic form layout </p> --}}
            <form class="forms-sample" action="{{url('users/'.$user->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="name" id="name" value="{{$user->name}}" placeholder="Enter Your Full Name">
                    @error('name')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
               
                <div class="form-group">
                    <label for="email">Email<span class="text-danger">*</span></label>
                    <input type="email" class="form-control" name="email" id="email" value="{{$user->email}}" placeholder="Email">
                    @error('email')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="passowrd">Password<span class="text-danger">*</span></label>
                    <input type="password" class="form-control" name="password" id="passowrd" placeholder="Password">
                    @error('password')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="role">Roles<span class="text-danger">*</span></label>
                    <select name="roles[]" id="roles" class="form-select" multiple>
                        <option value="">Select Role</option>
                        @foreach ($roles as $role)
                            <option value="{{$role}}" {{in_array($role,$userRoles)?'selected':''}}>{{$role}}</option>
                        @endforeach
                    </select>
                    @error('roles')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-primary me-2">Update</button>
                {{-- <button class="btn btn-light">Cancel</button> --}}
            </form>
        </div>
    </div>
</div>
@endsection
