@extends('layout')

@section('content')
    <style>
        .box {
            border: 5px solid #ddd;
            /* Add border for box */
            border-radius: 5px;
            /* Rounded corners */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            /* Add shadow */
            margin-bottom: 20px;
            /* Spacing between boxes */
            border-top-color: #100159;

        }

        .box-header {
            background-color: #f7f7f7;
            /* Light gray background for header */
            padding: 10px;
            /* Add padding */
            border-bottom: 1px solid #ddd;
            /* Add bottom border */
            border-top-left-radius: 5px;
            /* Rounded corners for top-left */
            border-top-right-radius: 5px;
            /* Rounded corners for top-right */
            display: block;
            /* Use flexbox for layout */
        }

        .box-title {
            margin: 0;
            /* Remove margin */
            font-size: 18px;
            /* Larger font size */
            font-weight: bold;
            /* Bold font weight */
            color: black;
            overflow: hidden;
            /* Hide overflow text */
            text-overflow: ellipsis;
            /* Show ellipsis for overflow text */
            display: -webkit-box;
            /* Use old version of Flexbox for compatibility */
            -webkit-line-clamp: 1;
            /* Limit to two lines */
            -webkit-box-orient: vertical;
            /* Vertical layout */
            line-height: 1.2em;
            /* Set line height */
            max-height: 2.4em;
            /* Limit to two lines */
        }

        .box-body {
            padding: 10px;
            /* Add padding */
            max-height: 100px;
            /* Limit height of body */
            overflow-y: auto;
            /* Add scrollbar if content exceeds height */
        }

        .box-footer {
            background-color: #f7f7f7;
            /* Light gray background for footer */
            padding: 10px;
            /* Add padding */
            border-top: 1px solid #ddd;
            /* Add top border */
            border-bottom-left-radius: 5px;
            /* Rounded corners for bottom-left */
            border-bottom-right-radius: 5px;
            /* Rounded corners for bottom-right */
        }

        .btn {
            margin-top: 5px;
            /* Add space above button */
        }

        .version-author {
            display: flex;
            /* Use flexbox for layout */
            align-items: center;
            /* Align items vertically */
        }

        .version {
            margin-right: 10px;
            /* Add space between version and author */
        }

        .author {
            font-weight: bold;
            color: #100159;
            font-size: 12px;
        }

        .card-header {
            background-color: #f7f7f7;
            /* Light gray background */
            padding: 20px;
            /* Add padding */
            border-bottom: 1px solid #ddd;
            /* Add bottom border */
            display: flex;
            /* Use flexbox for layout */
            justify-content: space-between;
            /* Align items to start and end */
            align-items: center;
            /* Align items vertically */
        }

        .card-header {
            background-color: #f7f7f7;
            /* Light gray background */
        }

        .card-header h2 {
            margin: 0;
            /* Remove default margin */
            color: #333;
            /* Dark text color */
        }


        .form-control-file {
            margin-right: 10px;
            /* Add space between input and button */
        }

        .btn-primary {
            flex-shrink: 0;
            /* Prevent button from shrinking */
        }

        hr {
            border: none;
            /* Remove default border */
            border-top: 1px solid #ddd;
            /* Add top border */
            margin: 10px 0;
            /* Add space above and below */
        }

        .file-drop-area {
            border: 2px dashed #ccc;
            padding: 20px;
            text-align: center;
        }

        /* Style for the file message */
        .file-message {
            color: #777;
        }

        /* Style for the file input */
        .file-input {
            /* Set the background color */
            background-color: #f2f2f2;
            /* Add some padding */
            padding: 10px;
            /* Add border */
            border: 1px solid #ccc;
            /* Set border-radius for rounded corners */
            border-radius: 5px;
            /* Add some margin */
            margin-bottom: 10px;
        }

        /* Style the text inside the file input */
        .file-input input[type="file"] {
            /* Hide the default file input text */
            opacity: 0;
            /* Set font size and color for the text */
            font-size: 16px;
            color: #333;
        }

        /* Style the label text */
        .file-input label {
            /* Style the label text as per your design */
            font-size: 14px;
            color: #666;
            /* Add some margin */
            margin-bottom: 5px;
        }

        /* Style the hover effect */
        .file-input:hover {
            /* Change background color on hover */
            background-color: #e0e0e0;
            /* Add a slight shadow effect */
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        #uploadForm {
            margin-bottom: 5%;
        }

        /* Style for the upload button */
        .file-upload-button {
            background-color: #100159;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 10px;
        }

        /* Style for the upload button on hover */
        .file-upload-button:hover {
            background-color: #100159;
        }
    </style>

    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="page-title">Plugin Management</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item">Plugin Management</li>
                    <li class="breadcrumb-item active">Plugins</li>
                </ul>
            </div>
        </div>
    </div>

    <form id="uploadForm" action="/laradmin/plugins/upload" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="file-drop-area">
            <span class="file-message">To upload a plugin, drag and drop the .zip file here</span>
            <input id="fileInput" class="file-input" name="plugin" type="file" multiple required>
            <button id="uploadButton" class="file-upload-button">Upload a New Plugin</button>
        </div>
    </form>


    <div class="container">
        <div class="card">


            <div class="card-body row">
                @foreach ($plugins as $foldername)
                    <?php
                    $plugin_info = file_get_contents(base_path('plugins/' . $foldername . '/plugin_info.json'));
                    $plugin_data = json_decode($plugin_info);
                    ?>
                    <div class="col-md-4">
                        <div class="box box-hovered mb20 box-primary">
                            <div class="box-header">
                                <h3 class="box-title text1line">{{ $plugin_data->name }}</h3>
                                <div class="version-author">
                                    <small class="version"><i>{{ $plugin_data->version }}</i> By </small>
                                    <span class="author">{{ $plugin_data->author }}</span>
                                </div>
                            </div>
                            <div class="box-body">
                                <div style="max-height: 50px; min-height: 50px;">{{ $plugin_data->description }}</div>
                            </div>
                            <?php
                            //Get the name of the plugin and change it to ums_pay from the name UmsPay
                            $plugin_name = strtolower($plugin_data->name);
                            $plugin_tag_name = str_replace(' ', '_', $plugin_name);
                            ?>
                            <div class="box-footer">
                                @if ($plugin_data->installed == true)
                                    <a href="/laradmin/plugins/uninstall/{{ $foldername }}"
                                        class="btn btn-warning uninstall-plugin"><i class="fa fa-trash"></i> Uninstall</a>
                                @else
                                    <a href="/laradmin/plugins/install/{{ $foldername }}"
                                        class="btn btn-primary install-plugin"><i class="fa fa-download"></i> Install</a>
                                @endif
                                <a href="/laradmin/plugins/remove/{{ $foldername }}"
                                    class="btn btn-danger remove-plugin"><i class="fa fa-trash"></i> Remove</a>
                            </div>
                        </div>
                    </div>
                @endforeach

                @if (count($plugins) == 0)
                    <div class="col-md-12">
                        <div class="alert alert-info" role="alert">
                            <strong>No plugins uploaded.</strong> You can start by uploading some plugins to enhance
                            your system's functionality.
                        </div>
                    </div>
                @endif



            </div>
        </div>
    </div>
@endsection
