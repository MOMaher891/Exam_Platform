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
                <form class="row" enctype="multipart/form-data" method="POST" action="{{route('check-code')}}">
                    @csrf
                  <div class="col-lg-5 offset-lg-3">
                    <h2>Reset Password</h2>
                    <div class="form-group">
                      <label for="inputMail">Code</label>
                      <input type="text" class="form-control" id="inputMail" placeholder="XXXXX" name="code"  value="" required>
                      @error('code')
                      <span class="text-danger mt-2">{{ $message }}</span>
                    @enderror
                    </div>
                 
                    <button type="submit" class="btn">Check Code</button>
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

