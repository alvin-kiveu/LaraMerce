<?php
//CHECK IF USER IS LOGGED IN
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>LARAMERCE</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description"
        content="LaraMerce is a dynamic and innovative Laravel-based eCommerce CMS designed to empower businesses with a seamless and efficient online selling experience." />
    <meta name="keywords"
        content="LaraMerce, eCommerce, Laravel, CMS, Admin Panel, Online Store, Shopping Cart, Online Shopping, Laravel eCommerce, Laravel CMS" />
    <meta name="author" content="colorlib" />
    <link rel="icon" href="/images/laraMerce_logo.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="/dist/bower_components/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/dist/assets/pages/waves/css/waves.min.css" type="text/css" media="all">
    <link rel="stylesheet" type="text/css" href="/dist/assets/icon/feather/css/feather.css">
    <link rel="stylesheet" type="text/css" href="/dist/assets/css/font-awesome-n.min.css">
    <link rel="stylesheet" href="/dist/bower_components/chartist/css/chartist.css" type="text/css" media="all">
    <link rel="stylesheet" type="text/css" href="/dist/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="/dist/assets/css/widget.css">
    <link rel="stylesheet" href="/dist/assets/css/style.css">
    <link rel="stylesheet" href="/dist/assets/css/main.css">
    <link rel="stylesheet" type="text/css" href="/dist/bower_components/sweetalert/css/sweetalert.css">
    <link rel="stylesheet" type="text/css"
        href="/dist/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="/dist/assets/pages/data-table/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css"
        href="/dist/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="/dist/assets/css/component.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/super-build/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <link rel="stylesheet" href="/dist/bower_components/select2/css/select2.min.css" />
    <link rel="stylesheet" type="text/css"
        href="/dist/bower_components/bootstrap-multiselect/css/bootstrap-multiselect.css" />
    <link rel="stylesheet" type="text/css" href="/dist/bower_components/multiselect/css/multi-select.css" />
    <style>
        .header-navbar .navbar-wrapper .navbar-logo[logo-theme=theme6] {
            background: #100159;
        }

        .header-navbar .navbar-wrapper .navbar-logo[logo-theme=theme6] {
            background: #100159;
        }

        .pcoded .pcoded-navbar[navbar-theme=theme1] .nav-user,
        .pcoded .pcoded-navbar[navbar-theme=theme1] .pcoded-inner-navbar {
            background-color: #100159;
        }

        .card-outline {
            border-top: 5px solid #100159;
        }

        .btn-primary {
            background-color: #100159;
            border-color: #100159;
        }
    </style>
</head>

<body>

    <div class="loader-bg">
        <div class="loader-bar"></div>
    </div>

    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">

            <nav class="navbar header-navbar pcoded-header">
                <div class="navbar-wrapper">
                    <div class="navbar-logo">
                        <a class="mobile-menu" id="mobile-collapse" href="#!">
                            <i class="fa fa-bars"></i>
                        </a>
                        <a href=""
                            style="margin-left:10%; position: absolute; top: 50%; transform: translateY(-50%);">
                            <img class="img-fluid" src="/images/LaraLMerce_github_banner.png" alt="Theme-Logo"
                                style="width: 150px; height: auto;">
                        </a>

                        <a class="mobile-options waves-effect waves-light">
                            <i class="fa fa-sign-out-alt"></i>
                        </a>
                    </div>
                    <div class="navbar-container container-fluid">
                        <ul class="nav-left">
                            <li>
                                <a href="#!" onclick="javascript:toggleFullScreen()"
                                    class="waves-effect waves-light">
                                    <i class="full-screen feather icon-maximize"></i>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav-right">
                            <li class="user-profile header-notification">
                                <div class="dropdown-primary dropdown">
                                    <div class="dropdown-toggle" data-toggle="dropdown">
                                        <img src="/dist/assets/images/user.png" class="img-radius"
                                            alt="User-Profile-Image">
                                        <span>
                                            <?php
                                            use App\Models\User;
                                            $user_id = session()->get('user_id');
                                            $user = User::where('user_id', $user_id)->first();
                                            //GET USER NAME
                                            echo 'Welcome,' . ' ' . $user->username;
                                            ?>
                                        </span>
                                        <i class="feather icon-chevron-down"></i>
                                    </div>
                                    <ul class="show-notification profile-notification dropdown-menu"
                                        data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                        <li>
                                            <a href="/laradmin/auth/logout">
                                                <i class="feather icon-log-out"></i> Logout
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>




            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">

                    <nav class="pcoded-navbar">
                        <div class="nav-list">
                            <div class="pcoded-inner-navbar main-menu">
                                <ul class="pcoded-item pcoded-left-item">
                                    <?php
                                    use App\Models\Menu;
                                    $commonMenuItems = Menu::getCommonMenuItems();
                                        foreach ($commonMenuItems as $menuItem) {
                                            if (!isset($menuItem['submenu'])) {
                                            ?>
                                    <li class="">
                                        <a href="<?= $menuItem['url'] ?>" class="waves-effect waves-dark">
                                            <span class="pcoded-micon">
                                                <i class="<?= $menuItem['icon'] ?>"></i>
                                            </span>
                                            <span class="pcoded-mtext"><?= $menuItem['text'] ?></span>
                                        </a>
                                    </li>
                                    <?php
                                            } else {
                                            ?>
                                    <li class="pcoded-hasmenu">
                                        <a href="javascript:void(0)" class="waves-effect waves-dark">
                                            <span class="pcoded-micon">
                                                <i class="<?= $menuItem['icon'] ?>"></i>
                                            </span>
                                            <span class="pcoded-mtext"><?= $menuItem['text'] ?></span>
                                        </a>
                                        <ul class="pcoded-submenu">
                                            <?php foreach ($menuItem['submenu'] as $subItem) { ?>
                                            <li class>
                                                <a href="<?= $subItem['url'] ?>" class="waves-effect waves-dark">
                                                    <span class="pcoded-mtext"><?= $subItem['text'] ?></span>
                                                </a>
                                            </li>
                                            <?php } ?>
                                        </ul>
                                    </li>
                                    <?php
                                            }
                                        }

                                    ?>


                                    <li>
                                        <a href="/laradmin/auth/logout" class="waves-effect waves-dark">
                                            <span class="pcoded-micon">
                                                <i class="feather icon-log-out"></i>
                                            </span>
                                            <span class="pcoded-mtext">Logout</span>
                                        </a>
                                    </li>


                                    <li class="active">
                                        <a href="#" class="waves-effect waves-dark text-white">
                                            <!-- Add text-white class here -->
                                            <span class="pcoded-micon">
                                                <i class="feather icon-info"></i>
                                            </span>
                                            <span class="pcoded-mtext">Version 1.0.0</span>
                                            <!-- Adjust the version number as needed -->
                                        </a>
                                    </li>

                                </ul>






                            </div>
                        </div>
                    </nav>

                    <div class="pcoded-content">

                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <div class="page-body">

                                        @if (session('error'))
                                            <div class="alert alert-danger">
                                                {{ session('error') }}
                                            </div>
                                        @endif
                                        @if (session('success'))
                                            <div class="alert alert-success">
                                                {{ session('success') }}
                                            </div>
                                        @endif
