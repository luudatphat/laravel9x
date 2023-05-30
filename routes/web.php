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
use App\Http\Controllers\ProfileController;

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

Route::middleware(['guest:admin'])->group(function () {
    // Login
    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('login', [LoginController::class, 'login']);

    // Register 
    Route::get('register', [LoginController::class, 'register'])->name('register');
    Route::post('register', [LoginController::class, 'createRegister']);
});

Route::middleware([])->group(function () {
    // Logout
    Route::get('logout', [LoginController::class, 'logout']);

    // Home
    Route::get('home', [DasboardController::class, 'index'])->name('home');
    Route::get('home-admin', [DasboardController::class, 'admin'])->name('home.admin');
});


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


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
