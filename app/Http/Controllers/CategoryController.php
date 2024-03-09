<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\FulldataProductResource;
use App\Traits\SaveImagesTrait;
use Illuminate\Http\Request;

use App\Traits\RandomIDTrait;


use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    use SaveImagesTrait, RandomIDTrait;
    public function store(CategoryRequest $request){
        // handle image create
        $image = $this->saveImage($request->file('image'), 'Images_Category');
        Category::create([
          'name' => $request->name,
          'image' => $image,
          'random_id'=>$this->RandomID(),
        ]);
    return $this->handelResponse('', 'success ');
    }
    public function Get(){

        $data = Category::all();
       return CategoryResource::collection($data);

      }
      
      // this get data All product use product id
      public function Get_id_allProducts(Request $request){
        $validate=Validator::make($request->all(),[
            'id'=> 'required|integer|exists:categories,random_id',
        ]);
        if($validate->fails()){
            return response()->json($validate->errors());
        }
        $ID=$this->getRealID(Category::class, $request->id);
      $data =  Category::with('categories')->find($ID);
       return FulldataProductResource::collection($data);
       }
        //   get data => category
        public function Get_category_id(Request $request){
            $validate=Validator::make($request->all(),[
                'id'=> 'required|integer|exists:categories,random_id',
            ]);
            if($validate->fails()){
                return response()->json($validate->errors());
            }
            $ID=$this->getRealID(Category::class, $request->id);
            $data =  Category::findOrFail($ID);

        return CategoryResource::make($data[0])->resolve();

    }


//update data info Category
public function update(Request $request){



    $validate=Validator::make($request->all(),[
        'id'=> 'required|integer|exists:categories,random_id',
        'name' => 'required|string|max:255',
        'image'=>'required|image',

    ]);
    if($validate->fails()){
        return response()->json($validate->errors());
    }
    $ID=$this->getRealID(Category::class, $request->id)->id;
    $data =  Category::find($ID);
    $image=$data->image;
    // return $elder->image;
    if ($request->hasFile('image')) {
        # code...
                // Step 1: Remove the old file and image

        if ($data->image) {

            $this->fileRemove($data->image);
        }

        // handle update IMAGE data
        $image = $request->file('image')->store('Images_Category','StoreApp');

    }else{

        $validate=Validator::make($request->all(),[
            'image' => 'required|exists:categories,image',


        ]);
        if($validate->fails()){
            return response()->json($validate->errors());
        }

    }

    $data->update([
        'name' => $request->name,
        'image' => $image,

    ]);

    return $this->handelResponse('','The category has been updated successfully');
}





// Delete Category
public function delete($id)
{
  try {
      $user = Category::findOrFail($id);
      $user->delete();

      return $this->handelResponse('success', 'Category deleted successfully!');

  } catch (\Exception $e) {
      // Handle errors, for example, redirect back with an error message
      return redirect()->back()->with('error', 'Error deleting Category: ' . $e->getMessage());
  }
}

}
