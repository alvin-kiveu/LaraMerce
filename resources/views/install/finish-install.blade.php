@extends('install.layout')

@section('content')
    <div class="card text-center" id="v_1_2">
        <div class="card-header">
            <h5>Setup Complete</h5>
        </div>
        <div class="card-body">
            <img src="/images/LaraAdminfy_logo.png" alt="LaraAdminify" class="img-fluid mb-3" style="max-width: 200px;">
            <p class="lead">Congratulations! Your environment setup is complete.</p>
            <p class="lead">You can now start using your application.</p>
            <p class="lead">Admin Panel URL: <a href="{{ url('/laradmin') }}" target="_blank">{{ url('/laradmin') }}</a></p>
            <p class="lead">Click the button below to go to the home page.</p>
            <a href="{{ url('/') }}" class="btn btn-primary btn-lg">Go to Home Page</a>
        </div>
        <div class="card-footer text-muted">
            Thank you for choosing LaraAdminify!
        </div>
    </div>
@endsection
