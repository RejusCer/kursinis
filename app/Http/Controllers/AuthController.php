<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function signin(Request $request){
        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|max:255',
        ]);

        //prijungti prie paskyros
        if(!auth()->attempt($request->only('email', 'password')))
        {
            return back()->with('status', 'Nepavyko prisijungti!');
        }

        return redirect()->route('main');
    }

    public function register(Request $request){

        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|max:255',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        //prijungti prie paskyros
        if(!auth()->attempt($request->only('email', 'password')))
        {
            return back()->with('status', 'Registracija nepavyko!');
        }

        return redirect()->route('main');
    }

    public function logout(Request $request){
        auth()->logout();

        return redirect()->route('main');
    }
}
