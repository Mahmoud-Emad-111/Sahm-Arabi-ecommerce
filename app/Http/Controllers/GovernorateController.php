<?php

namespace App\Http\Controllers;

use App\Http\Requests\GovernorateRequest;
use App\Http\Resources\GovernorateResource;
use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Traits\SaveImagesTrait;
use App\Traits\RandomIDTrait;
use Illuminate\Support\Facades\Validator;

class GovernorateController extends Controller
{
    use SaveImagesTrait, RandomIDTrait;
    public function store(GovernorateRequest $request){
       Governorate::create([
          'title' => $request->title,
           'delivery' =>$request->delivery,
           'country_id' =>$request->country_id,
           'random_id'=>$this->RandomID(),
       ]);

       return $this->handelResponse('', 'success register');

    }

    public function get_all(){
        $data =  Governorate::all();
        return GovernorateResource::collection($data);
    }


//update data info Governorate
public function update(Request $request){

    $validate=Validator::make($request->all(),[
            'id'=> 'required|integer|exists:governorates,random_id',
            'title' => 'required',
            'delivery' => 'required',

    ]);
    if($validate->fails()){
        return response()->json($validate->errors());
    }
    $ID=$this->getRealID(Governorate::class, $request->id)->id;

    $data = Governorate::find($ID);
    $data->update([
        'title' => $request->title,
        'delivery' =>$request->delivery,
    ]);
    return $this->handelResponse('', 'success update');
}





// Delete Governorate
public function delete(Request $request)
{
    $validate=Validator::make($request->all(),[
    'id'=> 'required|integer|exists:governorates,random_id',
]);
if($validate->fails()){
    return response()->json($validate->errors());
}
$ID=$this->getRealID(Governorate::class, $request->id);
$data =  Governorate::find($ID)[0];


$data->delete();
return $this->handelResponse('success', 'Governorate deleted successfully!');

}

}
