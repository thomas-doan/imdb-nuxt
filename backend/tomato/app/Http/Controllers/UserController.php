<?php

namespace App\Http\Controllers;

use App\Models\user;
use Illuminate\Http\Request;
use App\Http\Resources\userResource;


class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $totuser = user::all();
        return $totuser->toJson(JSON_PRETTY_PRINT);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        user::create($request->all()); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    //public function show($id)
    public function show(user $user,  $id)
    {
        
         $user = user::findOrFail($id); 
        return new userResource($user); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, user $user)
    {
        $user = user::findOrFail($id); 
        $user->name = $request->name;
        $user->email = $request->email;
        $user->admin = $request->admin;
        //$user->body = $request->body;
        if($user->save())
        {
            return new userResource($user);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(user $user,  $id)
    {
        $user = user::findOrFail($id); 
        if($user->delete())
        {
            return new userResource($user);
        }
       
    }
}
