<?php

use Illuminate\Support\Facades\Route;
use Plugins\MyApp\Http\Controllers\TestController;

Route::prefix('laradmin')->group(function () {

    Route::get('/test/view', function () {
        return view('app.testview');
    });
    Route::get('/test/controller', [TestController::class, 'testController']);


});
