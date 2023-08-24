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
                    <h4 class="card-title p-3">Send Email to Change Password</h4>
                    <div class="row mb-3 justify-content-center align-content-center">
                        <div class="col-md-6">
                            <a href="{{ route('inspector.profile.send-email') }}" class="btn btn-primary waves-effect"
                            style="margin-top:20px">Send Email</a>
    
                        </div>                 
                    
                    </div>
        </div> <!-- end col -->
    </div>
    <!-- end row -->

@endsection
