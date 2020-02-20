<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// models
use App\Models\User;

class ProfileController extends Controller
{
    
    /**
     * La carpeta donde se almacenan las fotos de perfil
     */
    private $profilePicturesFolder = "profile_pictures";


    public function updateProfilePicture(Request $request) 
    {
        
        if ($request->hasFile('image'))
        {


            $file = $request->file('image');
            $filename = str_random(10) . '.' .$file->getClientOriginalExtension();

            $user = User::where('id',$request->id)->first();

            $file->move($this->profilePicturesFolder,$filename);// subimos al servidor

            $user->profile_picture = url("/{$this->profilePicturesFolder}/{$filename}");// guardamos en la bd
            
            $user->save(); // guardamos los cambios.

            $response['message'] = "Updated profile picture";
            $response['success'] = true;
            return $response;


        }else{
            $response['message'] = "Error Updated profile picture";
            $response['success'] = false;
            return $response;
        }



    }

}
