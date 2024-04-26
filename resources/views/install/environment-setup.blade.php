@extends('install.layout')
@section('content')
    <div class="card" id="v_1_2">
        <div class="card-header">
            <h5>ENVIRONMENT SETUP</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="/laradmin/install/edit-env" class="row">
                @csrf
                <div class="card-title">
                    <h5>App Configuration</h5>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="app_name">App Name</label>
                        <input type="text" class="form-control" id="app_name" name="app_name"
                            value="{{ env('APP_NAME') }}" oninput="removeSpaces(this)">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="app_url">App URL</label>
                        <input type="text" class="form-control" id="app_url" name="app_url"
                            value="{{ env('APP_URL') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="app_env">App Environment</label>
                        <select class="form-control" id="app_env" name="app_env">
                            <option value="local" @if (env('APP_ENV') === 'local') selected @endif>Local</option>
                            <option value="development" @if (env('APP_ENV') === 'development') selected @endif>Development
                            </option>
                            <option value="production" @if (env('APP_ENV') === 'production') selected @endif>Production</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="app_debug">App Debug</label>
                        <select class="form-control" id="app_debug" name="app_debug">
                            <option value="true" @if (env('APP_DEBUG') === 'true') selected @endif>True</option>
                            <option value="false" @if (env('APP_DEBUG') === 'false') selected @endif>False</option>
                        </select>
                    </div>
                </div>

                <div class="card-title" style="border-top: 1px solid #e9ecef; margin-top: 20px; padding-top: 20px;">
                    <h5>Database Configuration</h5>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="database_connection">Database Connection</label>
                        <select class="form-control" id="database_connection" name="database_connection">
                            <option value="mysql" @if (env('DB_CONNECTION') === 'mysql') selected @endif>MySQL</option>
                            {{-- <option value="pgsql" @if (env('DB_CONNECTION') === 'pgsql') selected @endif>PostgreSQL</option>
                        <!-- Add options for other database connections --> --}}
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="database_host">Database Host</label>
                        <input type="text" class="form-control" id="database_host" name="database_host"
                            value="{{ env('DB_HOST') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="database_port">Database Port</label>
                        <input type="text" class="form-control" id="database_port" name="database_port"
                            value="{{ env('DB_PORT') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="database_name">Database Name</label>
                        <input type="text" class="form-control" id="database_name" name="database_name"
                            value="{{ $dbName }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="database_username">Database Username</label>
                        <input type="text" class="form-control" id="database_username" name="database_username"
                            value="{{ env('DB_USERNAME') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="database_password">Database Password</label>
                        <input type="password" class="form-control" id="database_password" name="database_password"
                            value="{{ env('DB_PASSWORD') }}" placeholder="Enter your database password">
                    </div>
                </div>

                <div class="card-title" style="border-top: 1px solid #e9ecef; margin-top: 20px; padding-top: 20px;">
                    <h5>Admin Configuration</h5>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="user_name">Admin Username</label>
                        <input type="text" class="form-control" id="user_name" name="user_name"
                            oninput="removeSpaces(this)" placeholder="Enter your admin username" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="user_email">Admin Email</label>
                        <input type="email" class="form-control" id="user_email" name="user_email" placeholder="Enter your admin email" required>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group">
                        <label for="user_password">Password</label>
                        <input type="password" class="form-control" id="user_password" name="user_password" placeholder="Enter your admin password" required>
                    {{-- <small id="passwordHelpBlock" class="form-text text-muted">
                            Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.]
                        </small> --}}
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="user_password_confirmation">Confirm Password</label>
                        <input type="password" class="form-control" id="user_password_confirmation"
                            name="user_password_confirmation" placeholder="Confirm your admin password" required>
                    </div>
                </div>


                <div class="col-md-12">
                    <a href="/laradmin/install/check-requirements" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-primary">Save & Continue</button>
                </div>


            </form>
        </div>
    </div>

    <script>
        function removeSpaces(input) {
            input.value = input.value.trim();
        }
    </script>
@endsection
