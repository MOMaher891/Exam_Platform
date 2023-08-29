@extends('layouts.dashboard.layout')
@section('title', 'Quiz')
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">{{$exam->date}}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}">DashBoard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.exam.index') }}">Exams</a></li>
                        </li>
                        <li class="breadcrumb-item active">Attendance</li>
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
                    <h4 class="card-title">Center List</h4>
                    <div class="text-center mb-3">
                    </div>
                    <div class="row w-100">
                        @if (auth()->user()->hasRole('superadmin')||auth()->user()->hasRole('analyst'))

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Attend or not</label>
                                <select name="" class=" form-control select" id="type">
                                        <option value="" selected disabled>Choose type</option>
                                        <option value="1">Attend</option>
                                        <option value="0">Not attend</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Center</label>
                                <select name="" class=" form-control select" id="center">
                                        <option value="" selected disabled>Choose Center</option>
                                        @foreach ($centers as $center)
                                        <option value="{{$center->id}}">{{$center->name}}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-2">
                        <div class="form-group d-flex" style="margin-top: 30px">
                            <button onclick="handleFilter()" class="btn btn-primary p-2" >Search <i class="fa fa-magnifying-glass"></i></button>
                            <button onclick="ClearFilter()" class="btn btn-light" >Clear</button>
                        </div>
                    </div>
                    <input type="hidden" name="" id="exam_id" value="{{$exam->id}}">
                    @endif
                    <table id="datatable-buttons" class="table dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Center</th>
                                <th>Shift</th>
                                <th>Attend</th>
                                @if (auth()->user()->hasRole('superadmin') || auth()->user()->hasRole('analyst'))
                                <th>Action</th>
                                @endif
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
            var url = "{{ route('exam.attendance_data', ['exam_id' => ':exam']) }}";
            url = url.replace(':exam', {{$exam->id}});
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
                        data: 'observes.name'
                    },
                    {
                        data: 'exam_time.center.name'
                    },
                    {
                        data: 'exam_time.shift'
                    },
                    {
                        data: 'attend'
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
            center_id = $("#center").val() || ''; // Expire or not
            type = $("#type").val() || ''; // public or private

            if(DataTable){
                var url = "{{ route('exam.attendance_data', ['exam_id' => ':exam']) }}"+`?is_come=${type}&center_id=${center_id}`;
                url = url.replace(':exam', {{$exam->id}});
                DataTable.ajax.url(url).load();
            }
        }

        function ClearFilter()
        {
            center_id = $("#center").val(''); // Expire or not
            type = $("#type").val(''); // public or private
            var url = "{{ route('exam.attendance_data', ['exam_id' => ':exam']) }}";
            url = url.replace(':exam', {{$exam->id}});
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
