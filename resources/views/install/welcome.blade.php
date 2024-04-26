@extends('install.layout')
@section('content')
    <div class="card" id="v_1_2">
        <div class="card-header">
            <img src="/images/LaraLMerce_github_banneer_no_bg.png" alt="LaraAdminfy" class="img-fluid">
            <h5 class="mb-3">Welcome to LaraMerce</h5>
            <span class="text-muted">Version 1.0.0</span>
        </div>
        <div class="card-block">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Why LaraMerce?</h4>
                                <p class="card-text">
                                    <b class="font-weight-bold">LaraMerce</b> is a dynamic and innovative Laravel-based eCommerce CMS designed to empower businesses with a seamless and efficient online selling experience.
                                </p>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <b class="font-weight-bold">Easy to Use:</b> LaraMerce  is designed to be user-friendly and intuitive. You don't need to be a tech expert to use it.
                                    </li>
                                    <li class="list-group-item">
                                        <b class="font-weight-bold">Customizable:</b> LaraMerce  is highly customizable. You can create your own plugins, themes, and more.
                                    </li>
                                    <li class="list-group-item">
                                        <b class="font-weight-bold">Secure:</b> LaraMerce  is built with security in mind. It's designed to keep your data safe and secure.
                                    </li>
                                    <li class="list-group-item">
                                        <b class="font-weight-bold">Community:</b> LaraMerce  has a large and active community. You can get help, share your work, and more.
                                    </li>
                                    <li class="list-group-item">
                                        <b class="font-weight-bold">Open Source:</b> LaraMerce  is open source. You can use it for free, and you can contribute to its development.
                                    </li>
                                    <li class="list-group-item">
                                        <b class="font-weight-bold">Documentation:</b> LaraMerce  has extensive documentation. You can find everything you need to know about it.
                                        <a href="https://doc.laramerce.com" target="_blank">Read Documentation</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-primary mt-3"
                onclick="window.location.href='/laradmin/install/check-requirements'">Get Started</button>
            <p class="mt-3">
                <span class="text-muted">Developed by <a href="https://umeskiasoftwares.com" target="_blank">Umeskia
                        Softwares</a> &copy; 2024 -
                    <script>
                        document.write(new Date().getFullYear())
                    </script>
                </span>
            </p>

        </div>
    </div>
@endsection
