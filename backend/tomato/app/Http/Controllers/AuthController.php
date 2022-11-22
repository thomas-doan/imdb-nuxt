<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\AuthResource;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        return User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'admin' => $request->input('admin'),
            'password' => Hash::make($request->input('password'))
        ]);
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response([
                'message' => 'Email ou Password invalide!'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $user = Auth::user();

        $token = $user->createToken('token')->plainTextToken;

        $cookie = cookie('jwt', $token, 60 * 24); // 1 day

        return response([
            'message' => $token
        ])->withCookie($cookie);
    }

    public function user()
    {
        return Auth::user();
    }



    public function update(Request $request, $id, user $user)
    {
        $user = user::findOrFail($id); 
        $user->name = $request->name;
        $user->email = $request->email;
        $user->admin = $request->admin;
        $user->password = Hash::make($request->input('password'));
        if($user->save())
        {
            return new AuthResource($user);
        }
        
    }


    public function logout()
    {
        $cookie = Cookie::forget('jwt');

        return response([
            'message' => 'Success'
        ])->withCookie($cookie);
    }

    public function destroy(user $user,  $id)
    {
        $com = user::findOrFail($id); 
        if($com->delete())
        {
            return new AuthResource($user);
        }
       
    }


}
