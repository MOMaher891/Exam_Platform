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
                <form class="card-body" id="myForm" method="post" action="{{ route('inspector.profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    <h4 class="card-title">Profile</h4>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="py-2">
                                <img src="{{asset('uploads/inspector/personal/'.auth('observe')->user()->img_personal)}}" style="width:200px;border-radius:20px" alt="">
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12 col-sm-12">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Image</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="file" name="image"
                                    id="example-text-input" value="{{ old('image') }}" >
                                @error('image')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-12 col-lg-12 col-sm-12">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="name" placeholder="Ex: Programming"
                                    id="example-text-input" value="{{ old('name',auth('observe')->user()->name) }}" required>
                                @error('name')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12 col-lg-12 col-sm-12">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="email" placeholder="Ex: Programming"
                                    id="example-text-input" value="{{ old('email',auth('observe')->user()->email) }}" required>
                                @error('email')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12 col-lg-12 col-sm-12">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Company <span class="text-gray">(optional)</span></label>
                            <div class="col-sm-10">
                                <select name="center_id" id="" class="form-control">
                                    <option value="" selected disabled>Choose your company</option>
                                    @foreach ($centers as $center)
                                        <option value="{{$center->id}}" @if (auth('observe')->user()->center_id == $center->id)
                                            selected
                                        @endif>{{$center->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="col-md-12 col-lg-12 col-sm-12">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Phone</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="phone" placeholder="Ex: Programming"
                                    id="example-text-input" value="{{ auth('observe')->user()->phone }}" required>
                                @error('phone')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <button type="submit" id="submit" class="btn btn-info waves-effect waves-light"
                        style="margin-top:20px">Update</button>
                    <a href="{{ route('inspector.home') }}" class="btn btn-light waves-effect"
                        style="margin-top:20px">Cancel</a>

                    <a href="{{ route('inspector.profile.verify') }}" class="btn btn-danger waves-effect"
                        style="margin-top:20px">Change Password</a>
                </form>
            </div>
        </div> <!-- end col -->
    </div>
    <!-- end row -->

@endsection
