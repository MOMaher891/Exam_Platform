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
                                <th>Email</th>
                                <th>Phone</th>
                                <th>National ID</th>
                                <th>Address</th>
                                <th>Total price</th>
                                <th>Status</th>
                                <th>Action</th>
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
            var url = "{{ route('inspector.data') }}";

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
                        data: 'name'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'phone'
                    },
                    {
                        data: 'national_id'
                    },
                    {
                        data: 'address'
                    },
                    {
                        data: 'price'
                    },
                    {
                        data:'status'
                    },
                    {
                        data: 'action'
                    }
                ],
            });
        }

        setDatatable();

        function handleFilter()
        {
            status = $("#statuss").val() || '';
            if(DataTable){
                url = "{{route('inspector.data')}}"+`?status=${status}`;
                DataTable.ajax.url(url).load();
            }
        }

        function ClearFilter()
        {
            status = $('#statuss').val('');
            var url = "{{ route('inspector.data') }}";
            RequestsTable.ajax.url(url).load();

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
