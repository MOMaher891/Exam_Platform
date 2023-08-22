@extends('layouts.dashboard.layout')
@section('title','Centers')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Centers</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Centers</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
        
                        <h4 class="card-title">Centers</h4>
                        <div class="text-center mb-3">
                            <button type="button" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#firstmodal">Import Excel</button>
                            <a href="{{asset('assets/excel/center_example.xlsx')}}"  target="__blank" class="btn btn-info" >Download Example</a>
                         
                            <a href="" class="btn btn-primary" >Add Centers <i class="fa fa-plus"></i></a>

                        </div>
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Owner</th>
                                <th>Adderss</th>
                                <th>Phone</th>
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


                                            <!-- First modal dialog -->
                                            <div class="modal fade" id="firstmodal" aria-hidden="true" aria-labelledby="..." tabindex="-1">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Import Excel</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{route('admin.center.upload-center')}}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="row">
                                                                    <div class="form-group mb-3">
                                                                        <label for="">File</label>
                                                                        <input type="file" name="file" class="form-control">
                                                                     
                                                                    </div>
                                                                    

                                                                    <div class="form-group">
                                                                        <button class="btn btn-primary">Save</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                       
                                                    </div>
                                                </div>
                                            </div>

@endsection

@section('scripts')
<script>
     let DataTable = null

function setDatatable() {
    var url = "{{ route('admin.center.data') }}";

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
                data: 'name'
            },
            {
                data: 'user.name'
            },
            {
                data: 'address'
            },
            {
                data: 'phone'
            },
            {
                data: 'action'
            },
        ],
    });
}

setDatatable();


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
