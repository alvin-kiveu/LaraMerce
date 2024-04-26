<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstallerController;
use App\Http\Controllers\AuthController;
use App\Models\User;
use App\Http\Controllers\UpdateController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//ADD A PREFIX TO THE ROUTES
Route::prefix('laradmin')->group(function () {
    Route::get('/install',  [InstallerController::class, 'welcomeMessage'])->name('install.welcome');
    Route::prefix('install')->group(function () {
        Route::get('/check-requirements', [InstallerController::class, 'checkRequirements'])->name('install.check-requirements');
        Route::get('/environmentsetup', [InstallerController::class, 'environmentSetup'])->name('install.environment-setup');
        Route::post('/edit-env', [InstallerController::class, 'changeEnvData']);
        Route::get('/finish', [InstallerController::class, 'finishInstall'])->name('install.finishInstall');
    });
});

Route::middleware('web', 'check.installation')->group(function () {
    Route::prefix('laradmin')->group(function () {
        // AUTH SECTION
        Route::get('/', function () { return view('auth.login'); });
        Route::get('/login', function () { return view('auth.login'); });
        Route::post('/auth/login', [AuthController::class, 'loginUser']);
        Route::get('/auth/logout', [AuthController::class, 'logoutUser']);

        // APP SECTION
        Route::middleware(['auth.user'])->group(function () {
           Route::get('/controlpanel', function () { return view('app.controlpanel'); });
           Route::get('/logs', function () { return view('app.logs'); });

           //ROLES
           Route::prefix('/role')->group(function () {
                Route::get('/add', function () { return view('auth.addrole'); });
                Route::get('/list', [AuthController::class, 'showRoles'])->name('roles.showRoles');
                Route::get('/edit/{id}', [AuthController::class, 'editRole'])->name('roles.editRole');
                Route::get('/delete/{id}', [AuthController::class, 'deleteRole'])->name('roles.deleteRole');
                Route::post('/roleadd', [AuthController::class, 'addRole']);
                Route::post('/roleedit', [AuthController::class, 'editUserRole']);
           });

           //USERS
           Route::prefix('/user')->group(function () {
                Route::get('/add', [AuthController::class, 'addViewUser'])->name('users.addViewUser');
                Route::get('/list', [AuthController::class, 'showUsers'])->name('users.showUsers');
                Route::get('/edit/{id}', [AuthController::class, 'editUser'])->name('users.editUser');
                Route::get('/delete/{id}', [AuthController::class, 'deleteUser'])->name('users.deleteUser');
                Route::post('/useradd', [AuthController::class, 'addUser']);
                Route::post('/useredit', [AuthController::class, 'editUserDetails']);
           });

           //SETTINGS
           Route::prefix('/settings')->group(function () {
                Route::get('/version', [UpdateController::class, 'showVersion'])->name('settings.showVersion');
                Route::post('/update', [UpdateController::class, 'updateApp'])->name('settings.updateApp');
           });


        });

    });

    Route::get('/' , function () { return "This website is managed by Laradminify"; });
});




