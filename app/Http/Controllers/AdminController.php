<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest;
use App\Http\Resources\AdminResource;
use App\Http\Resources\DataAdminResource;
use App\Models\Admin;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Traits\SaveImagesTrait;
use App\Traits\RandomIDTrait;

class AdminController extends Controller
{
    use SaveImagesTrait, RandomIDTrait;
    public function index(){

        $data =  Admin::all();
        return DataAdminResource::collection($data);
       }
     // Show the form to update the user
     public function edit($id)
     {
         $user = Admin::findOrFail($id);
         return DataAdminResource::make($user);
     }
     public function approveshop(Request $request) {
        $validate=Validator::make($request->all(),[
            'id'=> 'required|integer|exists:shops,random_id',


        ]);
        if($validate->fails()){
            return response()->json($validate->errors());
        }
        $ID=$this->getRealID(Shop::class, $request->id)->id;
        $data =  Shop::find($ID);

        $data->update([
            'status' => 'approve', // استخدم 'approve' بدلاً من 'approved'
        ]);
          return $this->handelResponse('','The shop update from pending to approve  successfully');

    }
    public function rejectShop(Request $request) {
        $validate=Validator::make($request->all(),[
            'id'=> 'required|integer|exists:shops,random_id',


        ]);
        if($validate->fails()){
            return response()->json($validate->errors());
        }
        $ID=$this->getRealID(Shop::class, $request->id)->id;
        $data =  Shop::find($ID);

        $data->update([
            'status' => 'reject', // استخدم 'approve' بدلاً من 'approved'
        ]);
          return $this->handelResponse('','The shop update from pending to approve  successfully');

    }


     public function Update(AdminRequest $request,$id){

      $user = Admin::findOrFail($id);
     // Update the admin
     $user->update($request->all());
     // Update password if provided
     if ($request->filled('password')) {
      $user->update(['password' => Hash::make($request->password), ]);
      }
     return $this->handelResponse('','The Admin has been updated successfully');

     }
     public function logout(){
        auth()->user()->currentAccessToken()->delete();
        auth()->guard('Admin')->logout();
        return response(['success' => true, 'massega'=>'Admin logged out']);
       }

    }


