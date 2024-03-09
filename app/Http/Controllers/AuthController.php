<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class AuthController extends Controller
{

    public function register(Request $request){
        $request->validate([
             'Fullname' => 'required|string',
             'phone_number' => 'required',
            'email' =>   'required|string|email|max:255|unique:users',
            'password' => 'required|min:8',
        ]);
      $user = User::create([
                'Fullname' => $request->Fullname,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'password' => Hash::make($request->password),
       ]);
       $response['token'] = $user->createToken($user->email)->plainTextToken;
       $response['email'] = $user->email;
       return $this->handelResponse($response,'register successfully');
       }

       public function login(Request $request){
        $validate = Validator::make($request->all(), [
            'phone_number' => 'required',
            'password' => 'required',
        ]);
        if( $validate->fails()){
            return response()->json($validate->errors());
        }
       if(Auth::attempt(['phone_number' => $request->phone_number, 'password'=> $request->password])){
          $user = Auth::user();
          $response['token'] = $user->createToken($user->email)->plainTextToken;
          $response['phone_number'] = $user->phone_number;
          return $this->handelResponse($response,'login successfully');

       }
       }


}
