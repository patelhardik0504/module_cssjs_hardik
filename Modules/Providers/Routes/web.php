<?php

use Modules\Providers\Http\Controllers\ProvidersController;
use Modules\Providers\Http\Controllers\API\AuthController;
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




Route::prefix('providers')->group(function() {
    
    Route::get('/', 'ProvidersController@index')->name('provider.index');
    Route::get('/register', [ProvidersController::class, 'register_view'])->name('provider.register');
    Route::get('/login', [ProvidersController::class, 'login_view'])->name('providers.login');
    

    Route::post('/logout', 'ProvidersController@logout')->name('provider.logout');  

    Route::middleware(['auth:provider'])->group(function () {
        Route::get('/dashboard', 'ProvidersController@dashboard')->name('providers.dashboard');
    });
});
Route::post('provider-register', [ProvidersController::class, 'registerPost'])->name('provider.gerenal.register');

Route::post('/provider-login', [ProvidersController::class, 'checklogin'])->name('post.provider.login');
// Route::get('/otp-verify', [ProvidersController::class, 'otpView']);
Route::post('/verify-otp', [ProvidersController::class, 'verify'])->name('verify-otp');

