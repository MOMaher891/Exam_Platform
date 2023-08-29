@extends('layouts.dashboard.layout')
@section('title', 'Invigilator')
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Exams List</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}">DashBoard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.inspector.index') }}">Invigilator</a></li>
                        </li>
                        <li class="breadcrumb-item active">Exams</li>
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
                        <div class="row w-100">
                            @if (auth()->user()->hasRole('superadmin')||auth()->user()->hasRole('analyst'))

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Attend or not</label>
                                    <select class="form-control" id="attend">
                                        <option selected disabled>Choose status</option>
                                        <option value="1">Attend</option>
                                        <option value="0">Not attend</option>
                                    </select>
                                </div>
                            </div>
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

                    </div>
                    <table id="datatable-buttons" class="table dt-responsive nowrap w-100">

                        <thead>

                            <tr>
                                <th>Date</th>
                                <th>Center</th>
                                <th>Shift</th>
                                <th>Attend</th>
                            </tr>
                        </thead>

                        <tbody>

                        </tbody>
                    </table>

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>

@endsection

@section('scripts')
    <script>
        let DataTable = null

        function setDatatable() {
            var url = `{{ route('admin.inspector.all_exams_data',['inspector_id'=>':inspector']) }}`;
            url = url.replace(':inspector',{{$data->id}});

            DataTable = $("#datatable-buttons").DataTable({
                processing: true,
                serverSide: true,
                dom: 'Blfrtip',
                lengthMenu: [5, 10, 20, 50, 100, 200, 500],
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
                    data:"exam_time.exam.date"
                },
                {
                    data:"exam_time.center.name"
                },
                {
                    data:"exam_time.shift"
                },
                {
                    data:"is_done"
                },
                ],
            });
        }

        setDatatable();

        function handleFilter()
        {
            date_from = $("#date_from").val() || ''; // date from
            date_to = $("#date_to").val() || ''; //date to
            attend = $("#attend").val() || ''; //date to
            if(DataTable){
                url = "{{route('admin.inspector.all_exams_data',['inspector_id'=>':center'])}}"+`?is_come=${attend}&date_from=${date_from}&date_to=${date_to}`;
                url = url.replace(':center',{{$data->id}});
                DataTable.ajax.url(url).load();
            }
        }

        function ClearFilter()
        {
            date_from = $("#date_from").val(''); // date from
            date_to = $("#date_to").val(''); //date to
            attend = $("#attend").val('');
            url = "{{route('admin.inspector.all_exams_data',['inspector_id'=>':center'])}}";
                url = url.replace(':center',{{$data->id}});
                DataTable.ajax.url(url).load();

        }
    </script>

    <script>
        //Delete Function
        $(document).on('click', '.delete-btn', function() {
            var inspector_id = $(this).data('id');
            if (confirm("Are you sure you want to delete this inspector?")) {
                $.ajax({
                    type: "GET",
                    url: '/admin/inspector/delete/' + inspector_id,
                    success: function(data) {
                        $('#datatable-buttons').DataTable().ajax.reload();
                        toastr.success('Data deleted successfully!', 'success');
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
            }
        });
    </script>

@endsection
