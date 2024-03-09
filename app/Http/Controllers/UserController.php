<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Requests\UserRequest;
use App\Http\Resources\userCommentResource;
use App\Http\Resources\UserResource;
use App\Models\Comment;
use App\Models\User;
use App\Traits\RandomIDTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use RandomIDTrait;
    public function index(){

     $data = User::all();
    return UserResource::collection($data);
   }
   //    get user id
   public function Get_id(Request $request){
    $validate=Validator::make($request->all(),[
        'id'=> 'required|integer|exists:users',
    ]);

    if($validate->fails()){
        return response()->json($validate->errors());
    }
    $ID=$this->getRealID(User::class, $request->id);
    $data =  User::findOrFail($ID);

   return UserResource::make($data);

   }

    // Show the form to update the user
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return UserResource::make($user);
    }

   public function Update(UserRequest $request,$id){

$user = User::findOrFail($id);
// Update the user
$user->update($request->all());
  // Update password if provided
  if ($request->filled('password')) {
    $user->update(['password' => Hash::make($request->password), ]);
}
    return $this->handelResponse('','The user has been updated successfully');

   }
    // Delete user
    public function delete($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return $this->handelResponse('success', 'User deleted successfully!');

        } catch (\Exception $e) {
            // Handle errors, for example, redirect back with an error message
            return redirect()->back()->with('error', 'Error deleting user: ' . $e->getMessage());
        }
    }
 public function  Store_Comment(CommentRequest $request){


    Comment::create([
        'comment' => $request->comment,
        'rating' => $request->rating,
        'user_id' => $request->user_id,
    ]);
return $this->handelResponse('', 'success create Comment');
 }
//    get commet data -> user
   public function getComment(Request $request){
      $data = User::with('CommentsUsers')->findOrFail($request->id);
      return userCommentResource::make($data);
    }

   public function logout(){
    auth()->user()->currentAccessToken()->delete();
    auth()->guard('web')->logout();
    return response(['success' => true, 'massega'=>'User logged out']);
   }
}
