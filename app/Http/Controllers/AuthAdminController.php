<?php

namespace App\Http\Controllers;

use App\Http\Resources\AdminResource;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthAdminController extends Controller
{
   
       public function checklogin(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
     ]);
     
     $admin = Admin::where('email', $request->email)->first();
     if(!$admin || !Hash::check($request->password, $admin->password)){
        return response(['ERROR'=> 'Admin Not Found'], 404);
    
     }
     $token = $admin->createToken($admin->email);
     return AdminResource::make($admin)->additional(['data' =>['token'=> $token->plainTextToken]]);
       }
}
