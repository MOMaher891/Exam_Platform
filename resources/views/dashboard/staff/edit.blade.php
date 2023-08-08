@extends('layouts.dashboard.layout')
@section('title', 'Edit Staff')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Edit Staff</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin') }}">DashBoard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.staff.index') }}">Staff</a></li>
                                <li class="breadcrumb-item active">Edit Staff</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form class="card-body" id="myForm" method="post" action="{{ route('admin.staff.update') }}">
                            @csrf
                            <h4 class="card-title">Edit <span class="text-danger"> {{ $user->name }}</span></h4>
                            <p class="card-title-desc">Here are examples : You can edit center supervisor or Financial
                                Analyst</p>
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="name"
                                        placeholder="Ex: Mohamed Elnagar" id="example-text-input"
                                        value="{{ $user->name }}" required>
                                    @error('name')
                                        <span class="text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="email" name="email"
                                        placeholder="Ex: example@example.com" id="example-text-input"
                                        value="{{ $user->email }}" required>
                                    @error('email')
                                        <span class="text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label for="example-tel-input" class="col-sm-2 col-form-label">Telephone</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="phone" type="tel"
                                        placeholder="Ex: +971 52 806 741" id="example-tel-input" value="{{ $user->phone }}"
                                        required>
                                    @error('phone')
                                        <span class="text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Role</label>
                                <div class="col-sm-10">
                                    <select class="form-select" name="role" id="selectRole"
                                        aria-label="Default select example" required>
                                        <option selected="" value="" disabled>Choose Role</option>
                                        @foreach ($roles as $role)
                                            <option value='{{ $role->name }}'
                                                @if ($role->name == $user->roles[0]->name) selected @endif>{{ $role->display_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('role')
                                        <span class="text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <!-- end row -->
                            <button type="submit" id="submit" class="btn btn-info waves-effect waves-light"
                                style="margin-top:20px">Save</button>
                            <a href="{{ route('admin.staff.index') }}" class="btn btn-light waves-effect"
                                style="margin-top:20px">Cancel</a>
                        </form>
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
@endsection

@push('scripts')
    @if (Session::has('success'))
        <script>
            toastr.success('{{ Session::get('success') }}', 'success');
        </script>
    @endif

    @if (Session::has('error'))
        <script>
            toastr.error('{{ Session::get('error') }}', 'error');
        </script>
    @endif
@endpush
