<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Carbon\Carbon;
use App\Models\Permiso;
use App\Models\Role;
use App\Models\Table;
use App\Models\Sales;
use App\Models\Companie;
use App\Models\User;

use App\Models\Proyect;
use App\Models\Objetivo;
use App\Models\Experimento;
use App\Models\Campana;
use App\Models\Palanca;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */

     // Obtiene un artículo mediante su código de barra.
     public function IsUser(Request  $request)
     {
       

        $user = \Auth::user();
        $role = Role::where('id', 1)->first();
        $permissions = Permiso::where('rol_id', 1)->with('maestro')->get();


        return ['role' => $role, 'permisos' => $permissions];
      
     }

     public function Tables(Request  $request)
     {
       

        $results = [];
        $tables = Table::all();


        foreach ($tables as $key => $item) {

            $itemSale = Sales::where('table_id',$item->id)->where('status',1)->first();

            if ($itemSale) {
                $salesTable = array('id' => $item->id,'name' => $item->name,'status' => $item->status,'active' =>$item->active,'sale' => $itemSale->id);
            }else{
                $salesTable = array('id' => $item->id,'name' => $item->name,'status' => $item->status,'active' =>$item->active,'sale' => 0);

            }
            
            array_push($results,$salesTable);

         }


        
        return  $results;

      
     }

     public function Companys(Request  $request)
     {

        $companys = Companie::all();
        return $companys;
     }

     public function Roles(Request  $request)
     {

        $roles = Role::all();
        return $roles;
     }

      public function Objetivos(Request  $request)
     {

        $objetivos = Objetivo::with(['proyecto'])->get();
        return $objetivos;
     }

     public function Palancas(Request  $request)
     {

        $Palancas = Palanca::with(['objetivo'])->get();
        return $Palancas;
     }

      public function Proyectos(Request  $request)
     {

        $Proyect = Proyect::all();
        return $Proyect;
     }

     public function Experimentos(Request  $request)
     {

        $Experimentos = Experimento::with(['palanca'])->get();
        return $Experimentos;
     }

       public function Campanas(Request  $request)
     {

        $Campanas = Campana::with(['palanca'])->get();
        return $Campanas;
     }





     public function Users(Request  $request)
     {

        $users = User::with(['role'])->get();
        return $users;

     }


     public function BlockedUser($id,$status)
     {

        $user = User::find($id);
   
        if($user) {

            $user->active = $status;
            $user->save();
            return $user;
           
        }

       
        return null;
     }


     public function CreateUser(Request  $request)
     {

       $data = [
            'name'     => $request->name,
            'lastName'     => $request->lastName,
            'username'     => $request->username,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'lastName' => $request->lastName,
            'phone'    => $request->phone,
            'active'=> 1,
            'role_id'=> $request->role

        ];

        $user = User::create($data);
        return $user;

     }


     public function DeleteUser($id)
     {

    
            if( $user = User::findOrFail( $id) ) {
                $user->delete();
                return $user;
            }

  
     }


     public function UpdateUser(Request  $request)
     {

         $user = User::find($request->id);

        if(! $user)
        {
            return null;
        }

        // update user        
        $user->update([
            'name'     => $request->name,
            'email'    => $request->email,
            'lastName' => $request->lastName,
            'phone'    => $request->phone,
            'username' => $request->username,
            'role_id'  => $request->role,
        ]);

        return $user;
     }


      public function User($id)
     {

        return User::find($id);
     }

     public function Role($id)
     {

        return Role::find($id);
     }

     public function DeleteRole($id)
     {

        if( $role = Role::findOrFail($id) ) {
            
            $permisos = Permiso::where('rol_id',$id)->get();

            foreach ($permisos as $key => $item) {

                Permiso::destroy($item['id']);  
            }

           // Role::destroy($id);

             $role->delete();
               // return $user;
            return $role;

        }

        return null;
  
     }

      public function BlockedRole($id,$status)
     {

        $role = Role::find($id);
   
        if($role) {
            
            $role->active = $status;
            $role->save();
            return $role;
        }
        
        return null;
     }

    public function CreateRole(Request  $request)
    {

        $permissions = $request->permissions;

        $data = [
            'name'     => $request->name,
            'description' =>  $request->name,
            'active' => 1
        ];

        $role = Role::create($data);



       foreach ($permissions as $key => $item) {

            $permisoItems = new Permiso;
          
            $permisoItems->rol_id      = $role->id;
            $permisoItems->maestro_id  = $item['maestro_id'];
            $permisoItems->agregar     = $item['agregar'];
            $permisoItems->editar      = $item['editar'];
            $permisoItems->ver         = $item['ver'];
            $permisoItems->inhabilitar = $item['inhabilitar'];
            $permisoItems->borrar      = $item['borrar'];
            $permisoItems->save();
          
        }



        return $role;


    }

    public function UpdateRole(Request  $request)
    {

        $permissions = $request->permissions;


        $role = Role::where('id', $request->id)->first();
        $role->name = $request->name;
        $role->save();


        $permisoRole = Permiso::where('rol_id','=',$request->id)->get();


        foreach ($permisoRole as $key => $item) {
            Permiso::destroy($item['id']);
        }


        foreach ($permissions as $key => $item) {

            $permisoItems = new Permiso;
          
            $permisoItems->rol_id      = $role->id;
            $permisoItems->maestro_id  = $item['maestro_id'];
            $permisoItems->agregar     = $item['agregar'];
            $permisoItems->editar      = $item['editar'];
            $permisoItems->ver         = $item['ver'];
            $permisoItems->inhabilitar = $item['inhabilitar'];
            $permisoItems->borrar      = $item['borrar'];
            $permisoItems->save();
        
        }



        return $role;

    }

    public function Permissions(Request  $request)
    {

        $permissions = Permiso::where('rol_id', 1)->with('maestro')->get();
        return $permissions;
    }


    public function GetRoleInfo(Request  $request)
    {

        
        $role = Role::where('id', $request->id)->first();
        $permissions = Permiso::where('rol_id', $request->id)->with('maestro')->get();

        return ['role' => $role, 'permisos' => $permissions];
   

    }

/*****************************************************************************************************/
    public function BlockedObjetivo($id,$status)
     {

        $objetivo = Objetivo::find($id);
   
        if($objetivo) {

            $objetivo->active = $status;
            $objetivo->save();
            return $objetivo;
           
        }

       
        return null;
     }

      public function CompletObjetivo($id,$status)
     {

        $objetivo = Objetivo::find($id);
   
        if($objetivo) {

            $objetivo->completada = $status;
            $objetivo->save();
            return $objetivo;
           
        }

       
        return null;
     }



     public function CreateObjetivo(Request  $request)
     {

       $data = [
            'name'     => $request->name,
            'fecha_inicial'     => $request->fecha_inicial,
            'fecha_fin'     => $request->fecha_fin,
            'valor_inicial'    => $request->valor_inicial,
            'valor_objetivo' => $request->valor_objetivo,
            'active'=> 1,
            'proyecto_id'=> $request->proyect,
            'completada' => 0,
            

        ];

        $objetivo = Objetivo::create($data);
        return $objetivo;

     }


     public function DeleteObjetivo($id)
     {

    
            if( $objetivo = Objetivo::findOrFail( $id) ) {
                $objetivo->delete();
                return $objetivo;
            }

  
     }


     public function UpdateObjetivo(Request  $request)
     {

         $objetivo = Objetivo::find($request->id);

        if(! $objetivo)
        {
            return null;
        }

        // update user        
        $objetivo->update([
            'name'     => $request->name,
            'fecha_inicial'     => $request->fecha_inicial,
            'fecha_fin'     => $request->fecha_fin,
            'valor_inicial'    => $request->valor_inicial,
            'valor_objetivo' => $request->valor_objetivo,
            'proyecto_id'=> $request->proyect
        ]);

        return $objetivo;
     }


      public function Objetivo($id)
     {

        return Objetivo::find($id);
     }

 /*************************************************************************************************/

    public function BlockedPalanca($id,$status)
     {

        $Palanca = Palanca::find($id);
   
        if($Palanca) {

            $Palanca->active = $status;
            $Palanca->save();
            return $Palanca;
           
        }

       
        return null;
     }



      public function CompletPalanca($id,$status)
     {

        $Palanca = Palanca::find($id);
   
        if($Palanca) {

            $Palanca->completada = $status;
            $Palanca->save();
            return $Palanca;
           
        }

       
        return null;
     }



     public function CreatePalanca(Request  $request)
     {

       $data = [
            'name'        => $request->name,
            'estrategia'  => $request->estrategia,
            'active'      => 1,
            'objetivo_id' => $request->objetivo,
            'completada' => 0,
            'num_exp_valid'  => 0,


        ];

        $Palanca = Palanca::create($data);
        return $Palanca;

     }


     public function DeletePalanca($id)
     {

    
            if( $Palanca = Palanca::findOrFail( $id) ) {
                $Palanca->delete();
                return $Palanca;
            }

  
     }


     public function UpdatePalanca(Request  $request)
     {

         $Palanca = Palanca::find($request->id);

        if(! $Palanca)
        {
            return null;
        }

        // update user        
        $Palanca->update([
            'name'         => $request->name,
            'estrategia'   => $request->estrategia,
            'objetivo_id  '=> $request->objetivo
        ]);

        return $Palanca;
     }


      public function Palanca($id)
     {

        return Palanca::find($id);
     } 

   /******************************************************************************************************/    


    public function BlockedExperimento($id,$status)
     {

        $Experimento = Experimento::find($id);
   
        if($Experimento) {

            $Experimento->active = $status;
            $Experimento->save();
            return $Experimento;
           
        }

       
        return null;
     }


    public function CompletExperimento($id,$status)
     {

        $Experimento = Experimento::find($id);
        $palanca = Palanca::where('id',$Experimento->palanca_id)->first();


        if ($status == 1) {
            $palanca->num_exp_valid = $palanca->num_exp_valid + 1 ;
            $palanca->save();
        }else{
            $palanca->num_exp_valid = $palanca->num_exp_valid - 1 ;
            $palanca->save();
        }


        $palanca = Palanca::where('id',$Experimento->palanca_id)->first();
        if ($palanca->num_exp_valid >= 5) {
            $palanca->completada = 1 ;
            $palanca->save();
        }else{
            $palanca->completada = 0 ;
            $palanca->save();
        }



   
        if($Experimento) {

            $Experimento->completada = $status;
            $Experimento->save();
            return $Experimento;
           
        }

       
        return null;
     }



     public function CreateExperimento(Request  $request)
     {

       $data = [
            'name'        => $request->name,
            'fecha_inicial'  => $request->fecha_inicial,
            'fecha_fin'  => $request->fecha_fin,
            'tiempo'  => $request->tiempo,
            'alcance'  => $request->alcance,
            'presupuesto'  => $request->presupuesto,
            'active'      => 1,
            'palanca_id' => $request->palanca,
            'completada' => 0

        ];

        $Experimento = Experimento::create($data);
        return $Experimento;

     }


     public function DeleteExperimento($id)
     {

    
            if( $Experimento = Experimento::findOrFail( $id) ) {


                $palanca = Palanca::where('id',$Experimento->palanca_id)->first();
                $palanca->num_exp_valid = $palanca->num_exp_valid - 1 ;
                $palanca->save();


                $palanca = Palanca::where('id',$Experimento->palanca_id)->first();
                if ($palanca->num_exp_valid >= 5) {
                    $palanca->completada = 1 ;
                    $palanca->save();
                }else{
                    $palanca->completada = 0 ;
                    $palanca->save();
                }
                

                $Experimento->delete();
                return $Experimento;
            }

  
     }


     public function UpdateExperimento(Request  $request)
     {

         $Experimento = Experimento::find($request->id);

        if(! $Experimento)
        {
            return null;
        }

        // update user        
        $Experimento->update([
            'name'         => $request->name,
            'fecha_inicial'  => $request->fecha_inicial,
            'fecha_fin'  => $request->fecha_fin,
            'tiempo'  => $request->tiempo,
            'alcance'  => $request->alcance,
            'presupuesto'  => $request->presupuesto,
            'palanca_id' => $request->palanca,
        ]);

        return $Experimento;
     }


      public function Experimento($id)
     {

        return Experimento::find($id);
     } 

 /**************************************************************************************/       



    public function BlockedCampana($id,$status)
     {

        $Campana = Campana::find($id);
   
        if($Campana) {

            $Campana->active = $status;
            $Campana->save();
            return $Campana;
           
        }

       
        return null;
     }

      public function CompletCampana($id,$status)
     {

        $Campana = Campana::find($id);
   
        if($Campana) {

            $Campana->completada = $status;
            $Campana->save();
            return $Campana;
           
        }

       
        return null;
     }




     public function CreateCampana(Request  $request)
     {

       $data = [
            'name'        => $request->name,
            'fecha_inicial'  => $request->fecha_inicial,
            'fecha_fin'  => $request->fecha_fin,
            'tiempo'  => $request->tiempo,
            'alcance'  => $request->alcance,
            'presupuesto'  => $request->presupuesto,
            'active'      => 1,
            'palanca_id' => $request->palanca,
            'user_id' => $request->user,
            'completada' => 0

        ];

        $Campana = Campana::create($data);
        return $Campana;

     }


     public function DeleteCampana($id)
     {

    
            if( $Campana = Campana::findOrFail( $id) ) {
                $Campana->delete();
                return $Campana;
            }

  
     }


     public function UpdateCampana(Request  $request)
     {

         $Campana = Campana::find($request->id);

        if(! $Campana)
        {
            return null;
        }

        // update user        
        $Campana->update([
            'name'         => $request->name,
            'fecha_inicial'  => $request->fecha_inicial,
            'fecha_fin'  => $request->fecha_fin,
            'tiempo'  => $request->tiempo,
            'alcance'  => $request->alcance,
            'presupuesto'  => $request->presupuesto,
            'palanca_id' => $request->palanca,
            'user_id' => $request->user,
        ]);

        return $Campana;
     }


      public function Campana($id)
     {

        return Campana::find($id);
     } 


/***********************************************************************************/




    public function BlockedProyecto($id,$status)
     {

        $Proyecto = Proyect::find($id);
   
        if($Proyecto) {

            $Proyecto->active = $status;
            $Proyecto->save();
            return $Proyecto;
           
        }

       
        return null;
     }


     public function CreateProyecto(Request  $request)
     {

       $data = [
            'name'        => $request->name,
            'tipo_proy'  => $request->tipo_proy,
            'active'      => 1,

        ];

        $Proyecto = Proyect::create($data);
        return $Proyecto;

     }


     public function DeleteProyecto($id)
     {

    
            if( $Proyecto = Proyect::findOrFail( $id) ) {
                $Proyecto->delete();
                return $Proyecto;
            }

  
     }


     public function UpdateProyecto(Request  $request)
     {

         $Proyecto = Proyect::find($request->id);

        if(! $Proyecto)
        {
            return null;
        }

        // update user        
        $Proyecto->update([
            'name'         => $request->name,
            'tipo_proy'  => $request->tipo_proy,
        ]);

        return $Proyecto;
     }


      public function Proyecto($id)
     {

        return Proyect::find($id);
     } 

    
}
