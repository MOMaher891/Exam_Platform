@extends('layouts.dashboard.layout')
@section('title', 'Inspector')
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Inspector List</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}">DashBoard</a></li>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.inspector.exams') }}">Exams</a></li>
                        </li>
                        <li class="breadcrumb-item active">Inspector</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row  w-100 ">

                        <div class="col-md-6"></div>
                        @if (auth()->user()->hasRole('superadmin') || auth()->user()->hasRole('analyst'))
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Status</label>
                                <select name="" class=" form-control select" id="statuss">
                                        <option value="" selected disabled>Choose Status</option>
                                        <option value="pending">Pending</option>
                                        <option value="accept">Accept</option>
                                        <option value="cancel">cencel</option>
                                </select>
                            </div>
                        </div>



                        <div class="col-md-2">
                            <div class="form-group d-flex" style="margin-top: 30px">
                                <button onclick="handleFilter()" class="btn btn-primary p-2" >Search <i class="fa-solid fa-magnifying-glass"></i></button>
                                <button onclick="ClearFilter()" class="btn btn-light" >Clear</button>
                            </div>
                        </div>
                        @endif

                    </div>
                    <h4 class="card-title">Inspector List</h4>
                    <table id="datatable-buttons" class="table dt-responsive nowrap w-100">

                        <thead>

                            <tr>
                                <th>Name</th>
                                <th>National_ID</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($data->observeActivity as $ob)

                            <tr>
                                <td>{{$ob->observes->name}}</td>
                                <td>{{$ob->observes->national_id}}</td>
                                <td>
                                    @if ($ob->is_come == 0)
                                    <a href="{{ route('admin.inspector.is_come', $ob->id) }}" title="تحضير المراقب" class="btn btn-success"><i class="fa fa-check"></i></a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>

@endsection

