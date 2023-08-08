@extends('layouts.dashboard.layout')
@section('title','Roles')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Add Roles</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin')}}">Dashboard</a></li>
                            <li class="breadcrumb-item " ><a href="{{route('role.index')}}">Roles</a></li>
                            <li class="breadcrumb-item active">Add</li>

                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
        
                        <h4 class="card-title">Add Roles</h4>
                        <form action="{{route('role.store')}}" method="POST">
                            @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Name <span class="text-danger">*</span></label>
                                    <input type="text" name="display_name" class="form-control" id="">
                                </div>
                                @error('display_name')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="">Description</label>
                                    <textarea name="description" class="form-control" id="" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                            

                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a href="{{route('role.index')}}" class="btn btn-secondary">Cencel</a>
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