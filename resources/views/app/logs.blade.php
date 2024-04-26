@extends('layout')
@section('content')
  <div class="row">
        {{-- SYSTEM LOGS --}}
        <div class="col-xl-12 col-md-12">
            <div class="card latest-update-card">
                <div class="card-header">
                    <h5>System Logs</h5>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
                            <li><i class="feather icon-maximize full-card"></i></li>
                            <li><i class="feather icon-minus minimize-card"></i></li>
                            <li><i class="feather icon-refresh-cw reload-card"></i></li>
                            <li><i class="feather icon-trash close-card"></i></li>
                            <li><i class="feather icon-chevron-left open-card-option"></i></li>
                        </ul>
                    </div>
                </div>
                <div class="card-block">
                    <div class="scroll-widget">
                        <div class="latest-update-box">
                            <?php
                            //GET SYSTEM LOGS
                            $logs = DB::table('system_logs')->orderBy('created_at', 'desc')->get();
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
