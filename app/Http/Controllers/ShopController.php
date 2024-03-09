<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShopRequest;
use App\Http\Resources\creditShopRelationResource;
use App\Http\Resources\creditWalletRelationResource;
use App\Http\Resources\FulldataProductResource;
use App\Http\Resources\ShopproductsResource;
use App\Http\Resources\ShopResource;
use App\Models\Shop;
use App\Models\Shopproduct;
use Illuminate\Support\Facades\Validator;
use App\Traits\SaveImagesTrait;
use App\Traits\RandomIDTrait;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

use function Pest\Laravel\handleExceptions;

class ShopController extends Controller
{

    use SaveImagesTrait, RandomIDTrait;



    protected function registerShop(ShopRequest $request)
    {

            // handle image create
          $logo = $this->saveImage($request->file('logo'), 'Images');
          $ImageCard_one = $this->saveImage($request->file('imageCard_one'), 'imageCard_one');
          $ImageCard_two = $this->saveImage($request->file('imageCard_two'), 'imageCard_two');

         Shop::create([
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
        return $this->handelResponse('', 'success');
    }
    public function Get(){
        $data = Shop::all();
       return ShopResource::collection($data);
      }

     //get data => id just
     public function Get_id(Request $request){
        $validate=Validator::make($request->all(),[
            'id'=>'required|integer|exists:shops,random_id'
        ]);
        if($validate->fails()){
            return response()->json($validate->errors());
        }
        $ID=$this->getRealID(Shop::class, $request->id)->id;
          $data = Shop::findOrFail($ID);
        return ShopResource::make($data);

       }

       public function get_productShop(Request $request){
        $validate=Validator::make($request->all(),[
            'id'=> 'required|integer|exists:shopproduct,random_id',
        ]);
        if($validate->fails()){
            return response()->json($validate->errors());
        }
        $ID=$this->getRealID(Shopproduct::class, $request->id);
        $data = Shop::with('productsShop')->find($ID);
       return FulldataProductResource::collection($data);
       }



           //get_credit id
           public function get_wallet($id){
            $ID=$this->getRealID(Shop::class, $id);
             $data =  Shop::with('walletshops')->findOrFail($ID);

             return creditWalletRelationResource::make($data);
            }
             // get products
           public function get_products($id){
            $data =  Shop::with('products')->findOrFail($id);
            return ShopproductsResource::make($data);
           }


     //update data info Shop
     public function update(Request $request){
        $validate=Validator::make($request->all(),[
        'id'=>'required|integer|exists:shops,random_id',
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

        // if($request->fails()){
        //     return response()->json($request->errors());
        // }
        $ID=$this->getRealID(Shop::class, $request->id);
        $shop = Shop::find($ID);


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



 // Delete shop
 public function delete(Request $request){
 $validate=Validator::make($request->all(),[
    'id'=>'required|integer|exists:shops,random_id'
]);


if($validate->fails()){
    return response()->json($validate->errors());
}


$ID=$this->getRealID(Shop::class, $request->id);
$shop =  Shop::find($ID)[0];


if ($shop->image) {
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
$shop->delete();
return $this->handelResponse('','The shop  has been Deleted successfully');





}
}

