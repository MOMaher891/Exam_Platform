@extends('layouts.dashboard.layout')
@section('title','Centers')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Exams</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin')}}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.center.index')}}">Centers</a></li>
                            <li class="breadcrumb-item active">Exams</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Exams</h4>
                        <div class="text-center mb-3">
                            @if (auth()->user()->hasPermission('add_center'))
                            <button type="button" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#firstmodal">Import Excel</button>
                            <a href="{{asset('assets/excel/center_example.xlsx')}}"  target="__blank" class="btn btn-info" >Download Example</a>
                            <a href="{{route('admin.center.create')}}" class="btn btn-primary" >Add Centers <i class="fa fa-plus"></i></a>
                            @endif
                        </div>

                        <div class="row w-100">
                            @if (auth()->user()->hasRole('superadmin')||auth()->user()->hasRole('analyst'))

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">From</label>
                                    <input type="date" class="form-control" id="date_from">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">To</label>
                                    <input type="date" class="form-control" id="date_to">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group d-flex" style="margin-top: 30px">
                                <button onclick="handleFilter()" class="btn btn-primary p-2" >Search <i class="fa fa-magnifying-glass"></i></button>
                                <button onclick="ClearFilter()" class="btn btn-light" >Clear</button>
                            </div>
                        </div>
                        @endif
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Shift</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div>
</div>



@endsection

@section('scripts')
<script>
     let DataTable = null
function setDatatable() {
    var url = `{{ route('admin.center.exam_for_center_data',['center_id'=>':center']) }}`;
    url = url.replace(':center',{{$center->id}});

    DataTable = $("#datatable-buttons").DataTable({
        processing: true,
        serverSide: true,
        dom: 'Blfrtip',
        lengthMenu: [0, 5, 10, 20, 50, 100, 200, 500],
        pageLength: 9,
        sorting: [0, "DESC"],
        ordering: false,
        ajax: url,

        language: {
            paginate: {
                "previous": "<i class='mdi mdi-chevron-left'>",
                "next": "<i class='mdi mdi-chevron-right'>"
            },
        },


        columns: [

            {
                data: 'exam.date'
            },
            {
                data: 'shift'
            },
            {
                data: 'action'
            },
        ],
    });
}

setDatatable();

function handleFilter()
        {
            date_from = $("#date_from").val() || ''; // date from
            date_to = $("#date_to").val() || ''; //date to

            if(DataTable){
                url = "{{route('admin.center.exam_for_center_data',['center_id'=>':center'])}}"+`?date_from=${date_from}&date_to=${date_to}`;
                url = url.replace(':center',{{$center->id}});
                DataTable.ajax.url(url).load();
            }
        }

        function ClearFilter()
        {
            status = $('#expire').val('');
            public = $("#type").val('');
            date_from = $("#date_from").val('');
            date_to = $("#date_to").val('');
            paid = $("#paid").val('');
            url = "{{route('admin.center.exam_for_center_data',['center_id'=>':center'])}}";
            url = url.replace(':center',{{$center->id}});
            DataTable.ajax.url(url).load();
        }
</script>
<script>
       function DeleteData(id) {
            swal({
                title: "Delete?",
                text: "Please ensure and then confirm!",
                type: "warning",
                showCancelButton: !0,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                reverseButtons: !0
            }).then(function (e) {

                if (e.value === true) {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        type: 'GET',
                        url: "{{url('admin/center/delete')}}/" + id,
                        data: {_token: CSRF_TOKEN},
                        dataType: 'JSON',
                        success: function (results) {


                                if(results.status == true)
                                {
                                    swal("Done!", results.message, "success");
                                    DataTable.ajax.reload()

                                }
                        },
                    });

                } else {
                    e.dismiss;
                }

            }, function (dismiss) {
                return false;
            })
        }
</script>

@endsection
