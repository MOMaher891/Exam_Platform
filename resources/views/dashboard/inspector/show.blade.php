@extends('layouts.dashboard.layout')
@section('title', 'Inspector profile')
@section('content')
<style></style>
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Inspector profile</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}">DashBoard</a></li>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.inspector.index') }}">Inspector</a></li>
                        </li>
                        <li class="breadcrumb-item active">{{$inspector->name}}</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form class="card-body" id="myForm" method="post" action="{{ route('admin.category.store') }}">
                    @csrf
                    <h4 class="card-title">Inspector profile @if ($inspector->status == 'accept')
                        <span class="text-success" style="font-weight: bolder;font-size:18px">(Accepted)</span>
                    @elseif($inspector->status == 'cancel')
                        <span class="text-danger" style="font-weight: bolder;font-size:18px">(Rejected)</span>
                    @endif</h4>
                    @if ($inspector->status == 'pending')
                        <p class="card-title-desc">Here are examples : You can accept or cancel inspector </p>
                    @elseif($inspector->status == 'accept')
                        <p class="card-title-desc">Here are examples : You can reject inspector</p>
                    @else
                        <p class="card-title-desc">Here are examples : You can accept inspector</p>
                    @endif
                    <p class="card-title-desc text-danger" style="font-weight: bolder;font-size:16px">Note : Click on image to zoom it</p>

                    <div class="row mb-3">
                        <div class="col-md-4 col-lg-4 col-sm-12">
                            <img id="zoom-img_personal" src="{{asset('uploads/inspector/personal/'.$inspector->img_personal)}}" width="270px" style="object-fit: contain;margin-left:20px;border-radius:20px;box-shadow:1px 1px 15px #CCC" alt="">
                        </div>
                        {{-- <div class="col-md-2 col-lg-2 col-sm-12"></div> --}}
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input class="form-control"
                                    id="example-text-input" value="{{ $inspector->name }}" disabled>
                            </div>
                            <label for="example-text-input" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input class="form-control"
                                    id="example-text-input" value="{{ $inspector->email }}" disabled>
                            </div>
                            <label for="example-text-input" class="col-sm-2 col-form-label">Phone</label>
                            <div class="col-sm-10">
                                <input class="form-control"
                                    id="example-text-input" value="{{ $inspector->phone }}" disabled>
                            </div>
                            <label for="example-text-input" class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-10">
                                <input class="form-control"
                                    id="example-text-input" value="{{ $inspector->address }}" disabled>
                            </div>
                            <label for="example-text-input" class="col-sm-2 col-form-label">National ID</label>
                            <div class="col-sm-10">
                                <input class="form-control"
                                    id="example-text-input" value="{{ $inspector->national_id }}" disabled>
                            </div>
                            <label for="example-text-input" class="col-sm-2 col-form-label">Nationality</label>
                            <div class="col-sm-10">
                                <input class="form-control"
                                    id="example-text-input" value="{{ $inspector->nationality }}" disabled>
                            </div>
                            <label for="example-text-input" class="col-sm-2 col-form-label">Job title</label>
                            <div class="col-sm-10">
                                <input class="form-control"
                                    id="example-text-input" value="{{ $inspector->job_title }}" disabled>
                            </div>
                            <label for="example-text-input" class="col-sm-2 col-form-label">Gender</label>
                            <div class="col-sm-10">
                                <input class="form-control"
                                    id="example-text-input" value="{{ $inspector->gender }}" disabled>
                            </div>
                            <label for="example-text-input" class="col-sm-2 col-form-label">Birth date</label>
                            <div class="col-sm-10">
                                <input class="form-control"
                                    id="example-text-input" value="{{ $inspector->birth_date }}" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-5 mb-3">
                        <h4>Attachments</h4>
                        <div class="col-md-3 col-lg-2 col-sm-12">
                            <img id="zoom-img_passport" src="{{asset('uploads/inspector/passport/'.$inspector->img_passport)}}" width="100%" height="100%" style="object-fit: contain;border-radius:20px;box-shadow:1px 1px 15px #CCC" alt="">
                        </div>
                        <div class="col-md-3 col-lg-2 col-sm-12">
                            <img id="zoom-img_national_front" src="{{asset('uploads/inspector/national/'.$inspector->img_national)}}" width="100%" height="100%" style="object-fit: contain;border-radius:20px;box-shadow:1px 1px 15px #CCC" alt="">
                        </div>
                        <div class="col-md-3 col-lg-2 col-sm-12">
                            <img id="zoom-img_national_back" src="{{asset('uploads/inspector/national_back/'.$inspector->img_national_back)}}" width="100%" height="100%" style="object-fit: contain;border-radius:20px;box-shadow:1px 1px 15px #CCC" alt="">
                        </div>
                        <div class="col-md-3 col-lg-2 col-sm-12">
                            <img id="zoom-img_certificate" src="{{asset('uploads/inspector/certificate/'.$inspector->img_certificate)}}" width="100%" height="100%" style="object-fit: contain;border-radius:20px;box-shadow:1px 1px 15px #CCC" alt="">
                        </div>
                        <div class="col-md-3 col-lg-2 col-sm-12">
                            <img id="zoom-img_certificate_good_conduct" src="{{asset('uploads/inspector/certificate_good_conduct/'.$inspector->img_certificate_good_conduct)}}" width="100%" height="100%" style="object-fit: contain;border-radius:20px;box-shadow:1px 1px 15px #CCC" alt="">
                        </div>
                    </div>

                @if ($inspector->status == 'pending')
            <a href="{{ route('admin.inspector.accept',$inspector->id) }}" class="btn btn-success waves-effect"
                style="margin-top:20px">Accept</a>
            <a href="{{ route('admin.inspector.reject',$inspector->id) }}" class="btn btn-danger waves-effect"
                style="margin-top:20px">Reject</a>
                @elseif($inspector->status == 'accept')
                <a href="{{ route('admin.inspector.reject',$inspector->id) }}" class="btn btn-danger waves-effect"
                    style="margin-top:20px">Reject</a>
            <a href="{{ route('admin.inspector.index') }}" class="btn btn-light waves-effect"
                style="margin-top:20px">Cancel</a>
                @else
                <a href="{{ route('admin.inspector.accept',$inspector->id) }}" class="btn btn-success waves-effect"
                    style="margin-top:20px">Accept</a>
            <a href="{{ route('admin.inspector.index') }}" class="btn btn-light waves-effect"
                style="margin-top:20px">Cancel</a>
                @endif

                </form>
            </div>
        </div> <!-- end col -->
    </div>

@endsection
@section('scripts')
<script>
const img_personal = document.getElementById("zoom-img_personal");
const img_passport = document.getElementById("zoom-img_passport");
const img_national_front = document.getElementById("zoom-img_national_front");
const img_national_back = document.getElementById("zoom-img_national_back");
const img_certificate = document.getElementById("zoom-img_certificate");
const img_certificate_good_conduct = document.getElementById("zoom-img_certificate_good_conduct");


img_personal.addEventListener("click", () => {
    zoom(img_personal);
});
img_passport.addEventListener("click", () => {
    zoom(img_passport);
});
img_national_front.addEventListener("click", () => {
    zoom(img_national_front);
});
img_national_back.addEventListener("click", () => {
    zoom(img_national_back);
});
img_certificate.addEventListener("click", () => {
    zoom(img_certificate);
});
img_certificate_good_conduct.addEventListener("click", () => {
    zoom(img_certificate_good_conduct);
});



function zoom(image){
    if (image.requestFullscreen) {
        image.requestFullscreen();
    } else if (image.mozRequestFullScreen) {
        image.mozRequestFullScreen();
    } else if (image.webkitRequestFullscreen) {
        image.webkitRequestFullscreen();
    } else if (image.msRequestFullscreen) {
        image.msRequestFullscreen();
    }
}
</script>

<script>
    $(document).ready(function() {
    $("#accept").click(function() {
        $.ajax({
            url: "", // Change to your server-side script URL
            method: "GET",   // Change to the appropriate HTTP method
            success: function(response) {
                $("#result").html(response);
            },
            error: function(xhr, status, error) {
                console.error("AJAX request error:", error);
            }
        });
    });
});
</script>
@endsection
{{-- @section('scripts')
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
            var inspector_id = $(this).data('id');
            if (confirm("Are you sure you want to delete this inspector?")) {
                $.ajax({
                    type: "DELETE",
                    url: '/admin/inspector/delete/' + inspector_id,
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
@endsection --}}
