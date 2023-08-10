@extends('layouts.dashboard.layout')
@section('title', 'Add Category')

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Profile</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}">DashBoard</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form class="card-body" id="myForm" method="post" action="{{ route('profile.update') }}">
                    @csrf
                    <h4 class="card-title">Profile</h4>
                    <div class="row mb-3">
                        <div class="col-md-12 col-lg-12 col-sm-12">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="name" placeholder="Ex: Programming"
                                    id="example-text-input" value="{{ old('name',auth()->user()->name) }}" required>
                                @error('name')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12 col-lg-12 col-sm-12">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="email" placeholder="Ex: Programming"
                                    id="example-text-input" value="{{ old('email',auth()->user()->email) }}" required>
                                @error('email')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12 col-lg-12 col-sm-12">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Phone</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="phone" placeholder="Ex: Programming"
                                    id="example-text-input" value="{{ auth()->user()->phone }}" required>
                                @error('phone')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <button type="submit" id="submit" class="btn btn-info waves-effect waves-light"
                        style="margin-top:20px">Update</button>
                    <a href="{{ route('admin') }}" class="btn btn-light waves-effect"
                        style="margin-top:20px">Cancel</a>

                    <a href="{{ route('profile.send-email') }}" class="btn btn-danger waves-effect"
                        style="margin-top:20px">Change Password</a>
                </form>
            </div>
        </div> <!-- end col -->
    </div>
    <!-- end row -->

@endsection
