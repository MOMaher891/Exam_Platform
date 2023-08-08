@extends('layouts.dashboard.layout')
@section('title','Roles')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Roles</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Roles</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
        
                        <h4 class="card-title">Roles</h4>
                        <div class="text-center mb-3">
                            <a href="{{route('role.create')}}" class="btn btn-primary" >Add Roles <i class="fa fa-plus"></i></a>
                        </div>
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Notes</th>
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
    var url = "{{ route('role.data') }}";

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
                data: 'display_name'
            },
            {
                data: 'description'
            },
            {
                data: 'action'
            }
        ],
    });
}

setDatatable();


</script>
@endsection
