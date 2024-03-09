<?php

// namespace App\Http\Controllers;

// use App\Http\Requests\CreditshopRequest;
// use App\Http\Resources\creditShopRelationResource;
// use App\Models\CreditShop;
// use App\Models\Shop;
// use Illuminate\Http\Request;

// class creditshopController extends Controller
// {
//     public function store(CreditshopRequest $request){
//         CreditShop::create([
//          'name' => $request->name,
//          'number_card' => $request->number_card,
//          'ccv' => $request->ccv,
//          'date' => $request->date,
//          'shop_id' => $request->shop_id
//           ]);
//           return $this->handelResponse('', 'success');

//     }
//     public function Get(){

//         $data = CreditShop::all();
//        return CreditShop::collection($data);
//       }
//       //update data info CreditShop
//       public function update(CreditshopRequest $request, $id){

//         $data = CreditShop::find($id);
//         $data->update([
//             'name'=> $request->name,
//             'number_card'=> $request->number_card,
//             'ccv'=>  $request->ccv,
//             'date' =>  $request->date,
//         ]);
//         return $this->handelResponse('', 'success update');
//     }

//       // Delete CreditShop
//  public function delete($id)
//  {
//      try {
//          $user = CreditShop::findOrFail($id);
//          $user->delete();

//          return $this->handelResponse('success', 'CreditShop deleted successfully!');

//      } catch (\Exception $e) {
//          // Handle errors, for example, redirect back with an error message
//          return redirect()->back()->with('error', 'Error deleting CreditShop: ' . $e->getMessage());
//      }
//  }


// }
