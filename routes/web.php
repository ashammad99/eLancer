<?php
//
//use Illuminate\Support\Facades\Mail;
//use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\ProjectsController;
//
///*
//|--------------------------------------------------------------------------
//| Web Routes
//|--------------------------------------------------------------------------
//|
//| Here is where you can register web routes for your application. These
//| routes are loaded by the RouteServiceProvider within a group which
//| contains the "web" middleware group. Now create something great!
//|
//*/
//
//Route::get('/', function () {
//    return view('home');
//});
//
//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth'])->name('dashboard');
//
//Route::group([
//], function () {
//
//    Route::get('projects/{project}', [ProjectsController::class, 'show'])
//        ->name('projects.show');
//});
//
////require __DIR__.'/auth.php';
//require __DIR__ . '/dashboard.php';
//require __DIR__ . '/freelancer.php';
//require __DIR__ . '/client.php';
//Route::get('/test-mail', function () {
//    Mail::raw('This is a test email from Laravel.', function ($message) {
//        $message->to('test@example.com')
//            ->subject('Test Email');
//    });
//
//    return 'Email sent!';
//});
//


use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessagesController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OTPController;

//use App\Http\Controllers\MessagesController;
//use App\Http\Controllers\PaymentsCallbackController;
//use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\ProjectsController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

//Route::get('/', function () {
//    return view('/home');
//});
Route::group([
    'prefix' => LaravelLocalization::setLocale(),

    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('projects/{project}', [ProjectsController::class, 'show'])
        ->name('project.show');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// require __DIR__.'/auth.php';

// Route::group([
//     'prefix' => 'admin',
//     'as' => 'admin.',
// ], function() {
//     require __DIR__.'/auth.php';
// });
//
Route::get('messages', [MessagesController::class, 'create'])
    ->name('messages');
Route::post('messages', [MessagesController::class, 'store']);
//
Route::get('otp/request', [OTPController::class, 'create'])->name('otp.create');
Route::post('otp/request', [OTPController::class, 'store']);
Route::get('otp/verify', [OTPController::class, 'verifyForm'])->name('otp.verify');
Route::post('otp/verify', [OTPController::class, 'verify']);

require __DIR__ . '/dashboard.php';

require __DIR__ . '/freelancer.php';

require __DIR__ . '/client.php';


//Route::get('payments/create', [PaymentsController::class, 'create'])->name('payments.create');
//Route::get('/payments/callback/success', [PaymentsCallbackController::class, 'success'])->name('payments.success');
//Route::get('/payments/callback/cancel', [PaymentsCallbackController::class, 'cancel'])->name('payments.cancel');
