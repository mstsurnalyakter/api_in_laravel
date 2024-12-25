<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersAuthController extends Controller
{
    public function login(Request $request){
        return 'login success';
    }
    public function signup(Request $request){
        $input = $request->input();
        $input['password'] = bcrypt($input['password']);
        $user=User::create($input);
        $succes = ['token'=>$user->createToken('myApp')->plainTextToken];
        $user['name']=$user->name;
        return ['success'=>'true','result'=>$succes,"message"=>"User created successfully"];
    }
}
