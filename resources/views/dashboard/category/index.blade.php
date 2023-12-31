@extends('layouts.dashboard.layout')
@section('title', 'Category')
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Category List</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}">DashBoard</a></li>
                        </li>
                        <li class="breadcrumb-item active">Category</li>
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
                    <h4 class="card-title">Category List</h4>
                    <div class="text-center mb-3">
                        <a href="{{ route('admin.category.create') }}" class="btn btn-primary">Add Category <i
                                class="fa fa-plus"></i></a>
                    </div>
                    <table id="datatable-buttons" class="table dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Name</th>
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
            var url = "{{ route('category.data') }}";

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
                        data: 'action'
                    }
                ],
            });
        }

        setDatatable();
    </script>

    <script>
        //Delete Function
        $(document).on('click', '.delete-btn', function() {
            var category_id = $(this).data('id');
            if (confirm("Are you sure you want to delete this category?")) {
                $.ajax({
                    type: "DELETE",
                    url: '/admin/category/delete/' + category_id,
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
@endsection
