@extends('layouts.website.layout')
@section('title','Reset Password')
@section('content')

<main class="main">

      <div class="">
        <div class="container">
            @if(session('info'))
            <h6 class="alert alert-info">
                {{ session('info') }}
            </h6>
           @elseif(session('error'))
            <h6 class="alert alert-danger">
              {{ session('error') }}
            </h6>
            @endif               
          <div class="row">
            <div class="col">
              <div class="ugf-contact-wrap">
                <form class="row" enctype="multipart/form-data" method="POST" action="{{route('change-password',$id)}}">
                    @csrf
                  <div class="col-lg-5 offset-lg-3">
                    <h2>Reset Password</h2>
                    <div class="form-group">
                      <label for="inputMail">Password</label>
                      <input type="password" class="form-control" id="inputMail" placeholder="XXXXX" name="password"  value="" required>
                      @error('password')
                      <span class="text-danger mt-2">{{ $message }}</span>
                    @enderror
                    </div>

                    <div class="form-group">
                        <label for="inputMail">Password Confirmation</label>
                        <input type="password" class="form-control" id="inputMail" placeholder="XXXXX" name="password_confirmation"  value="" required>
                        @error('password')
                        <span class="text-danger mt-2">{{ $message }}</span>
                      @enderror
                      </div>
                 
                    <button type="submit" class="btn">Change Password</button>
                  </div>

                  <div class="col-lg-5 offset-lg-1">
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
    </div>
</main>
@endsection

