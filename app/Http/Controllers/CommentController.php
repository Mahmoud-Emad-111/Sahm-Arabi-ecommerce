<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Traits\SaveImagesTrait;
use App\Traits\RandomIDTrait;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    use SaveImagesTrait, RandomIDTrait;
    //    store comment and rating
   public function Store_Comment(CommentRequest $request){
    Comment::create([
        'comment' => $request->comment,
        'rating' => $request->rating,
        'user_id' => $request->user_id,
        'random_id'=>$this->RandomID(),
    ]);


    return $this->handelResponse('', 'success register');
}

//update data info Comment
public function update(Request $request){
    $validate=Validator::make($request->all(),[
        'id'=> 'required|integer|exists:comments,random_id',
        'comment' => 'required',
        'rating'=>'required',

    ]);
    if($validate->fails()){
        return response()->json($validate->errors());
    }
    $ID=$this->getRealID(Comment::class, $request->id)->id;

    $data = Comment::find($ID);
    $data->update([
     'comment' => $request->comment,
      'rating' => $request->rating,
    ]);
    return $this->handelResponse('', 'success update');
}





// Delete Comment
public function delete(Request $request)
{
    $validate=Validator::make($request->all(),[
        'id'=> 'required|integer|exists:comments,random_id',
    ]);

    if($validate->fails()){
        return response()->json($validate->errors());
    }
    $ID=$this->getRealID(Comment::class, $request->id);
    $data =  Comment::find($ID)[0];
    $data->delete();
    return $this->handelResponse('','The Comment  has been Deleted successfully');


}
}
