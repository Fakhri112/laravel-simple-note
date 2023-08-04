<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function signup(Request $request)
    {
        try {
            $dataField = $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required'
            ]);

            $dataField['password'] = bcrypt($dataField['password']);
            $user = User::create($dataField);
            auth()->login($user);

            ////////// EMAIL VERIFICATION ///////////
            event(new Registered($user));
            return redirect('/');
        } catch (\Throwable $th) {
            return redirect()->to('/register')->with('error', "Make sure your data is valid");
        }
    }



    public function signin(Request $request)
    {
        $dataField = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        if (auth()->attempt(['email' => $dataField['email'], 'password' => $dataField['password']])) {
            $request->session()->regenerate();
            return redirect('/');
        }
        return redirect()->to('/login')->with('error', "Email or Password doesn't match");
    }

    public function signout()
    {
        auth()->logout();
        return redirect('/login');
    }
}
