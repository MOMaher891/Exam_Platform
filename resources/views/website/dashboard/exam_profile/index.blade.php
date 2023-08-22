@extends('layouts.website.dashboard.layout')
@section('title', 'Exams')
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Exam List</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('inspector.home') }}">DashBoard</a></li>
                        </li>
                        <li class="breadcrumb-item active">Exams to Apply</li>
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
                    <h4 class="card-title">Exams List</h4>
                 
                    <table id="datatable-buttons" class="table dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Center</th>                                
                                <th>Shifts</th>
                                <th>Attend</th>
                                {{-- <th>Action</th> --}}
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
            var url = "{{ route('inspector.exam.profile.data') }}";

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
                        data:'date'
                    },
                    {
                        data:'center'
                    },
                    {
                        data:'shift'
                    },
                    {
                        data:'is_done'
                    }
                ],
            });
        }

        setDatatable();

        // function Apply(id)
        // {
        //          $.ajax({
        //              type: 'GET',
        //              url: "{{route('inspector.exam.apply')}}",
        //              data: {
        //                 id,
        //             },
        //              dataType: 'JSON',
        //              success: function (results) {
        //                 if(results.status == true)
        //                 {
        //                     toastr.success('Applyed Successfuly', 'success');
        //                     DataTable.ajax.reload()
        //                 }else{
        //                     toastr.error(results.message, 'success');
        //                 }
        //              },

        //              error:function(result){
        //                 console.log(result);
        //                 alert(error)
        //              }
        //          });

        // }
    </script>

    </script>

@endsection
