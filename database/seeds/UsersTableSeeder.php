<?php

use App\Models\User;
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



        $user = factory(User::class, 48)->create([
            'password' => bcrypt('secret'),
            'active' => 1,
            'role_id' =>function() {
                return App\Models\Role::inRandomOrder()->first()->id;
            }
        ]);

        DB::table('roleMappings')->insert([[
            'user_id' => 1,
            'role_id' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'user_id' => 2,
            'role_id' => 2,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ]]);

    }
}
