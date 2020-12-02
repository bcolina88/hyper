<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Companie;
use Illuminate\Support\Facades\Storage;
use File;

class CompanieController extends Controller
{
    //
    public function create(Request $request){

  

      $companie = Companie::all();

      if(count($companie)>0){

          $companie = Companie::where('id',1)->first();

          if(!$companie)
          {
            return null;
          }

          $companie->name = $request->input('name');
          $companie->email = $request->input('email');

          if ($request->input('currency') == 0) {
            $companie->currency_id = NULL;
          }else{
            $companie->currency_id = $request->input('currency');
          }

          $companie->nif = $request->input('nif');
          $companie->web = $request->input('web');
          $companie->boss = $request->input('boss');
          $companie->phone = $request->input('phone');
          $companie->phone2 = $request->input('phone2');
          $companie->phone3 = $request->input('phone3');
          $companie->adrees = $request->input('adrees');


          if ($request->hasFile('image'))
          {

            $destinationPath="images/logos";
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
 
            $request->file('image')->move($destinationPath, $filename);
            $companie->image = '/'. $destinationPath . '/' . $filename;
         
          }

          $companie->save();




      }else{


        $input['name'] = $request->input('name');
        $input['email'] = $request->input('email');


        if ($request->input('currency') == 0) {
            $input['currency_id'] = NULL;
        }else{
            $input['currency_id'] = $request->input('currency');
        }

        $input['nif'] = $request->input('nif');
        $input['web'] = $request->input('web');
        $input['boss'] = $request->input('boss');
        $input['phone'] = $request->input('phone');
        $input['phone2'] = $request->input('phone2');
        $input['phone3'] = $request->input('phone3');
        $input['adrees'] = $request->input('adrees');



        if ($request->hasFile('image'))
        {

          $destinationPath="images/logos";
          $file = $request->file('image');
          $filename = $file->getClientOriginalName();
       

          $request->file('image')->move($destinationPath, $filename);
          $input['image'] = '/'. $destinationPath . '/' . $filename;

        }

        $data = Companie::insert($input);

        $response['message'] = "Guardo exitosamente ";
        $response['success'] = true;
        return $response;


      }

    }



}
