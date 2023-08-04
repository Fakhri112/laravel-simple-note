<?php

use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\UserController;
use App\Models\User;
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


Route::get('/login', function () {
    return view('login', ['title' => 'Log In']);
})->name('login');

Route::get('/register', function () {
    return view('register', ['title' => 'Sign Up']);
});
Route::get('/forgot-password', function () {
    return view('forgot-password', ['title' => 'Forgot Password']);
})->name('password-reset-form');

Route::get('/verify-email', function () {
    return view('verify-email', ['title' => 'Verify Email']);
})->name('verification.notice');

Route::post('/signup', [UserController::class, 'signup']);
Route::post('/signin', [UserController::class, 'signin']);

Route::middleware(['auth'])->group(function () {

    //////// HOME //////////////
    Route::get('/', function () {
        $user = User::find(auth()->id())->notes;
        return view('note', ['notes' => $user]);
    })->middleware('auth', 'verified');
    Route::post('/create-note', [NoteController::class, 'create']);
    Route::post('/update-note', [NoteController::class, 'update']);
    Route::post('/delete-note', [NoteController::class, 'delete']);


    /////////// EMAIL VERIFICATION ////////////////////
    Route::post('/verify-email-request', [EmailVerificationController::class, 'resendVerifyEmail'])
        ->name('verification.resend');
    Route::get('/verify-email/{id}/{hash}', [EmailVerificationController::class, 'emailVerification'])
        ->middleware('signed')
        ->name('verification.verify');


    Route::post('/logout', [UserController::class, 'signout']);
});

//////// PASSWORD RESET ///////////
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetPassword'])->name('send.password');
Route::get('/forgot-password/{token}', [ForgotPasswordController::class, 'formResetPassword'])->name('token.password');
Route::post('/reset-password', [ForgotPasswordController::class, 'submitNewPassword'])->name('change.password');
