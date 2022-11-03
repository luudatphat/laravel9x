<?php

use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ProvisionServer;
use App\Http\Controllers\VersionController;
use App\Http\Middleware\EnsureTokenIsValid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});




// Route::get('/photos', [PhotoController::class, 'index']);
// Route::get('/photos/create', [PhotoController::class, 'create']);
// Route::post('/photos', [PhotoController::class, 'store']);
// Route::get('/photos/{photo}', [PhotoController::class, 'show']);
// Route::get('/photos/{photo}/edit', [PhotoController::class, 'edit']);
// Route::put('/photos/{photo}', [PhotoController::class, 'update']);
// Route::delete('/photos/{photo}', [PhotoController::class, 'destroy']);

Route::resource('photos', PhotoController::class)
    ->missing(function (Request $request) {
        return Redirect::route('photos.index');
    });

Route::get('/server', ProvisionServer::class);

Route::controller(VersionController::class)->prefix('version')->name('version.')->group(function () {
    Route::get('/test', 'index')->middleware('token');
});
// test
