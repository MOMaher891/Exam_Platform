@extends('layouts.dashboard.layout')
@section('title', 'Add Category')

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Add Category</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}">DashBoard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.category.index') }}">Category</a></li>
                        <li class="breadcrumb-item active">Add Category</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form class="card-body" id="myForm" method="post" action="{{ route('admin.category.store') }}">
                    @csrf
                    <h4 class="card-title">Add New Category</h4>
                    <p class="card-title-desc">Here are examples : You can add Category Programming or Math</p>
                    <div class="row mb-3">
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="name" placeholder="Ex: Programming"
                                    id="example-text-input" value="{{ old('name') }}" required>
                                @error('name')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <button type="submit" id="submit" class="btn btn-info waves-effect waves-light"
                        style="margin-top:20px">Save</button>
                    <a href="{{ route('admin.staff.index') }}" class="btn btn-light waves-effect"
                        style="margin-top:20px">Cancel</a>
                </form>
            </div>
        </div> <!-- end col -->
    </div>
    <!-- end row -->

@endsection
