@extends('dashboard.login')
@section('title', 'Error')
@section('content')

    <div class="card-body">
        <div class="ex-page-content text-center">
            <h1>500!</h1>
            <h3>There are error , please try again</h3><br>

            <a class="btn btn-info mb-5 waves-effect waves-light" href="{{ route('admin') }}">Back to
                Dashboard</a>
        </div>
    </div>

@endsection
