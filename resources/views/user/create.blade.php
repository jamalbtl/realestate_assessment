@extends('layouts.default')

@section('content')
<div class="col-md-6 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">User</h4>
            <p class="card-description"> Basic form layout </p>
            <form class="forms-sample" action="{{url('users')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Your Full Name" required>
                </div>
               
                <div class="form-group">
                    <label for="email">Email<span class="text-danger">*</span></label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <label for="passowrd">Password<span class="text-danger">*</span></label>
                    <input type="password" class="form-control" name="password" id="passowrd" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <label for="role">Roles<span class="text-danger">*</span></label>
                    <select name="roles[]" id="roles" class="form-select" multiple>
                        <option value="">Select Role</option>
                        @foreach ($roles as $role)
                            <option value="{{$role}}">{{$role}}</option>
                        @endforeach
                    </select>
                </div>
                
                <button type="submit" class="btn btn-primary me-2">Submit</button>
                <button class="btn btn-light">Cancel</button>
            </form>
        </div>
    </div>
</div>
@endsection
