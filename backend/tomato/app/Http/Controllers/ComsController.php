<?php

namespace App\Http\Controllers;

use App\Models\com;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\comsResource;

class ComsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $totuser = com::all();
        return $totuser->toJson(JSON_PRETTY_PRINT);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        com::create($request->all()); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(com $com, $id)
    {
        $com = com::findOrFail($id); 
        return new comsResource($com);
        /* $com = com::find(1);

        return $com->user->name; */
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, com $com)
    {
        $com = com::findOrFail($id); 
        $com->movie_id = $request->movie_id;
        $com->commentaire = $request->commentaire;
        $com->user_id = $request->user_id;

        if($com->save())
        {
            return new comsResource($com);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(com $com,  $id)
    {
        $com = com::findOrFail($id); 
        if($com->delete())
        {
            return new comsResource($com);
        }
       
    }

    public function oneUser($userId) {
        
        $user = user::findOrFail($userId);
        $com = $user->coms()->get();
 
        return response()->json([
            'success' => true,
            'data' => $user,
            'com' => $com
        ]);
    }

    public function MovieUser($movieid) {
        $results = DB::select( DB::raw("SELECT * FROM coms WHERE movie_id = $movieid ORDER BY commentaire"));
        
        return $results;
    }
}
