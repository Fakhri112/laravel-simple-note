<?php

namespace App\Http\Controllers;

use App\Models\PasswordResets;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function sendResetPassword(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email'
            ]);

            $token = Str::random(64);
            $created_at = Carbon::now();

            if (PasswordResets::where('email', $request->email)->exists()) {
                PasswordResets::where('email', $request->email)->update(['token' => $token]);
            } else {
                PasswordResets::insert([
                    'email' => $request->email,
                    'token' => $token,
                    'created_at' => $created_at
                ]);
            }


            Mail::send('email.password-reset', ['token' => $token], function ($message) use ($request) {
                $message->to($request->email);
                $message->subject('Reset Password');
            });

            return back()->with('success', 'Password Reset Sent!');
        } catch (\Throwable $th) {
            return back()->with('error', 'Error has been occured');
        }
    }

    public function formResetPassword($token)
    {
        $userEmail = PasswordResets::where('token', $token)->pluck('email');
        if (count($userEmail) == 0) {
            return 'Forbidden';
        }
        return view('password-reset', ['email' => $userEmail[0], 'title' => 'Reset Password']);
    }

    public function submitNewPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ]);

        User::where('email', $request->email)->update(['password' => Hash::make($request->password)]);
        PasswordResets::where('email', $request->email)->delete();

        return redirect('/login');
    }
}
