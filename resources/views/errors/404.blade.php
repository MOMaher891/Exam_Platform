@extends('dashboard.login')
@section('title', 'Page not found')
@section('content')

    <div class="card-body">
        <div class="ex-page-content text-center">
            <h1>404!</h1>
            <h3>Sorry, page not found</h3><br>

            <a class="btn btn-info mb-5 waves-effect waves-light" href="{{ route('admin') }}">Back to
                Dashboard</a>
        </div>
    </div>

@endsection
