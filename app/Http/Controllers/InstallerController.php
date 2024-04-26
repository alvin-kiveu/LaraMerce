<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class InstallerController extends Controller
{

    public function welcomeMessage()
    {
        return view('install.welcome');
    }



    public function checkRequirements()
    {
        // Check PHP version requirement
        $phpVersionRequired = '8.1.0';
        $phpVersionCurrent = phpversion();
        $phpSupported = version_compare($phpVersionCurrent, $phpVersionRequired) >= 0;
        // Check if MySQLi extension is installed
        $mysqliInstalled = extension_loaded('mysqli');

        // Check if PDO extension is installed
        $pdoInstalled = extension_loaded('pdo');
        // Check if pdo_mysql extension is installed
        $pdoMysqlInstalled = extension_loaded('pdo_mysql');
        // Check if fopen is enabled
        $fopenEnabled = function_exists('fopen');
        // Check if CURL is enabled
        $curlInstalled = function_exists('curl_version');
        // Check zip extension
        $zipInstalled = extension_loaded('zip');
        //chck if read and write permission is enabled
        $fileReadWriteEnabled = [
            'read' => is_readable(__FILE__),
            'write' => is_writable(__FILE__)
        ];
        // Pass data to the view
        return view('install.check-requirements', [
            'php' => [
                'current' => $phpVersionCurrent,
                'required' => $phpVersionRequired,
                'supported' => $phpSupported,
            ],
            'mysqliInstalled' => $mysqliInstalled,
            'pdoInstalled' => $pdoInstalled,
            'pdoMysqlInstalled' => $pdoMysqlInstalled,
            'fopenEnabled' => $fopenEnabled,
            'curlInstalled' => $curlInstalled,
            'zipInstalled' => $zipInstalled,
            'fileReadWriteEnabled' => $fileReadWriteEnabled,
        ]);
    }

    public function environmentSetup()
    {
        function generateDBName($prefix = "LM_", $length = 8) {
            $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
            $charactersLength = strlen($characters);
            $randomString = $prefix;
            for ($i = strlen($prefix); $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }
        $dbName = generateDBName();

        return view('install.environment-setup', [
            'dbName' => $dbName,
        ]);
    }

    public function createTable($user_name, $user_email, $user_password)
    {
        //GENRATE A USER ID
        $user_id = uniqid();
        // Create the users table
        DB::statement('CREATE TABLE users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id VARCHAR(255)  NULL,
            username VARCHAR(255)  NULL,
            email VARCHAR(255)  NULL,
            password VARCHAR(255)  NULL,
            role_id varchar(500) DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )');
        // Create the user
        DB::table('users')->insert([
            'user_id' => $user_id,
            'username' => $user_name,
            'email' => $user_email,
            'password' => Hash::make($user_password),
            'role_id' => '1', // Default role id for admin is '1
            'created_at' => now(),
        ]);

        // Create Table for user_roles
        DB::statement('CREATE TABLE user_roles (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT  NULL,
            role_id INT  NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )');

        // Create Table for role_permissions
        DB::statement('CREATE TABLE role_permissions (
            id INT AUTO_INCREMENT PRIMARY KEY,
            role_id INT  NULL,
            permission_id INT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )');

        //carete system logs table
        DB::statement('CREATE TABLE system_logs (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id VARCHAR(255)  NULL,
            action VARCHAR(255)  NULL,
            description TEXT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )');

        return true;
    }


    public function changeEnvData(Request $request)
    {
        // Retrieve ]app data
        $app_name = $request->app_name;
        $app_url = $request->app_url;
        $app_env = $request->app_env;
        $app_debug = $request->app_debug;
        // Retrieve database data
        $database_connection = $request->database_connection;
        $database_host = $request->database_host;
        $database_port = $request->database_port;
        $database_name = $request->database_name;
        $database_username = $request->database_username;
        $database_password = $request->database_password;
        // Retrieve user data
        $user_name = $request->user_name;
        $user_email = $request->user_email;
        $user_password = $request->user_password;
        $user_password_confirmation = $request->user_password_confirmation;
        //CHECK IF PASSWORD MATCHES
        if ($user_password !== $user_password_confirmation) {
            return redirect()->back()->with('error', 'Password does not match');
        }
        // Attempt to connect to the database
        $conn = null;
        $db_connection_failed = false;
        // Try connecting to the database
        if ($database_password === null) {
            $conn = new \PDO("mysql:host={$database_host};port={$database_port}", $database_username);
        } else {
            $conn = new \PDO("mysql:host={$database_host};port={$database_port}", $database_username, $database_password);
        }
        // Check if database connection failed
        if ($conn === null) {
            $db_connection_failed = true;
        }
        // Create the database if connection is successful
        if (!$db_connection_failed) {
            try {
                // Edit .env file
                $envFilePath = base_path('.env');
                $envContent = file_get_contents($envFilePath);
                $envContent = preg_replace('/APP_NAME=.*/', "APP_NAME={$app_name}", $envContent);
                $envContent = preg_replace('/APP_URL=.*/', "APP_URL={$app_url}", $envContent);
                $envContent = preg_replace('/APP_ENV=.*/', "APP_ENV={$app_env}", $envContent);
                $envContent = preg_replace('/APP_DEBUG=.*/', "APP_DEBUG={$app_debug}", $envContent);
                $envContent = preg_replace('/DB_CONNECTION=.*/', "DB_CONNECTION={$database_connection}", $envContent);
                $envContent = preg_replace('/DB_HOST=.*/', "DB_HOST={$database_host}", $envContent);
                $envContent = preg_replace('/DB_PORT=.*/', "DB_PORT={$database_port}", $envContent);
                $envContent = preg_replace('/DB_DATABASE=.*/', "DB_DATABASE={$database_name}", $envContent);
                $envContent = preg_replace('/DB_USERNAME=.*/', "DB_USERNAME={$database_username}", $envContent);
                if ($database_password !== null) {
                    $envContent = preg_replace('/DB_PASSWORD=.*/', "DB_PASSWORD={$database_password}", $envContent);
                }
                file_put_contents($envFilePath, $envContent);
                // Run migrations
                $dbtabelscretion = $this->createTable($user_name, $user_email, $user_password);
                if ($dbtabelscretion) {
                    // Redirect to the finish page
                    return redirect('/laradmin/install/finish')->with('success', 'Environment setup completed successfully');
                } else {
                    return redirect()->back()->with('error', 'Error creating tables');
                }
            } catch (\PDOException $e) {
                // Database connection failed
                return redirect()->back()->with('error', "Database connection failed or database with the name $database_name does not exist");
            }
        } else {
            // Database connection failed
            return redirect()->back()->with('error', "Database connection failed or database with the name $database_name does not exist");
        }
    }

    public function finishInstall()
    {
        return view('install.finish-install');
    }
}
