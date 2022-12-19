<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DasboardController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ProvisionServer;
use App\Http\Controllers\TestController;
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

Route::middleware(['guest'])->group(function () {
    // Login
    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('login', [LoginController::class, 'login']);


    // Register 
    Route::get('register', [LoginController::class, 'register'])->name('register');
    Route::post('register', [LoginController::class, 'createRegister']);
});

// Logout
Route::get('logout', [LoginController::class, 'logout'])->middleware('auth');

// Home
Route::get('home', [DasboardController::class, 'index'])->name('home')->middleware('auth');

// Route::get('/photos', [PhotoController::class, 'index']);
// Route::get('/photos/create', [PhotoController::class, 'create']);
// Route::post('/photos', [PhotoController::class, 'store']);
// Route::get('/photos/{photo}', [PhotoController::class, 'show']);
// Route::get('/photos/{photo}/edit', [PhotoController::class, 'edit']);
// Route::put('/photos/{photo}', [PhotoController::class, 'update']);
// Route::delete('/photos/{photo}', [PhotoController::class, 'destroy']);

// Route::resource('photos', PhotoController::class)
//     ->missing(function (Request $request) {
//         return Redirect::route('photos.index');
//     });

// Route::get('/server', ProvisionServer::class);

// Route::controller(VersionController::class)->prefix('version')->name('version.')->group(function () {
//     Route::get('/test', 'index')->middleware('token');
// });
// // test

// Route::get('/form-csrf', [ImageController::class, 'index']);
// Route::post('/form-csrf', [ImageController::class, 'create']);

// Route::get('test', [TestController::class, 'index']);
// Route::post('test', [TestController::class, 'index']);


// // Embed app
// Route::get('', [AuthController::class, 'index'])->middleware('shopify.auth');
// Route::get('/auth/callback', [AuthController::class, 'auth']);
