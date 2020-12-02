<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Dish;
use Illuminate\Support\Facades\Storage;
use File;

class ProductoController extends Controller
{
    //
    public function create(Request $request){

      $input['name'] = $request->input('name');
      $input['description'] = $request->input('description');
      $input['category_id'] = $request->input('category');
      $input['price'] = $request->input('price');
      $input['code'] = $request->input('code');
      $input['preparation'] = $request->input('preparation');
      $input['unity'] = $request->input('unity');
      $input['duration'] = $request->input('duration');
      $input['stock'] = $request->input('stock');
      $input['stock_min'] = $request->input('stock_min');
      $input['image'] = '';
      $input['active'] = 1;


      if ($request->hasFile('image'))
      {

        $destinationPath="images/dishs";
        $file = $request->file('image');
        $filename = $file->getClientOriginalName();
        $request->file('image')->move($destinationPath, $filename);
        $input['image'] = '/'. $destinationPath . '/' . $filename;

      }else{
         $input['image'] =  '';
      }

      $data = Dish::insert($input);

      $response['message'] = "Guardo exitosamente ";
      $response['success'] = true;
      return $response;

    }


    public function edit(Request $request){

      

      $dish = Dish::where('id', $request->input('id'))->first();

      if(!$dish)
      {
        return null;
      }

      $dish->name = $request->input('name');
      $dish->description = $request->input('description');
      $dish->category_id = $request->input('category');
      $dish->price = $request->input('price');
      $dish->code = $request->input('code');
      $dish->preparation = $request->input('preparation');
      $dish->unity = $request->input('unity');
      $dish->duration = $request->input('duration');
      $dish->stock = $request->input('stock');
      $dish->stock_min = $request->input('stock_min');


      if ($request->hasFile('image'))
      {

        $destinationPath="images/dishs";
        $file = $request->file('image');
        $filename = $file->getClientOriginalName();
        $request->file('image')->move($destinationPath, $filename);
        $dish->image = '/'. $destinationPath . '/' . $filename;
     
      }else{
         $dish->image = '';
      }

      $dish->save();

      $response['message'] = "Edito exitosamente ";
      $response['success'] = true;
      return $response;

    }



}
