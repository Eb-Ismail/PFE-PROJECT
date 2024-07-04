<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Http\Resources\ProfileResource;
use App\Models\Profile;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class ProfileController extends Controller
{
    private const CACHE_KEY = 'profile_api';
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        Cache::delete(self::CACHE_KEY);

// Query builder : Les agrégations = التجمعات

      //dd(DB::table('profiles')->where('id',1)->get('name')); // 
      //dd(DB::table('profiles')->where('id',1)->first('name'));
      //dd(DB::table('profiles')->where('id',1)->value('name'));
      //dd(DB::table('profiles')->pluck('name','email')->all());
      
      //dd(DB::table('profiles')->get(['name','id']));
      //dd(DB::table('profiles')->select(['name','id','email'])->where('id','>',1)->get());
      //dd(DB::table('profiles')->select(['name','id','email'])->where('created_at','<',date_format(date_create('2024-03-25'),'Y-m-d'))->get());
      //dd(DB::table('profiles')->select(['name','id','email'])->whereDate('created_at','<','2024-03-25')->get());
      //   dd(DB::table('profiles')->select(['name','id','email'])
      //   ->where([
      //     ['created_at','<',date_format(date_create('2024-03-25'),'Y-m-d')],
      //     ])
      //  ->get());
       
       //dd(DB::table('profiles')->min('created_at'));
      // dd(DB::table('profiles')->where('id','=',1)->doesntExist());
      //dd(DB::table('profiles')->join('publications','profiles.id','=','publications.id')->get());
      //dd(DB::table('profiles')->select(['name','id','email'])->whereDay('created_at','>=','1')->get());
      //dd(DB::table('profiles')->where('created_at', '>=', Carbon::now()->subDays(1))->get());
      
// Débogage = تصحيح الأخطاء
      //dd(DB::table('profiles')->orderBy('name','desc')->get());
      //DB::table('profiles')->orderBy('name','desc')->dd();


        $profiles = Cache::remember(self::CACHE_KEY,14400,function(){
            return ProfileResource::collection(Profile::all());
        });
        return $profiles;
        //return Profile::paginate(2);
        //return Profile::where();
        //return Profile::withTrashed()->get(); // afficher tous profiles database et profiles delete_at
    }

    /**222
     * Store a newly created resource in storage. 
     */
    public function store(Request $request)
    {
        $formField = $request->all();
        // $formField = $request->validated();
        $formField['password'] = Hash::make($request->password);
        $profile = Profile::create($formField);
        // suppression Cache
        Cache::forget(self::CACHE_KEY);
        return new ProfileResource($profile);
    }

    /**
     * Display the specified resource.
     */
    public function show(Profile $profile)
    {
        return new ProfileResource($profile);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profile $profile)
    {
        $formField = $request->all();
    // $formField = $request->validated();
        $formField['password'] = Hash::make($request->password);
        $profile->fill($formField)->save();
    // suppression Cache
        Cache::forget(self::CACHE_KEY);
        return new ProfileResource($profile);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        $profile->delete();
        // suppression Cache
        Cache::forget(self::CACHE_KEY);
        return response()->json([
            'message'=>'le profile est bien supprimer',
            'id'=>$profile->id,
            'errors'=>[]
        ]);
    }
}
