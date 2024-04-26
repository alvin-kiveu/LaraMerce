@extends('layout')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Notifications</h4>
                </div>
                <div class="card-body">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle mr-2"></i>
                        <strong>Success!</strong> Your settings have been saved. You can now continue to the next step.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <button type="button" class="btn btn-success btn-sm">Take Action</button>
                    </div>
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <i class="fas fa-info-circle mr-2"></i>
                        <strong>Heads up!</strong> We've recently released an update for the dashboard widgets. Make sure to
                        check them out!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <button type="button" class="btn btn-info btn-sm">Take Action</button>
                    </div>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <strong>Warning!</strong> There was a problem with your network connection.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <button type="button" class="btn btn-danger btn-sm">Take Action</button>
                    </div>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        <strong>Attention!</strong> Scheduled maintenance is planned for next Saturday. Please prepare for
                        potential downtime.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <button type="button" class="btn btn-warning btn-sm">Take Action</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-12">
            <div class="card card-outline">
                <div class="card-header">
                    <h4>Welcome, <?php
                    use App\Models\User;
                    $user_id = session()->get('user_id');
                    $user = User::where('user_id', $user_id)->first();
                    //GET USER NAME
                    echo $user->username;
                    ?></h4>
                </div>
                <div class="card-body">
                    <p>Here you can manage your application efficiently using the LaraAdminify control panel.</p>
                </div>
            </div>
        </div>


        <div class="col-md-6">
            <div class="card latest-update-card">
                <div class="card-header">
                    <h5>System Logs</h5>
                </div>
                <div class="card-block">
                    <div class="scroll-widget">
                        <div class="latest-update-box">
                            <?php
                            //GET SYSTEM LOGS
                            $logs = DB::table('system_logs')->orderBy('created_at', 'desc')->limit(5)->get();
                            foreach ($logs as $log) {
                                //CREATE AN ALTER COLOR FOR THE LOGS AUTO GENERATED
                                $colors = array("primary", "success", "danger", "warning", "info");
                                $rand_color = array_rand($colors, 1);
                            ?>
                            <div class="row p-t-20 p-b-30">
                                <div class="col-auto text-right update-meta p-r-0">
                                    <i class="b-<?php echo $colors[$rand_color]; ?> update-icon ring"></i>
                                </div>
                                <div class="col p-l-5">
                                    <a href="#!">
                                        <h6>
                                            <?php
                                            $user_id = $log->user_id;
                                            $user = DB::table('users')->where('user_id', $user_id)->first();
                                            echo $user->username . ' ' . $log->action;
                                            ?>
                                        </h6>
                                    </a>
                                    <p class="text-muted m-b-0"><?php echo $log->description; ?></p>
                                    <p class="text-muted m-b-0">
                                        <?php
                                        $data = $log->created_at;
                                        // CHANGE DATE FORMAT FROM 2024-01-29 11:16:51 TO 29/01/2024 11:16:51 AM
                                        echo $date = date('d/m/Y h:i:s A', strtotime($data));
                                        ?>
                                    </p>
                                </div>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>





    </div>
@endsection
