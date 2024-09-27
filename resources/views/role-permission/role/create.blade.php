@extends('layouts.default')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header">
                <a href="{{url('roles')}}" class="btn btn-danger float-end"> <i class="mdi mdi-arrow-left"></i> Back</a>
                
            </div>
            <div class="card-body">
                <h4 class="card-title">Create Role</h4>
                <form action="{{url('roles')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Role Name</label>
                        <input type="text" class="form-control" placeholder="Role" name="name">
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection