<?php

namespace App\Http\Controllers;

use App\Mail\profileMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index(Request $request)
    {
// unregister session
        // $lastCount = $request->session()->get('compteur',0);
// recuper la value session  'compteur' et l'incrémente de 1
        // $request->session()-> put('compteur', $lastCount+1);
        //recuper la value 
        // $compteur = $request->session()->get('compteur');

// method2 increment value
      //  $compteur = $request->session()->increment('compteur',1);
        //$compteur = $request->session()->decrement('compteur',2);
// supremer la value
        $compteur = $request->session()->forget('compteur');

// session : Flash,Flush,Reflash,Keep
        // $request->session()->flush(); // suppression
       // $request->session()->flash(); // ajouter new key
       $mailer = new profileMail();
       //dd($mailer->content());
       Mail::to('ismail@ismail.com')->send(new profileMail());
        return view('home',compact('compteur'));
    }
}