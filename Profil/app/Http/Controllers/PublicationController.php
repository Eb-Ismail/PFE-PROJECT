<?php

namespace App\Http\Controllers;

use App\Http\Requests\PublicationRequest;
use App\Models\Publication;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class PublicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(){
        $this ->middleware('auth')->except('index');
    }
    

    public function index()
    {
        // afficher publication et selection tout publication database
        $publications = Publication::latest()->paginate();  // 0->3,1->2,2->1 
        return view('publication.index',compact('publications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('publication.create') ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PublicationRequest $request)
    {
        $formFields = $request->validated();
        $this->uploadImage($request,$formFields);
        // stock id dataBase
        $formFields['profile_id'] = Auth::id();
        Publication::create($formFields);
        return to_route('publications.index')->with('success','bien ajouter publication');

    }    
    private function uploadImage(PublicationRequest $request,array &$formFields){
        unset($formFields['image']);
        if($request->hasFile('image')){
            $formFields['image'] = $request->file('image')->store('publication','public');
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(Publication $publication)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Publication $publication,Request $request)
    {   //dd($publication);
        // test utilisateur:permition
    // policy
      // Method 1 Gate
        //Gate::authorize('update',$publication);
      // Method 2  Policy function
        $this->authorize('update',$publication);
     // Method 3 Request
        // if($request->user()->can('update',$publication)){
        //     abort(403);
        // }

        

    //Gates    
        // method 1
        // Gate::authorize('update-publication', $publication);
        // method 2
        // if(!Gate::allows('update-publication', $publication)){
        //     abort(403);
        // }
        return view('publication.edit',compact('publication'));

            //dd($publication->profile_id);
    }
        
    
    /**
     * Update the specified resource in storage.
     */
    public function update(PublicationRequest $request, Publication $publication)
    {
        // test utilisateur:permition 
        Gate::authorize('update-publication', $publication);
        $formFields = $request->validated();
        $this->uploadImage($request,$formFields);
        $publication->fill($formFields)->save();
        
        return to_route('publications.index')->with('success','bien  modifier la publication');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Publication $publication)
    {
        $publication->delete();
        return to_route('publications.index')->with('success','publication   supprimé avec succéss');
    }
}
