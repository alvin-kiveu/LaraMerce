@extends('layout')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card  card-outline">
            <div class="card-header">
                <h4>Current Version</h4>
            </div>
            <div class="card-body">
                <p class="lead">LaraAdminify Version:</p>
                <h3>{{ $currentVersion }}</h3> <!-- Display current version -->
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card card-outline">
            <div class="card-header">
                <h4>Latest Version</h4>
            </div>
            <div class="card-body">
                <p class="lead">LaraAdminify Latest Version:</p>
                <h3>{{ $latestVersion }}</h3> <!-- Display latest version -->
            </div>
        </div>
    </div>
</div>
<div class="row mt-4">
    <div class="col-md-12">
        <div class="card card-outline">
            <div class="card-header">
                <h4>Update LaraAdminify</h4>
            </div>
            <div class="card-body">
                <p>Click the button below to update LaraAdminify to the latest version:</p>
                <form action="/laradmin/settings/update" method="post"> <!-- Update button -->
                    @csrf
                    <button type="submit" class="btn btn-primary update-btn"><i class="fas fa-cloud-download-alt mr-2"></i> Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
