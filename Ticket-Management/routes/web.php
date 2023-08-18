<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LabelController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PriorityController;
use App\Http\Controllers\TicketActivityLogController;
use App\Http\Controllers\TicketCommentController;

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

Route::get('/', function () {
    return view('index');
});

Route::middleware('guest')->group(function () {

    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');
    Route::post('register', [RegisteredUserController::class, 'store'])->name('register.store');
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');
    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth')->group(function () {

    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');
    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');
    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');
    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');
    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);
    Route::put('password', [PasswordController::class, 'update'])->name('password.update');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth','role:Administrator'])->controller(UserController::class)->group(function (){
    Route::get('/users','index')->name('users.index');
    Route::get('/user/create','create')->name('users.create');
    Route::post('/user/store','store')->name('users.store');
    Route::get('/user/edit/{user}','edit')->name('users.edit');
    Route::put('/user/update/{user}','update')->name('users.update');
    Route::delete('/user/delete/{user}','destroy')->name('users.delete');
});

Route::middleware('auth')->controller(TicketsController::class)->group(function (){
    Route::get('/tickets','index')->name('tickets.index');
    Route::get('/ticket/create','create')->name('tickets.create');
    Route::post('/ticket/store','store')->name('tickets.store');
    Route::get('/ticket/edit/{ticket}','edit')->name('tickets.edit');
    Route::put('/ticket/update/{ticket}','update')->name('tickets.update');
    Route::delete('/ticket/delete/{ticket}','destroy')->name('tickets.delete');
});

Route::middleware('auth')->controller(CategoryController::class)->group(function (){
    Route::get('/categories','index')->name('category.index');
    Route::get('/category/create','create')->name('category.create');
    Route::post('/category/store','store')->name('category.store');
    Route::get('/category/edit/{category}','edit')->name('category.edit');
    Route::put('/category/update/{category}','update')->name('category.update');
    Route::delete('/category/delete/{category}','destroy')->name('category.delete');
});

Route::middleware('auth')->controller(LabelController::class)->group(function (){
    Route::get('/labels','index')->name('label.index');
    Route::get('/label/create','create')->name('label.create');
    Route::post('/label/store','store')->name('label.store');
    Route::get('/label/edit/{label}','edit')->name('label.edit');
    Route::put('/label/update/{label}','update')->name('label.update');
    Route::delete('/label/delete/{label}','destroy')->name('label.delete');
});

Route::middleware('auth')->controller(PriorityController::class)->group(function (){
    Route::get('/priorities','index')->name('priority.index');
    Route::get('/priority/create','create')->name('priority.create');
    Route::post('/priority/store','store')->name('priority.store');
    Route::get('/priority/edit/{priority}','edit')->name('priority.edit');
    Route::put('/priority/update/{priority}','update')->name('priority.update');
    Route::delete('/priority/delete/{priority}','destroy')->name('priority.delete');
});

Route::middleware('auth')->controller(TicketActivityLogController::class)->group(function (){
    Route::get('/ticketLogs','index')->name('logs.index');
});

Route::middleware('auth')->controller(TicketCommentController::class)->group(function (){
    Route::get('/{ticket}','index')->name('comments.index');
    Route::post('/comments/{ticket}','store')->name('comments.store');
});

require __DIR__.'/auth.php';
