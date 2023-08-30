@extends('layouts.dashboard.layout')
@section('title', 'Quiz')
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Quiz List</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}">DashBoard</a></li>
                        </li>
                        <li class="breadcrumb-item active">Quiz</li>
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
                    <h4 class="card-title">Quiz List</h4>
                    <div class="text-center mb-3">
                        @if (auth()->user()->hasPermission('add_exam'))
                        <a href="{{ route('admin.exam.create') }}" class="btn btn-primary">Add Quiz <i
                                class="fa fa-plus"></i></a>
                        @endif
                    </div>
                    <div class="row w-100">
                        @if (auth()->user()->hasRole('superadmin')||auth()->user()->hasRole('analyst'))
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Expired or not</label>
                                <select name="" class=" form-control select" id="expire">
                                        <option value="" selected disabled>Choose Status</option>
                                        <option value="0">Waiting</option>
                                        <option value="1">Expired</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Public or Private</label>
                                <select name="" class=" form-control select" id="type">
                                        <option value="" selected disabled>Choose type</option>
                                        <option value="public">Public</option>
                                        <option value="private">Private</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Paid or not</label>
                                <select name="" class=" form-control select" id="paid">
                                        <option value="" selected disabled>Choose type</option>
                                        <option value="1">Paid</option>
                                        <option value="0">Not paid</option>
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
                    <table id="datatable-buttons" class="table dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>date</th>
                                {{-- <th>Show date</th> --}}
                                <th>Centers</th>
                                <th>Total Price</th>
                                <th>Status</th>
                                <th>Centers</th>
                                <th>Action</th>
                                <th>Attendance</th>
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
            var url = "{{ route('exam.data') }}";

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
                        data: 'date'
                    },
                    // {
                    //     data: 'show_date'
                    // },
                    {
                        data:'type'
                    },
                    {
                        data: 'total_price'
                    },
                    {
                        data: 'status'
                    },
                    {
                        data: 'centers'
                    },
                    {
                        data: 'action'
                    },
                    {
                        data: 'attendance'
                    }
                ],
            });
        }

        setDatatable();

        function handleFilter()
        {
            status = $("#expire").val() || ''; // Expire or not
            type = $("#type").val() || ''; // public or private
            date_from = $("#date_from").val() || ''; // date from
            date_to = $("#date_to").val() || ''; //date to
            paid = $("#paid").val() || ''; //paid or not

            if(DataTable){
                url = "{{route('exam.data')}}"+`?expire=${status}&type=${type}&date_from=${date_from}&date_to=${date_to}&paid=${paid}`;
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
            url = "{{route('exam.data')}}";
            DataTable.ajax.url(url).load();

        }
    </script>

    <script>
        //Delete Function
        $(document).on('click', '.delete-btn', function() {
            var exam_id = $(this).data('id');
            if (confirm("Are you sure you want to delete this quiz?")) {
                $.ajax({
                    type: "DELETE",
                    url: '/admin/exam/delete/' + exam_id,
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
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

    <script>
                $(document).on('click', '.paid-btn', function() {
            var exam_id = $(this).data('id');
            if (confirm("Are you sure you want to pay for this quiz?")) {
                $.ajax({
                    type: "POST",
                    url: '/admin/exam/payment/' + exam_id,
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        $('#datatable-buttons').DataTable().ajax.reload();
                        if(data['success']){
                            toastr.success(data['success']);
                        }
                        else if(data['error']){
                            toastr.error(data['error']);
                        }

                    },
                    error: function(data) {
                        toastr.error('errro','error');

                    }
                });
            }
        });
    </script>
@endsection
