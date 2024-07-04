<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class loginController extends Controller
{
    public function show()
    {
        // affcher form
        return view('login.show');
    }

    public function login(Request $request)
    {
        $login = $request->username;
        $password = $request->password;
        $credentials = ['email' => $login , "password" => $password];
        
        //Auth
        if(Auth::attempt($credentials)){
            // Connecter
            $request->session()->regenerate(); // create new session or session :invalidate()
            return to_route("homepage")->with('success','Vous étes bien connecte'. $login .".");
        }else{
            // shi haja ghalta
            return back()->withErrors([
                'username'=>'Email ou mot de pass incorrect.'
            ])->onlyInput('username');
        }
    }

    public function logout()
    {
        Session::flush();

        Auth::logout();

        return to_route('login')->with('success', 'Vous êtes bien déconnecté.');
    }
}
