<?php

namespace App\Http\Controllers;

use App\Http\Requests\WalletFactoryRequest;
use App\Http\Resources\WalletFactoryResource;
use App\Models\Walletfactory;
use Illuminate\Http\Request;
use App\Traits\SaveImagesTrait;
use App\Traits\RandomIDTrait;
use Illuminate\Support\Facades\Validator;



class WalletfactoryController extends Controller
{
    use SaveImagesTrait, RandomIDTrait;
    public function store(WalletFactoryRequest $request){
        Walletfactory::create([
         'company' => $request->company,
         'phone_number' => $request->phone_number,
         'factory_id' => $request->factory_id,
         'random_id'=>$this->RandomID(),
          ]);
          return $this->handelResponse('', 'success store data');
    }
    public function Get(){

        $data = Walletfactory::all();
       return WalletFactoryResource::collection($data);
      }


      //update data info walletShop
      public function update(Request $request){
        $validate=Validator::make($request->all(),[
            'id'=> 'required|integer|exists:walletfactories,random_id',
            'company' => 'required|string|max:255',
            'phone_number' => 'required|max:12',
        ]);
        if($validate->fails()){
            return response()->json($validate->errors());
        }
        $ID=$this->getRealID(Walletfactory::class, $request->id)->id;
        $data =  Walletfactory::find($ID);


        $data->update([
            'company'=>$request->company,
            'phone_number'=>$request->phone_number,
        ]);
        return $this->handelResponse('', 'success update');
    }

      // Delete Walletfactory

    public function delete(Request $request)
    {
       $validate=Validator::make($request->all(),[
           'id'=> 'required|integer|exists:walletfactories,random_id',
       ]);
       if($validate->fails()){
           return response()->json($validate->errors());
       }
       $ID=$this->getRealID(Walletfactory::class, $request->id);
       $data =  Walletfactory::find($ID)[0];


       $data->delete();
       return $this->handelResponse('','The Walletfactory  has been Deleted successfully');
    }

}
