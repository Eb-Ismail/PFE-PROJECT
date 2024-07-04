<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Profile extends User
{
    //tree : locale tous de function 
    use HasFactory;
    use SoftDeletes;

    //protected $guarded = ['id'];
    public function getRouteKeyName(){
        return 'id';
    }
    
    
    // relation one to many inverse with User model
    protected $dates=['created_at']; // to add the date to the created at column in

    //the database table
        protected $fillable = [
        'name',
        'email',
        'password',
        'bio',
        'image',
    ];
    //default image  
     public function getImageAttribute($value) {

         return $value ?? 'profile/profile.jpg';
    }
    
     // recupere publications - profile N-1
    public function publications(){
        return $this->hasMany(Publication::class);
    }
    public static  function createdLastDay()
    {
        return DB::table('profiles')
            ->select(['name','id'])
            ->where('created_at', '>=', Carbon::now()->subDays(1))
            ->get();
    }
}
$profiles = Profile::createdLastDay();
//dd($profiles);

