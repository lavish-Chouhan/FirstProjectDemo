<?php

use App\Events\FormSubmitted;
use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Notifications\SendNotification;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Notification;
use App\Http\Controllers\EnvSettingController;
use App\Notifications\WelcomeEmailNotification;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\StripePaymentController;
use Illuminate\Notifications\Messages\SlackMessage;
use App\Http\Controllers\EmailConfigurationController;
use App\Http\Controllers\StripeConfigController;
use App\Http\Controllers\TestController;

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
    Route::get('invoice_table', [InvoiceController::class, 'index']);
    Route::get('invoice/create', [InvoiceController::class, 'create']);
    Route::post('invoice/create', [InvoiceController::class, 'store']);


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
    Route::get('stripe/refund/{id}',[StripePaymentController::class,'refund']);

    // subscribe
    Route::get('subscribe', function () {
        return view('user.subscribe');
    });

    Route::get('/home', [UserController::class,'index'])->name('home');
    Route::get('/plans', [PlanController::class,'index'])->name('plans.index');
    Route::get('/plan/{plan}', [PlanController::class,'show'])->name('plans.show');
    Route::post('/subscription', [SubscriptionController::class,'create'])->name('subscription.create');

    //Routes for create Plan
    Route::get('create/plan', [SubscriptionController::class,'createPlan'])->name('create.plan');
    Route::post('store/plan', [SubscriptionController::class,'storePlan'])->name('store.plan');

    Route::get('dash', function () {
        return view('configuration.dashboard');
    });
    Route::post("configuration", [EmailConfigurationController::class, "createConfiguration"])
    ->name("configuration.store");

    Route::get("email", [EmailConfigurationController::class, "composeEmail"])->name("email");
    Route::post('email', [EmailConfigurationController::class, 'sendEmail']);

    Route::get("emailconfig", [EnvSettingController::class,'emailSet']);

    Route::get('event', [EventController::class,'index']);
    Route::post('subscribe', [EventController::class,'subscribe']);

    Route::get('/counter',function(){
        return view('counter');
    });

    Route::get('/sender',function(){
        return view('sender');
    });
    Route::post('/sender',function(){
        $text = request()->text;
        event (new FormSubmitted($text));
    });

    Route::get('stripeinput', [StripeConfigController::class,'input']);
    Route::post('store',[StripeConfigController::class,'store'])->name("store");

});

Route::get('test',[TestController::class,'test']);


Route::stripeWebhooks('stripe-webhook');
