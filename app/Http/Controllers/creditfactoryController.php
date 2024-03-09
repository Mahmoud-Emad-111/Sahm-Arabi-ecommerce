<?php

// namespace App\Http\Controllers;

// use App\Http\Requests\CreditFactoryRequest;
// use App\Models\Creditfactory;
// use Illuminate\Http\Request;

// class creditfactoryController extends Controller
// {
//     public function store(CreditFactoryRequest $request){
//         Creditfactory::create([
//          'name' => $request->name,
//          'number_card' => $request->number_card,
//          'ccv' => $request->ccv,
//          'date' => $request->date,
//          'factory_id' => $request->factory_id
//           ]);
//           return $this->handelResponse('', 'success store data');

//     }

//       //update data info CreditFactory
//       public function update(CreditFactoryRequest $request, $id){

//         $data = Creditfactory::find($id);
//         $data->update([
//             'name'=> $request->name,
//             'number_card'=> $request->number_card,
//             'ccv'=>  $request->ccv,
//             'date' =>  $request->date,
//         ]);
//         return $this->handelResponse('', 'success update');
//     }

//       // Delete Creditfactory
//  public function delete($id)
//  {
//      try {
//          $user = Creditfactory::findOrFail($id);
//          $user->delete();

//          return $this->handelResponse('success', 'Creditfactory deleted successfully!');

//      } catch (\Exception $e) {
//          // Handle errors, for example, redirect back with an error message
//          return redirect()->back()->with('error', 'Error deleting Creditfactory: ' . $e->getMessage());
//      }
//  }

// }
