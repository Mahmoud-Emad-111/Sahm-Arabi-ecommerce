<?php

namespace App\Http\Controllers;

use App\Http\Requests\CountryRequest;
use App\Http\Requests\GovernorateRequest;
use App\Http\Resources\CountryResource;
use App\Http\Resources\FullGovernorateResource;
use App\Models\Country;
use App\Traits\SaveImagesTrait;

use App\Traits\RandomIDTrait;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CountryController extends Controller
{
    use SaveImagesTrait, RandomIDTrait;
   public function store(CountryRequest $request){
    $logo = $this->saveImage($request->file('logo'), 'Logo_Country');



           Country::create([
            'title' => $request->title,
            'logo' => $logo,
            'random_id'=>$this->RandomID(),
           ]);
           return $this->handelResponse('', 'success register');

   }

   public function get_all(){
       $data = Country::all();
       return CountryResource::collection($data);
   }


   //    get goverenrate data -> Country
   public function getGoverenrate($id){
         $ID=$this->getRealID(Country::class, $id);
        $data = Country::with('governorates')->findOrFail($ID);
         return FullGovernorateResource::make($data);
       }


//update data info Country
public function update(CountryRequest $request, $id){
    $validate=Validator::make($request->all(),[
        'id'=> 'required|integer|exists:countries,random_id',
        'title' => 'required',
        'logo' => 'required|image'

    ]);
    if($validate->fails()){
        return response()->json($validate->errors());
    }
    $ID=$this->getRealID(Country::class, $request->id)->id;
    $data =  Country::find($ID);
    $image=$data->image;
    // return $elder->image;
    if ($request->hasFile('logo')) {
        # code...
                // Step 1: Remove the old file and image

        if ($data->image) {

            $this->fileRemove($data->image);
        }

        // handle update IMAGE logo
        $logo = $this->saveImage($request->file('logo'), 'Logo_Country');

    }else{

        $validate=Validator::make($request->all(),[
            'logo' => 'required|exists:countries,logo',


        ]);
        if($validate->fails()){
            return response()->json($validate->errors());
        }

    }

    $data->update([
        'title' => $request->title,
        'logo' => $image,

    ]);

    return $this->handelResponse('','The country has been updated successfully');

}





// Delete Country
public function delete(Request $request)
{
    $validate=Validator::make($request->all(),[
        'id'=> 'required|integer|exists:countries,random_id',
    ]);
    if($validate->fails()){
        return response()->json($validate->errors());
    }
    $ID=$this->getRealID(Country::class, $request->id);
    $data =  Country::find($ID)[0];

    if ($data->logo) {
        $this->fileRemove($data->logo);
    }
    $data->delete();
    return $this->handelResponse('','The country  has been Deleted successfully');
}

}
