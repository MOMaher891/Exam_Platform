@extends('layouts.website.layout')
@section('title','Sign Up')
@section('content')

<main class="main">

      <div class="">
        <div class="container">
          <div class="row">
            <div class="col">
              <div class="ugf-contact-wrap">
                <div class="card">
                  @if(session('success'))
                  <h6 class="alert alert-success">
                      {{ session('success') }}
                  </h6>
                @elseif(session('error'))
                  <h6 class="alert alert-danger">
                    {{ session('error') }}
                  </h6>
                @endif               
               </div>
                <form class="row" enctype="multipart/form-data" method="POST" action="{{route('register')}}">
                    @csrf
                  <div class="col-lg-5 offset-lg-1">
                    <h2>Personal Info.</h2>

                    <div class="form-group">
                      <label for="inputText">Name</label>
                      <input type="text" class="form-control" id="inputText" placeholder="e.g. Robert Smith" name="name"  value="{{old('name')}}" required>
                      @error('name')
                        <span class="text-danger mt-2">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="form-group ">
                        <label for="inputPhone">Phone</label>
                        <input type="tel" style="padding-left:52px !important" class=" form-control w-100" id="inputPhone" name="phone"  value="{{old('phone')}}" required>
                        @error('phone')
                        <span class="text-danger mt-2">{{ $message }}</span>
                      @enderror
                      </div>
                    <div class="form-group ">
                        <label for="inputPhone">Birth Date</label>
                        <input type="date" class=" form-control w-100" id="inputPhone" name="birth_date"  value="{{old('birth_date')}}" required>
                        @error('birth_date')
                        <span class="text-danger mt-2">{{ $message }}</span>
                      @enderror
                      </div>
                    {{-- <div class="form-group ">
                        <label for="inputPhone">Compoany <span class="text-gray">(Optional)</span></label>
                        <select name="center_id" class="form-control" id="">
                            <option value=""  selected disabled>Choose Company</option>
                            @foreach ($centers as $center)
                                <option value="{{$center->id}}">{{$center->name}}</option>
                            @endforeach
                        </select>
                        @error('job_title')
                        <span class="text-danger mt-2">{{ $message }}</span>
                      @enderror
                    </div> --}}
                    <div class="form-group ">
                        <label for="inputPhone">Job Title</label>
                        <input type="text" class=" form-control w-100" id="inputPhone" name="job_title" placeholder="Academic Coordinator"  value="{{old('job_title')}}" required>
                        @error('job_title')
                        <span class="text-danger mt-2">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="form-group ">
                        <label for="inputPhone">Emirates ID</label>
                        <input type="number" class=" form-control w-100" id="inputPhone" name="national_id"  value="{{old('national_id')}}" required>
                        @error('national_id')
                        <span class="text-danger mt-2">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="form-group ">
                        <label for="inputPhone">Gender</label>
                        <select name="gender" id="" class="form-control"  value="{{old('gender')}}" required>
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
                        <input type="text" class=" form-control w-100" id="inputPhone" name="nationality" placeholder="Egyption"  value="{{old('nationality')}}" required>
                        @error('nationality')
                        <span class="text-danger mt-2">{{ $message }}</span>
                      @enderror
                    </div>

                    <div class="form-group ">
                        <label for="inputPhone">Address</label>
                        <input type="text" class=" form-control w-100" id="inputPhone" name="address" placeholder="Egypt/Cairo/Shubra"  value="{{old('address')}}" required>
                        @error('address')
                        <span class="text-danger mt-2">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="inputMail">Email Addresss</label>
                      <input type="email" class="form-control" id="inputMail" placeholder="e.g. example@mail.com" name="email"  value="{{old('email')}}" required>
                      @error('email')
                      <span class="text-danger mt-2">{{ $message }}</span>
                    @enderror
                    </div>
                    <div class="form-group">
                      <label for="inputTextarea">Password</label>
                      <input type="password" class="form-control" id="inputPhone" placeholder="ASDasd!@#123" name="password"  value="{{old('password')}}" required>
                      @error('password')
                      <span class="text-danger mt-2">{{ $message }}</span>
                    @enderror
                    </div>
                    <div class="form-group">
                      <label for="inputTextarea">Confirm password</label>
                      <input type="password" class="form-control" id="inputPhone" name="confirm_password"  value="{{old('confirm_password')}}" required>
                      @error('confirm_password')
                      <span class="text-danger mt-2">{{ $message }}</span>
                    @enderror
                    </div>
                    <button type="submit" class="btn">SignUp</button>
                  </div>

                  <div class="col-lg-5 offset-lg-1">
                    <div class="contact-details">
                      <h2>Upload files.</h2>
                        <div class="form-group">
                          <label for="inputText">Personal Photo</label>
                          <input type="file" class="form-control" id="inputText" placeholder="e.g. Robert Smith" name="img_personal"  value="{{old('img_personal')}}" required>
                          @error('img_personal')
                          <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="inputPhone">Emirates ID front</label>
                                <input type="file" class=" form-control" id="inputPhone" name="img_national"  value="{{old('img_national')}}" required>
                              @error('img_national')
                              <span class="text-danger mt-2">{{ $message }}</span>
                            @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="inputPhone">Emirates ID back</label>
                                <input type="file" class=" form-control" id="inputPhone" name="img_national_back"  value="{{old('img_national')}}" required>
                              @error('img_national')
                              <span class="text-danger mt-2">{{ $message }}</span>
                            @enderror
                            </div>

                        </div>
                        <div class="form-group ">
                            <label for="inputPhone">Passport Photo</label>
                            <input type="file" class=" form-control" id="inputPhone" name="img_passport"  value="{{old('img_passport')}}" required>
                          @error('img_passport')
                          <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                        </div>
                        <div class="form-group ">
                            <label for="inputPhone">Graduation certificate</label>
                            <input type="file" class=" form-control" id="inputPhone" name="img_certificate"  value="{{old('img_certificate')}}" required>
                          @error('img_certificate')
                          <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                        </div>
                        <div class="form-group ">
                            <label for="inputPhone">Police Clearance</label>
                            <input type="file" class=" form-control" id="inputPhone" name="img_certificate_good_conduct"  value="{{old('img_certificate_good_conduct')}}" required>
                          @error('img_certificate_good_conduct')
                          <span class="text-danger mt-2">{{ $message }}</span>
                        @enderror
                        </div>

                        <h2>Bank Info.</h2>
                        <div class="form-group ">
                            <label for="inputPhone">Bank Name</label>
                            <input type="text" class=" form-control w-100" id="inputPhone" name="bank_name" placeholder="CIB"  value="{{old('job_title')}}" required>
                            @error('back_name')
                            <span class="text-danger mt-2">{{ $message }}</span>
                          @enderror
                        </div>
                        <div class="form-group ">
                            <label for="inputPhone">IBAN</label>
                            <input type="text" class=" form-control w-100" id="inputPhone" name="IBAN" placeholder="EG:XXXXXXXX"  value="{{old('IBAN')}}" required>
                            @error('IBAN')
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
