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
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="name" placeholder="Ex: Programming Exam"
                                    id="example-text-input" value="{{ old('name') }}" required>
                                @error('name')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <label class="col-sm-2 col-form-label">Category</label>
                            <div class="col-sm-10">
                                <select class="form-select" name="category_id" id="selectCategory"
                                    aria-label="Default select example" required>
                                    <option selected="" value="" disabled>Choose Category</option>
                                    @foreach ($categories as $category)
                                        <option value='{{ $category->id }}'>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>



                    <div class="row mb-3">
                        <div class="col-md-3 col-lg-3 col-sm-12">
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
                        <div class="col-md-3 col-lg-3 col-sm-12">
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


                        <div class="col-md-6 col-lg-6 col-sm-12">
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
