<?php

use App\Services\Calcul;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\PublicationController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/








Route::get('/',[HomeController::class,'index'])->name('homepage');

/*
// Route group
Route::name('profiles.')->prefix('profiles')->group(function(){
    // Controller group
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/','index')->name('index');
        // Ajouter
        Route::get('/create','create')->name('create');
        Route::post('/','store')->name('store');
        // delete
        Route::delete('/{profile}','destroy')->name('destroy');
        // Update
        Route::get('/{profile}/edit','edit')->name('edit');
        Route::put('/{profile}','update')->name('update');
        // detail show
        Route::get('/{profile}','show')->where('profile','\d+')->name('show');
    });
}); // valid id sera numerique
*/


// Route resource
Route::resource('profiles',ProfileController::class);
Route::resource('publications',PublicationController::class);




/*
Route::get('/',[HomeController::class,'index'])->name('homepage');

Route::get('/profiles',[ProfileController::class,'index'])->name('profiles.index');

// Ajouter
Route::get('/profiles/create',[ProfileController::class,'create'])->name('profiles.create');
Route::post('/profiles',[ProfileController::class,'store'])->name('profiles.store');

// delete
Route::delete('/profiles/{profile}',[ProfileController::class,'destroy'])->name('profiles.destroy');

// Update
Route::get('/profiles/{profile}/edit',[ProfileController::class,'edit'])->name('profiles.edit');
Route::put('/profiles/{profile}',[ProfileController::class,'update'])->name('profiles.update');

// detail show
Route::get('/profiles/{profile}',[ProfileController::class,'show'])
->where('profile','\d+') // valid id sera numerique
->name('profiles.show');
*/


// login et logout
// Auth
Route::middleware('guest')->group(function(){
    Route::get('/login',[loginController::class,'show'])->name('login.show');
    Route::post('/login',[loginController::class,'login'])->name('login');
});
// Deconnexion
Route::get('/logout',[loginController::class,'logout'])->name('login.logout')->middleware('auth');

Route::get('/information',[InfoController::class,'index'])->name('information.index');









Route::get('/google',function(){
    dd(Route::current()); // object route
    // dd(Route::currentRouteName()); // name action 
   // dd(Route::currentRouteAction());  // action index,store .....

   // transfer utilisateur vers un site extern 
    return redirect()->away('https://www.google.com');
})->name('route');

// argument optionnel
Route::get('/home1/{n}/{a?}', function($n , $a = 19) {
    return 'Bonjour ' . $n .' Age est '. $a ;
});

// Service container : (ContainerInterface $container)
// injection de dépendances : (Calcul $calcul) , (Request $request)
Route::get('/somme/{a}/{b}',function($a,$b,Calcul $calcul){
    
    return $calcul->somme($a,$b);
});

// 49: Request input,string,date
Route::view('/form','form');
Route::post('/form',function(Request $request){
    //dd($request)->input_field;
    dd($request->input('input_field','default value...'));
    //dd($request->string('input_field')->upper());
// date
    $request->mergeIfMissing(['input_field'=>date('Y-m-d')]);
    dd($request->input('input_field'));
// whenHas et whenFilled
    //$request->whenHas(['input_field' , 'input_ddd'],function (){
       // return ....
    //}
})->name('form');



// 50 : Response (download,afficher)
// route callback 
Route::get('/doo',function(){
    return response()->download('storage/profile/2BKMb3Oron9RFVskCyjPViwMGF4Wpc7WgAa7wTGa.jpg',disposition:'inline'); // Utiliser download dossier public 
    //return response()->file();    // utiliser afficher
    //return new Response('Salam'); 
}); 

// 51 : Cookies(create,destroy
// afficher  les cookies envoyés par le client
Route::get('/cookie/get',function(Request $request){
    // recuper la value age
    return ($request->cookie('age'));
});
//  creer un cookie et l'envoyer
Route::get('/cookie/set/{cookie}',function($cookie){
    $response = new Response();
    $cookieObject = cookie()->forever('age',$cookie);
    return $response->withCookie($cookieObject);
});

// 52 : Header + Request
// content-type: application/json image/png
// Cache
// 404,200,

// Header : ensemble de information transfer Server -> navigate
Route::get('/headers',function(Request $request){
    $response = new Response(['data'=>'ok']);
    // Lecteurs header
    //dd($request->header());
    return $response->withHeaders([
        'Content-Type'=>'Application/json',
        'X-Ismail'=>"Yes"
    ]);
});

// Request
Route::get('/request',function(Request $request){
   //  dd($request->url(),$request->fullUrl()); url : http://127.0.0.1:8000/request  fulUrl:http://127.0.0.1:8000/request?name
   //  dd($request->path());    // apres/ : request
   //  dd($request->is('request'));  // request true or false
   //  dd($request->host());  // 127.0.0.1
    // dd($request->Method());   // GET
    // dd($request->isMethod('GET')); // true or false
    dd($request->ip());  // api utilisateur 127.0.0.1

});