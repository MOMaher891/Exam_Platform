@extends('layouts.website.dashboard.layout')
@section('title', 'Profile')

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Profile</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('inspector.home') }}">DashBoard</a></li>
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
                <form class="card-body" id="myForm" method="get" action="{{ route('inspector.profile.check') }}" enctype="multipart/form-data">
                    <h4 class="card-title">Check Code</h4>
                    <div class="row mb-3">
                      
                        

                        <div class="col-md-12 col-lg-12 col-sm-12">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Code</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="code" placeholder="XXXXX"
                                    id="example-text-input" value="{{ old('code') }}" required>
                                @error('code')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <button type="submit" id="submit" class="btn btn-info waves-effect waves-light"
                        style="margin-top:20px">Check</button>
                </form>
            </div>
        </div> <!-- end col -->
    </div>
    <!-- end row -->

@endsection
