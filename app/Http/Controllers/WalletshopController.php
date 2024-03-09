<?php

namespace App\Http\Controllers;

use App\Http\Requests\WalletshopRequest;
use App\Http\Resources\walletShopResource;
use App\Models\Shop;
use App\Models\walletShop;
use Illuminate\Http\Request;
use App\Traits\SaveImagesTrait;
use App\Traits\RandomIDTrait;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Validator;

class WalletshopController extends Controller
{
    use SaveImagesTrait, RandomIDTrait;
    public function store(Request $request){
        $validate=Validator::make($request->all(),[
            'company'=> 'required',
            'phone_number' =>'required|max:12',
            'shop_id' => 'required|exists:shops,random_id',

            ]);
            if($validate->fails()){
                return response()->json($validate->errors());
            }
            $ID=$this->getRealID(Shop::class, $request->shop_id)->id;
            walletShop::create([
                'company' => $request->company,
                'phone_number' => $request->phone_number,
                'shop_id' => $ID,
                'random_id'=>$this->RandomID(),
                 ]);
                 return $this->handelResponse('', 'success store data');

    }
    public function Get(){

        $data = walletShop::all();
       return walletShopResource::collection($data);
      }

       //update data info walletShop
       public function update(Request $request){
        $validate=Validator::make($request->all(),[
            'id'=> 'required|integer|exists:wallet_shops,random_id',
            'company' => 'required|string|max:255',
            'phone_number' => 'required|max:12',


        ]);
        if($validate->fails()){
            return response()->json($validate->errors());
        }
        $ID=$this->getRealID(walletShop::class, $request->id)->id;
        $data =  walletShop::find($ID);


        $data->update([
            'company'=>$request->company,
            'phone_number'=>$request->phone_number,
        ]);
        return $this->handelResponse('', 'success update');
    }

      // Delete walletShop
 public function delete(Request $request)
 {
    $validate=Validator::make($request->all(),[
        'id'=> 'required|integer|exists:wallet_shops,random_id',
    ]);
    if($validate->fails()){
        return response()->json($validate->errors());
    }
    $ID=$this->getRealID(walletShop::class, $request->id);
    $data =  walletShop::find($ID)[0];


    $data->delete();
    return $this->handelResponse('','The walletShop  has been Deleted successfully');
 }

}

