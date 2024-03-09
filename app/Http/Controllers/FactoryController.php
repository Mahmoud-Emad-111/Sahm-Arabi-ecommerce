<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreditFactoryRequest;
use App\Http\Requests\FactoryRequest;
use App\Http\Requests\WalletFactoryRequest;
use App\Http\Resources\creditFactoryRelationResource;
use App\Http\Resources\FactoryproductsResource;
use App\Http\Resources\FactoryResource;
use App\Http\Resources\WalletFactoryRelationResource;
use App\Models\Creditfactory;
use  App\Models\Factory;
use App\Models\Factoryproduct;
use App\Traits\SaveImagesTrait;
use App\Traits\RandomIDTrait;

use App\Models\Walletfactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Hash;

class FactoryController extends Controller
{
    use SaveImagesTrait, RandomIDTrait;
    protected function registerFactory(FactoryRequest $request)
    {

         // handle image create
         $logo = $this->saveImage($request->file('logo'), 'Images');
         $ImageCard_one = $this->saveImage($request->file('imageCard_one'), 'imageCard_one');
         $ImageCard_two = $this->saveImage($request->file('imageCard_two'), 'imageCard_two');

        Factory::create([
              'name' => $request->name,
              'logo' => $logo,
              'country' => $request->country,
              'governorate' => $request->governorate,
              'region' => $request->region,
              'address' => $request->address,
              'phone_number' => $request->phone_number,
              'whatsapp_number' => $request->whatsapp_number,
              'urlStore' => $request->urlStore,
              'email' => $request->email,
              'password' => Hash::make($request['password']),
              'workingScops' => $request->workingScops,
              'description' => $request->description,
              'sub_description' => $request->sub_description,
              'imageCard_one' => $ImageCard_one,
              'imageCard_two' => $ImageCard_two,
              'random_id'=>$this->RandomID(),

        ]);
        return $this->handelResponse('', 'success store data ');


    }
    public function Get(){

        $data = Factory::all();
       return FactoryResource::collection($data);
      }


      //get data => id just
      public function Get_id(Request $request){
        $validate=Validator::make($request->all(),[
            'id'=>'required|integer|exists:factories,random_id'
        ]);
        if($validate->fails()){
            return response()->json($validate->errors());
        }
        $ID=$this->getRealID(Factory::class, $request->id)->id;
          $data = Factory::findOrFail($ID);
        return FactoryResource::make($data);

       }

 //get_credit id

     public function get_credit($id){
     $data =  Factory::with('craditFactories')->findOrFail($id);
     return creditFactoryRelationResource::make($data);
     }

  //get_Wallet id

  public function get_wallet($id){
     $data =  Factory::with('walletFactores')->findOrFail($id);
     return WalletFactoryRelationResource::make($data);

   }



   public function get_productFactory(Request $request){
    $validate=Validator::make($request->all(),[
        'id'=> 'required|integer|exists:factoryproduct,random_id',
    ]);
    if($validate->fails()){
        return response()->json($validate->errors());
    }
    $ID=$this->getRealID(Factoryproduct::class, $request->id);
 return $data =  Factory::with('products')->find($ID);
   return FulldataProductResource::collection($data);
   }


        //update data info Shop
        public function update(Request $request){
            $validate=Validator::make($request->all(),[
            'id'=>'required|integer|exists:factories,random_id',
            'name' => 'required|string|max:255',
            'logo'=>'required|image',
            'country'=>'required',
            'governorate'=>'required',
            'region' => 'required',
            'address'=>'required',
            'phone_number'=> 'required|max:12|unique:shops,phone_number',
            'whatsapp_number'=>'required|max:12|unique:shops,whatsapp_number',
            'urlStore'=>'required',
            'email'=>'required|email|unique:shops,email',
            'password' => 'required|string|min:8',
            'workingScops'=>'required',
            'description'=>'required',
            'imageCard_one'=>'required|image',
            'imageCard_two'=>'required|image',
                ]);

            if($request->fails()){
                return response()->json($request->errors());
            }
            $ID=$this->getRealID(Factory::class, $request->id);
            $shop = Factory::find($ID);


            // Step 1: Remove the old file and image
           if($shop->image){
            $this->fileRemove($shop->image);
           }
            // Step 1: Remove the old file and image_card_one
            if($shop->imageCard_one){
                $this->fileRemove($shop->imageCard_one);
               }
                // Step 1: Remove the old file and image_card_two
           if($shop->imageCard_two){
            $this->fileRemove($shop->imageCard_two);
           }

            // handle image create
            $logo = $this->saveImage($request->file('logo'), 'Images');
            $ImageCard_one = $this->saveImage($request->file('imageCard_one'), 'imageCard_one');
            $ImageCard_two = $this->saveImage($request->file('imageCard_two'), 'imageCard_two');


       $shop->update([
           'name' => $request->name,
           'logo' => $logo,
           'country' => $request->country,
           'governorate' => $request->governorate,
           'region' => $request->region,
           'address' => $request->address,
           'phone_number' => $request->phone_number,
           'whatsapp_number' => $request->whatsapp_number,
           'urlStore' => $request->urlStore,
           'email' => $request->email,
           'password' => Hash::make($request['password']),
           'workingScops' => $request->workingScops,
           'description' => $request->description,
           'sub_description' => $request->sub_description,
           'imageCard_one' => $ImageCard_one,
           'imageCard_two' => $ImageCard_two,

       ]);
       return $this->handelResponse('', 'success update');
    }




 // Delete factory
 public function delete(Request $request){
    $validate=Validator::make($request->all(),[
       'id'=>'required|integer|exists:factories,random_id'
   ]);


   if($validate->fails()){
       return response()->json($validate->errors());
   }


   $ID=$this->getRealID(Factory::class, $request->id);
   $factory =  Factory::find($ID)[0];


   if ($factory->image) {
       $this->fileRemove($factory->image);
   }

     // Step 1: Remove the old file and image_card_one
     if($factory->imageCard_one){
       $this->fileRemove($factory->imageCard_one);
      }
       // Step 1: Remove the old file and image_card_two
   if($factory->imageCard_two){
   $this->fileRemove($factory->imageCard_two);
   }
   $factory->delete();
   return $this->handelResponse('','The Factory  has been Deleted successfully');





   }
}
