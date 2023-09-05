@extends('layouts.dashboard.layout')
@section('title','Centers')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin')}}">Dashboard</a></li>
                            <li class="breadcrumb-item " ><a href="{{route('admin.staff.index')}}">Staff</a></li>
                            <li class="breadcrumb-item active">Change Password</li>

                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
        
                        <h4 class="card-title">Change Password</h4>
                        <form action="{{route('admin.staff.change-password',$data->id)}}" method="POST">
                            @csrf
                        <div class="row">
                        

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Passsword <span class="text-danger">*</span></label>
                                    <input type="password" name="password" value="{{old('password')}}" class="form-control" id="">
                                </div>
                                @error('password')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                           <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Confirm Password <span class="text-danger">*</span></label>
                                    <input type="password" name="password_confirmation" value="{{old('password')}}" class="form-control" id="">
                                </div>
                                @error('password')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a href="{{route('admin.staff.index')}}" class="btn btn-secondary">Cencel</a>
                                </div>
                            </div>
                        </div>
                        </form>
                     
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div>
</div>
@endsection