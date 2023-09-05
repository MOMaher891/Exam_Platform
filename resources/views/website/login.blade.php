@extends('layouts.website.layout')
@section('title','Sign In')
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

            @elseif (session('success'))
            <h6 class="alert alert-danger">
              {{ session('error') }}
            </h6>
            
            @endif               

          <div class="row">
            <div class="col">
              <div class="ugf-contact-wrap">
                <form class="row" enctype="multipart/form-data" method="POST" action="{{route('login')}}">
                    @csrf
                  <div class="col-lg-5 offset-lg-3">
                    <h2>Login</h2>


                    <div class="form-group">
                      <label for="inputMail">Email Addresss</label>
                      <input type="email" class="form-control" id="inputMail" placeholder="e.g. example@mail.com" name="email"  value="{{old('email')}}" required>
                      @error('email')
                      <span class="text-danger mt-2">{{ $message }}</span>
                    @enderror
                    </div>
                    <div class="form-group">
                      <label for="inputTextarea">Password</label>
                      <input type="password" class="form-control" id="inputpassword" placeholder="ASDasd!@#123" name="password"  value="{{old('password')}}" required>
                      @error('password')
                      <span class="text-danger mt-2">{{ $message }}</span>
                    @enderror
                    </div>

                    <button type="submit" class="btn">SignUp</button>
                    <a href="{{route('verify')}}" class="text-decoration-none text-light-emphasis">Forget Password</a>

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


@section('script')
<script>
    var phone  =document.querySelector('#inputPhone');
    window.intlTelInput(phone,{});
</script>

<script>
    document.addEventListener('DOMContentLoaded', () => {

const selectDrop = document.querySelector('#countries');
// const selectDrop = document.getElementById('countries');


fetch('http://restcountries.eu/rest/v2/all').then(res => {
  return res.json();
}).then(data => {
  let output = "";
  data.forEach(country => {
    output += `

    <option value="${country.name}">${country.name}</option>`;
  })

  selectDrop.innerHTML = output;
}).catch(err => {
  console.log(err);
})


});
</script>
@endsection
