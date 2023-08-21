@extends('layouts.website.layout')
@section('title','Sign Up')
@section('content')

<main class="main">

      <div class="">
        <div class="container">
          <div class="row">
            <div class="col">
              <div class="ugf-contact-wrap">
                <form class="row" enctype="multipart/form-data" method="POST" action="{{route('register')}}">
                    @csrf
                  <div class="col-lg-5 offset-lg-1">
                    <h2>Personal Info.</h2>

                    <div class="form-group">
                      <label for="inputText">Name</label>
                      <input type="text" class="form-control" id="inputText" placeholder="e.g. Robert Smith" name="name"  value="{{old('name')}}" >
                      @error('name')
                        <span class="text-danger mt-2">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="form-group ">
                        <label for="inputPhone">Phone</label>
                        <input type="tel" style="padding-left:52px !important" class=" form-control w-100" id="inputPhone" name="phone"  value="{{old('phone')}}" >
                        @error('phone')
                        <span class="text-danger mt-2">{{ $message }}</span>
                      @enderror
                      </div>
                    <div class="form-group ">
                        <label for="inputPhone">Birth Date</label>
                        <input type="date" class=" form-control w-100" id="inputPhone" name="birth_date"  value="{{old('birth_date')}}" >
                        @error('birth_date')
                        <span class="text-danger mt-2">{{ $message }}</span>
                      @enderror
                      </div>
                    <div class="form-group ">
                        <label for="inputPhone">Job Title</label>
                        <input type="text" class=" form-control w-100" id="inputPhone" name="job_title" placeholder="Academic Coordinator"  value="{{old('job_title')}}" >
                        @error('job_title')
                        <span class="text-danger mt-2">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="form-group ">
                        <label for="inputPhone">National ID</label>
                        <input type="number" class=" form-control w-100" id="inputPhone" name="national_id"  value="{{old('national_id')}}" >
                        @error('national_id')
                        <span class="text-danger mt-2">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="form-group ">
                        <label for="inputPhone">Gender</label>
                        <select name="gender" id="" class="form-control"  value="{{old('gender')}}" >
                            <option value="" disabled selected>Choose Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                        @error('gender')
                        <span class="text-danger mt-2">{{ $message }}</span>
                      @enderror
                    </div>

                    <div class="form-group ">
                        <label for="inputPhone">Nationality</label>
                        <input type="text" class=" form-control w-100" id="inputPhone" name="nationality" placeholder="Egyption"  value="{{old('nationality')}}" >
                        @error('nationality')
                        <span class="text-danger mt-2">{{ $message }}</span>
                      @enderror
                    </div>

                    <div class="form-group ">
                        <label for="inputPhone">Address</label>
                        <input type="text" class=" form-control w-100" id="inputPhone" name="address" placeholder="Egypt/Cairo/Shubra"  value="{{old('address')}}" >
                        @error('address')
                        <span class="text-danger mt-2">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="inputMail">Email Addresss</label>
                      <input type="email" class="form-control" id="inputMail" placeholder="e.g. example@mail.com" name="email"  value="{{old('email')}}" >
                      @error('email')
                      <span class="text-danger mt-2">{{ $message }}</span>
                    @enderror
                    </div>
                    <div class="form-group">
                      <label for="inputTextarea">Password</label>
                      <input type="password" class="form-control" id="inputPhone" placeholder="ASDasd!@#123" name="password"  value="{{old('password')}}" >
                      @error('password')
                      <span class="text-danger mt-2">{{ $message }}</span>
                    @enderror
                    </div>
                    <div class="form-group">
                      <label for="inputTextarea">Confirm password</label>
                      <input type="password" class="form-control" id="inputPhone" name="confirm_password"  value="{{old('confirm_password')}}" >
                      @error('confirm_password')
                      <span class="text-danger mt-2">{{ $message }}</span>
                    @enderror
                    </div>
                    <button type="submit" class="btn">SignUp</button>
                  </div>

                  <div class="col-lg-5 offset-lg-1">
                    <div class="contact-details">
                      <h2>Upload files.</h2>
                      <form action="#">
                        <div class="form-group">
                          <label for="inputText">Personal Photo</label>
                          <input type="file" class="form-control" id="inputText" placeholder="e.g. Robert Smith" name="img_personal"  value="{{old('img_personal')}}" >
                          @error('img_personal')
                          <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                        </div>
                        <div class="form-group ">
                            <label for="inputPhone">ID Photo</label>
                            <input type="file" class=" form-control" id="inputPhone" name="img_national"  value="{{old('img_national')}}" >
                          @error('img_national')
                          <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                        </div>
                        <div class="form-group ">
                            <label for="inputPhone">Passport Photo</label>
                            <input type="file" class=" form-control" id="inputPhone" name="img_passport"  value="{{old('img_passport')}}" >
                          @error('img_passport')
                          <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                        </div>
                        <div class="form-group ">
                            <label for="inputPhone">Certificate Photo</label>
                            <input type="file" class=" form-control" id="inputPhone" name="img_certificate"  value="{{old('img_certificate')}}" >
                          @error('img_certificate')
                          <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                        </div>
                        <div class="form-group ">
                            <label for="inputPhone">certificate good conduct Photo</label>
                            <input type="file" class=" form-control" id="inputPhone" name="img_certificate_good_conduct"  value="{{old('img_certificate_good_conduct')}}" >
                          @error('img_certificate_good_conduct')
                          <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                        </div>


                    </div>
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
