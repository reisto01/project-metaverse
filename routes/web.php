<?php

use App\Http\Controllers\contactUs_controller;
use App\Http\Controllers\Dashboard_controller;
use App\Http\Controllers\MetaLand_Controller;
use App\Http\Controllers\Metaprop_Controller;
use App\Http\Controllers\Register_Controller;
use App\Http\Controllers\shop_controller;
use App\Http\Controllers\userDashboard_controller;
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
Route::middleware('guest')->group(function () {
    Route::get('/login', [Register_Controller::class, 'login_view'])->name('login');
    Route::post('/login', [Register_Controller::class, 'login'])->middleware('throttle:5,1');
    Route::get('/register', [Register_Controller::class, 'registered_view']);
    Route::post('/register', [Register_Controller::class, 'registered'])->middleware('throttle:5,1');
});

Route::get('/', [userDashboard_controller::class, 'index'])->name('home');
Route::get('/shop', [shop_controller::class, 'index'])->name('shop');
Route::get('/faq', [contactUs_controller::class, 'faq'])->name('faq');

Route::middleware(['auth', 'active'])->group(function () {
    Route::get('/contactUs', [contactUs_controller::class, 'index'])->name('contactUs');
    Route::post('/contactUs', [contactUs_controller::class, 'contactUs_post']);
    Route::get('/profile', [contactUs_controller::class, 'profile'])->name('profile');
    Route::post('/updateAccountUser', [Register_Controller::class, 'updateAccountUser']);
    Route::post('/logout', [Register_Controller::class, 'logout'])->name('logout');
});

Route::middleware(['auth', 'active', 'admin'])->group(function () {
    Route::get('/adminpage', [Dashboard_controller::class, 'index']);

    Route::get('/kelolaAkun', [Register_Controller::class, 'kelola_akun']);
    Route::post('/createAccountAdmin', [Register_Controller::class, 'createAccountAdmin']);
    Route::post('/updateAccountAdmin', [Register_Controller::class, 'updateAccountAdmin']);
    Route::post('/delete_account', [Register_Controller::class, 'delete_account']);
    Route::get('/getData_auth/{id}', [Register_Controller::class, 'getData'])->whereNumber('id');

    Route::get('/contactUs_admin', [contactUs_controller::class, 'admin_side']);
    Route::post('/contactUs_delete', [contactUs_controller::class, 'delete_contact_us']);
    Route::get('/getData_mail/{id}', [contactUs_controller::class, 'getData'])->whereNumber('id');
    Route::post('/answereMail', [contactUs_controller::class, 'answereMail']);
    Route::get('/contactUs_print', [contactUs_controller::class, 'contactUs_print']);

    Route::get('/kelolaMetaland', [MetaLand_Controller::class, 'index']);
    Route::post('/inputMetaland', [MetaLand_Controller::class, 'inputMeta']);
    Route::get('/getData/{id}', [MetaLand_Controller::class, 'getData'])->whereNumber('id');
    Route::post('/updateMetaland', [MetaLand_Controller::class, 'updateMeta']);
    Route::post('/delete_landmark', [MetaLand_Controller::class, 'delete_landmark']);

    Route::get('/kelolaMetaprop', [Metaprop_Controller::class, 'index']);
    Route::post('/inputMetaprop', [Metaprop_Controller::class, 'inputMeta']);
    Route::get('/retriveData/{id}', [Metaprop_Controller::class, 'getData'])->whereNumber('id');
    Route::post('/updateMetaprop', [Metaprop_Controller::class, 'updateMeta']);
    Route::post('/delete_properties', [Metaprop_Controller::class, 'delete_properties']);
});
