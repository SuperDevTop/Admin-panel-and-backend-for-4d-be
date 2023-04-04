<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store()
    {
        $attributes = request()->validate([
            'username' => 'required|max:255|min:2',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:5|max:255',
            'terms' => 'required'
        ]);
        $user = User::create($attributes);
        auth()->login($user);

        return redirect('/dashboard');
    }

    // App apis
    public function customerSignup(Request $request)
    {
        $name = $request->name;
        $phoneNumber = $request->phoneNumber;
        $password = $request->password;

        $name_count = User::where('username', $name)->get()->count();

        if($name_count != 0)
        {
            return response([
                'result' => '1' // already exists
            ]);
        }

        // $user = new User(); // If the current user is new one, create a new user.
        // $user->username = $name;
        // $user->password = Hash::make($password); // Hash password
        // // $user->password = Hash::make('secret'); // Hash password
        // $user->phoneNumber = $phoneNumber;
        // $user->username = 'test';
        // $user->firstname = 'test';
        // $user->lastname = 'test';
        // $user->email = 'test@gmail.com';
        // $user->save();   

        DB::table('users')->insert([
            'username' => $name,
            'password' => Hash::make($password),
            'phoneNumber' => $phoneNumber
        ]);

        return response([
            'result' => '2' // success
        ]);
    }
}
