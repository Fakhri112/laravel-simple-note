<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{

    public function resendVerifyEmail(Request $request)
    {

        $request->user()->sendEmailVerificationNotification();
        return back()->with('success', 'Verification link sent!');
    }

    public function emailVerification(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect()->to('/');
    }
}
