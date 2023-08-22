@extends('layouts.dashboard.layout')
@section('title', 'Add Quiz')

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Add Quiz</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}">DashBoard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.exam.index') }}">Quiz</a></li>
                        <li class="breadcrumb-item active">Add Quiz</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form class="card-body" id="myForm" method="post" action="{{ route('admin.exam.store') }}">
                    @csrf
                    <h4 class="card-title">Add New Quiz</h4>
                    <p class="card-title-desc">Here are examples : You can add Quiz Programming on 23-8-2023</p>
                    <div class="row mb-3">
                        {{-- <div class="col-md-6 col-sm-12">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="name" placeholder="Ex: Programming Exam"
                                    id="example-text-input" value="{{ old('name') }}" required>
                                @error('name')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                        </div> --}}

                        <div class="col-md-6 col-sm-12">
                            <label class="col-sm-2 col-form-label">Exam</label>
                            <div class="col-sm-10">
                                <select class="form-select" name="category_id" id="selectCategory"
                                    aria-label="Default select example" required>
                                    <option selected="" value="" disabled>Choose exam</option>
                                    @foreach ($categories as $category)
                                        <option value='{{ $category->id }}'>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label for="example-number-input" class="col-sm-2 col-form-label">Period price</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="number" name="price" id="example-number-input"
                                    value="{{ old('price') }}" placeholder="Ex: 150 $" required>
                                @error('price')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>



                    <div class="row mb-3">
                        <div class="col-md-6 col-sm-12">
                            <label for="example-date-input" class="col-sm-2 col-form-label">Date</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="date" name="date" id="example-date-input"
                                    value="{{ old('date') }}" min="<?php $currentDate = new DateTime();
                                    $currentDate->add(new DateInterval('P1D'));
                                    $nextDay = $currentDate->format('Y-m-d');

                                    echo $nextDay; ?>" required>
                                @error('date')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <label for="example-date-input" class="col-sm-3 col-form-label">Show date</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="date" name="show_date" id="example-date-input"
                                    value="{{ old('show_date') }}" min="<?php $currentDate = new DateTime();
                                    $currentDate->add(new DateInterval('P1D'));
                                    $nextDay = $currentDate->format('Y-m-d');

                                    echo $nextDay; ?>" required>
                                @error('show_date')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>



                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div>
                                <h5 class="font-size-14 mb-4">Type of Exam</h5>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" id="formCheck1" name="type" value="public"  onclick="hideCenters()">
                                    <label class="form-check-label" for="formCheck1">
                                        Public
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="formCheck1" name="type" value="private" onclick="ShowCenters()" >
                                    <label class="form-check-label" for="formCheck1">
                                        Private
                                    </label>
                                </div>
                            </div>
                        </div>
                        {{-- show centers if private --}}

                        <div class="col-md-12 d-none" id="Centers" >
                            <div class="card">
                                <div class="card-title">
                                    Choose Center
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                    @foreach ($centers as $center)
                                        <div class="col-md-4 bg-white">
                                            <div class="">
                                                <div class="checkbox checkbox-primary mb-2">
                                                    <input id="{{ $center->id }}" type="checkbox"
                                                        value="{{ $center->id }}" name="center_id[]" class="form-check-input" >
                                                    <label for="{{ $center->id }}">{{ $center->name }}</label>
                                                </div>
                                            </div>
                                        </div> <!-- end col-->
                                    @endforeach

                                    </div>
                                </div>
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

@section('scripts')
<script>
    function ShowCenters()
    {
        $("#Centers").removeClass('d-none')
    }
</script>
<script>
function hideCenters()
    {
        $("#Centers").addClass('d-none')
    }
</script>

@endsection
