<?php


use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        

        $user = factory(App\Models\User::class)->create([
                                                  'password' => bcrypt('secret'),
                                                  'email' => 'admin@admin.com',
                                                  'role_id'  => 1,
                                                  'active' => 1,
                                                 ]);



        $user = factory(App\Models\User::class, 48)->create([
          'role_id' =>function() {
            return App\Models\Role::inRandomOrder()->first()->id;
          },
         'password' => bcrypt('secret'),
         'active' => 1

        ]);

        DB::table('proyects')->insert([[
            'name' => 'Proyecto Prueba',
            'tipo_proy' => 'no_freelancer',
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime  
        ],[
            'name' => 'Proyecto Prueba2',
            'tipo_proy' => 'no_freelancer',
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime  
        ]]);


         DB::table('users_proyects')->insert([[
            'user_id' => 1,
            'proyect_id' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime  
        ],[
            'user_id' => 2,
            'proyect_id' => 2,
            'created_at' => new DateTime,
            'updated_at' => new DateTime  
        ]]);


       

        
    }
}
