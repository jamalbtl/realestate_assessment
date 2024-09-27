@extends('layouts.default')

@section('content')
    {{-- @include('role-permission/nav-links') --}}
    <div class="col-lg-12">
        @if(session('success'))
            <div class="alert alert-success">{{session('success')}}</div>
        @endif
        <div class="card mt-3">
            <div class="card-header">
                <a href="{{url('property/create')}}" class="btn btn-primary float-end"> <i class="mdi mdi-plus"></i> Add Property</a>
            </div>
            <div class="card-body">
                <h4 class="card-title">Roles</h4>
                <div class="table-responsive">
                  <table class="table table-striped table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Sr</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Location</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php
                            $sr=1;
                        @endphp
                      @foreach ($properties as $property)
                          <tr>
                            <td>{{$sr}}</td>
                            <td>{{$property->title}}</td>
                            <td>{{$property->price}}</td>
                            <td>{{$property->location}}</td>
                            <td>
                                <a href="{{url('property/'.$property->id.'/edit')}}" class="btn btn-success btn-sm"> <i class="mdi mdi-pencil"></i> Edit</a>
                                <a href="{{url('property/'.$property->id.'/delete')}}" class="btn btn-danger btn-sm"> <i class="mdi mdi-delete"></i> Delete</a>
                            </td>
                          </tr>
                          @php
                              $sr++;
                          @endphp
                      @endforeach
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
@endsection