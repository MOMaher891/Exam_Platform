@extends('layouts.dashboard.layout')
@section('title', 'Staff')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Staff List</h4>

                            <table id="alternative-page-datatable" class="table dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Telphone</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($staff as $stf)
                                        <tr>
                                            <td>{{ $stf->name }}</td>
                                            <td>{{ $stf->email }}</td>
                                            <td>{{ $stf->phone }}</td>
                                            <td>{{ $stf->roles[0]->display_name }}</td>
                                            <td>
                                                <a href="{{ route('admin.staff.edit', ['stf_id' => $stf->id]) }}"><i
                                                        class="ri-edit-box-line"></i></a>
                                                <a href="{{ route('admin.staff.delete', ['stf_id' => $stf->id]) }}"><i
                                                        class="ri-delete-bin-5-line text-danger"></i></a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-danger text-center">There is no data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
        </div>
    </div>

@endsection
