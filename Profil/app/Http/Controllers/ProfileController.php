<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
class ProfileController extends Controller
{
    private const CACHE_KEY = 'profiles';

    public function __construct (){
        $this ->middleware('auth')->only('');
    }

    public function index()
    {
        //$profiles = Profile::paginate(9);
        // cache index
        $profiles = Cache::remember(self::CACHE_KEY,17777,function() {
            return Profile::paginate(9);
        });
        return view('profile.index' ,compact('profiles'));
        
    }
    public function show(string  $id)
    // Affcher detail Profiles
    {
        // $id =$request->id;
// Cache show
        $cachePrefix = 'profile_'.$id;
// Method 1 Cache
            // test cache
         //if(Cache::has($cachePrefix)){
        //     //afficher cache
             //$profile = Cache::get($cachePrefix);
         //}else{
             //$profile = Profile::findOrFail($id);
             // //insert cache
             //Cache::put($cachePrefix,10);
         //};
// Method  Cache 2
        $profile = Cache::remember($cachePrefix,30,function() use ($id) {
            return Profile::findOrFail($id);
        });
        return view('profile.show',compact('profile'));
     } 
    public function create()
    {
        return view("profile.create");
    }
    public function store(ProfileRequest $request )
    {
        // $name = $request->name;
        // $email = $request->email;
        // $password = $request->password;
        // $bio = $request->bio;
        
        // validation: ProfileRequest:rules
        $formField = $request->validated();
       // dd($formField);
            // crypt password
            $password = $request->password;
            $formField['password'] = Hash::make($password);
            //Error upload file: image Null
            $this->uploadImage($request,$formField);

            // image ajouter : recupere image et transfer public
            // $formField['image'] = $request->file('image')->store('profile','public');
            //$formField['image'] = $request->file('image')->storeAs('profile','ismail','public');

        // Insertion
            // Profile::create([
            //     'name' => $name,
            //     'email' =>$email,
            //     'password' =>$password,
            //     'bio' =>$bio,
            // ]);
            Profile::create($formField);
            //Redirections

            // redirect('/home')
            // redirect()->route(...) => to_route(...)
            // redirect()->action(...)
            // back()->withInput()
             // suppression Cache
        Cache::forget(self::CACHE_KEY);
            return redirect()->route('profiles.index')->with('success','Votre compte et bien cree');
    }
    private function uploadImage(ProfileRequest $request,array &$formField){
        unset($formField['image']);
        if($request->hasFile('image')){
            $formField['image'] = $request->file('image')->store('publication','public');
        }
    }

    public function destroy(Profile  $profile)
    {
        $profile->delete();
         // suppression Cache
         Cache::forget(self::CACHE_KEY);
        return to_route('profiles.index')->with('success','le Profile a bien Supprimer');
    }
// Modifier
    public function edit(Profile $profile)
    {
        return view('profile.edit',compact('profile'));
    }

    public function update(ProfileRequest $request , Profile $profile)
    {
        $formField = $request->validated();
        // Hash/Cryptage
        $formField['password'] = Hash::make($request->password);
        //image Modifier
        //Error upload file: image Null
        $this->uploadImage($request,$formField);
        //dd($formField['image']);
        $profile->fill($formField)->save();
         // suppression Cache
         Cache::forget(self::CACHE_KEY);
        return to_route('profiles.show',$profile->id)->with('success','le Profile a ete bien Modifier');
    }

    // private function uploadImage(ProfileRequest $request ,array &$formField)
    // {
    //     // delete value $formField
    //     unset($formField['image']);
    //     //Error upload file: image Null => hasFile : hta tkon 3andha fihier
    //     if($request->hasFile('image')){
    //     //code ajouter image
    //         $formField['image'] = $request->file('image')->store('profile','public');
    //     }else{
    //         $formField['image'] = 'profile/profile.jpg';
    //     }
    // }


}

