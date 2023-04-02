<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Password;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * Display login page.
     *
     * @return Renderable
     */
    public function show()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    // App apis
    public function customerLogin(Request $request)
    {
        $phoneNumber = $request->phoneNumber;
        $password = $request->password;

        if(Auth::attempt(['phoneNumber' => $phoneNumber, 'password' => $password]))
        {
            $id = User::where('phoneNumber', $phoneNumber)->get()->first()->id;

            return response([
                'result' => '1', //success
                'id' => $id
            ]);
        }
        else{
            $count = User::where('phoneNumber', $phoneNumber)->get()->count();

            if($count == 0)
            {
                return response([
                    'result' => '2' // no registered (because the name doesn't exist)
                ]);
            }
            else{
                return response([
                    'result' => '3' // wrong pwd-(name exists, but the wrong pwd)
                ]);
            }
        }
    }
}
