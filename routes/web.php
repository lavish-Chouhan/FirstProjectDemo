<?php

use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaypalController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\UserController;

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

Route::get('/home', function () {
    return view('home');
});

Auth::routes();


Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [
        'as' => 'admin.index',
        'uses' => function () {

            return view('admin.index');
        }
    ]);

    Route::resource('role', RoleController::class);
    Route::get('users', function () {
        return view('admin.users');
    });

    Route::get('user_data', [UserController::class,'index'])->name('user_data');
    Route::post('store_data', [UserController::class,'store'])->name('store_data');
    Route::get('users/edit/{id}',[UserController::class,'edit']);
    Route::get('users/show/{id}', [UserController::class,'show']);

    Route::resource('invoice', InvoiceController::class);

    Route::get('users/{lang}', function ($lang) {
        App::setlocale($lang);
        return view('admin.users');
    })->name('users/{lang}');

    Route::get('import-form', [UserController::class, 'importForm']);
    Route::post('import',[UserController::class,'import'])->name('user.import');

    Route::get('export-excel', [UserController::class,'exportIntoExcel']);
    Route::get('export-csv', [UserController::class,'exportIntoCSV']);

    Route::get('stripe/{id}', [StripePaymentController::class, 'stripe']);
    Route::post('stripe', [StripePaymentController::class, 'stripePost'])->name('stripe.post');

    Route::post('paypal',[PaypalController::class,'paywithpaypal']);
    Route::get('status',[PaypalController::class,'getPaymentStatus'])->name('status');
    Route::get('test',[StripePaymentController::class,'test']);

});

