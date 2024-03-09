<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductcommentResource;
use App\Http\Resources\productResource;
use App\Models\Category;
use App\Models\Comment;
use App\Traits\SaveImagesTrait;
use Illuminate\Support\Facades\Validator;
use App\Traits\StorageFileTrait;
use App\Traits\RandomIDTrait;

use App\Models\Product;
use Illuminate\Http\Request;
class ProductController extends Controller
{
    use SaveImagesTrait,StorageFileTrait, RandomIDTrait;
 //create All Mobile
public function store(Request $request){
    $validate=Validator::make($request->all(),[
        'name'=> 'required|string|max:255',
        'price'=> 'required',
        'sub_description'=> 'required',
        'description'=> 'required',
        'image_array' => ' required', // Assuming 'images'
        'category_id'=> 'required|integer|exists:categories,random_id',

        ]);
        if($validate->fails()){
            return response()->json($validate->errors());
        }
          $ID=$this->getRealID(Category::class, $request->category_id)->id;

        $images = $request->file('image_array');
        $imagePaths = $this->saveImageArray($images, 'Images_product');

      Product::create([
             'name'=> $request->name,
             'price'=> $request->price,
             'sub_description'=> $request->sub_description,
             'description'=> $request->description,
             'category_id'=> $ID,
             'image_array' =>$imagePaths,// Array of image URLs
             'random_id'=>$this->RandomID(),

               ]);
       return $this->handelResponse('', 'success store');
    }
    public function Get(){

        $data = Product::all();
       return productResource::collection($data);
      }

       // get data => product
       public function Get_Product_id(Request $request){
        $validate=Validator::make($request->all(),[
            'id'=> 'required|integer|exists:products,random_id',
        ]);
        if($validate->fails()){
            return response()->json($validate->errors());
        }
        $ID=$this->getRealID(Product::class, $request->id);

       $product =  Product::findOrFail($ID);
       return productResource::make($product[0])->resolve();

        }


         // Retrieve comments for a product
        public function Get_Comments(Request $request){

            $validate=Validator::make($request->all(),[
                'id'=> 'required|integer|exists:products,random_id',
            ]);
            if($validate->fails()){
                return response()->json($validate->errors());
            }
            // return   $ID=$this->getRealID(Comment::class, $request->id);
     return   $data =  Product::with('comments')->findOrFail($request->id);
        return ProductcommentResource::make($data[0])->resolve();

        }


//update data info Product
public function update(Request $request){

    $validate=Validator::make($request->all(),[
        'id'=> 'required|integer|exists:products,random_id',
        'name'=> 'required|string|max:255',
        'price'=> 'required',
        'sub_description'=> 'required',
        'description'=> 'required',
        'image_array' => ' required|image', // Assuming 'images'
        'category_id'=> 'required|exists:categories,id',

    ]);

    if($validate->fails()){
        return response()->json($validate->errors());
    }
    $ID=$this->getRealID(Product::class, $request->id)->id;
    $data = Product::find($ID);
    $image=$data->image;
    if ($request->hasFile('image_array')) {
        # code...
                // Step 1: Remove the old file and image

        if ($data->image) {

            $this->fileRemove($data->image);
        }

        // handle update IMAGE elder
        $image = $this->saveImageArray($request->file('image_array'), 'Images');

    }else{

        $validate=Validator::make($request->all(),[
            'image' => 'required|exists:products,image_array',


        ]);
        if($validate->fails()){
            return response()->json($validate->errors());
        }

    }


    $data->update([
        'name'=> $request->name,
        'price'=> $request->price,
        'sub_description'=> $request->sub_description,
        'description'=> $request->description,
        'image_array' => $image, // Array of image URLs

    ]);
    return $this->handelResponse('', 'success update');


 }
 public function Delete(Request $request){

    $validate=Validator::make($request->all(),[
        'id'=> 'required|integer|exists:elders,random_id',
    ]);
    if($validate->fails()){
        return response()->json($validate->errors());
    }
    $ID=$this->getRealID(Product::class, $request->id);
    $product =Product::find($ID)[0];

    if ($product->image_array) {
        $this->fileRemove($product->image_array);
    }
    $product->delete();
    return $this->handelResponse('','The product  has been Deleted successfully');

}

    }
