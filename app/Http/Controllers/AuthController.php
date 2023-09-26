<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function register(){
        return view('auth.register');
    }

    public function connect(){

        $validated = request()->validate(
            [
                'email' => 'required|email',
                'password' => 'required|min:8'
            ]
        );

        if(auth()->attempt($validated)){
            request()->session()->regenerate();

            return redirect()->route('index')->with('success','tu es connecte');
        }
        return redirect()->route('auth.login')->with('échoué', 'connexion échoué');
    }

    public function compte(){
        $validated = request()->validate(
            [
                'name' => 'required|min:3|max:20',
                'email' => 'required|email|unique:users,email,user,id',
                'password' => 'required|min:8|confirmed'
            ]
        );
        User::create(
            [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => bcrypt($validated['password'])
            ]
        );
        return redirect()->route('auth.login')->with('réussite', 'Le Compte a ete crée');
    }

    public function logout(){
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('auth.login')->with('Deconnecter', 'Deconnecte avec succès');
    }
}
