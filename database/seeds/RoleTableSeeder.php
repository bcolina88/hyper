<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        DB::table('roles')->insert([[
            'name' => "SUPER_ADMIN",
            'description' => "SUPER_ADMIN",
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "ADMIN",
            'description' => "ADMIN",
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "DRIVER",
            'description' => "DRIVER",
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "RIDER",
            'description' => "RIDER",
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "OWNER",
            'description' => "OWNER",
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "ACCOUNTANT",
            'description' => "ACCOUNTANT",
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "OFFICE_ASSISTANT",
            'description' => "OFFICE_ASSISTANT",
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "TECHNICAL_SUPPORT",
            'description' => "TECHNICAL_SUPPORT",
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "SYSTEM_MAINTENANCE",
            'description' => "SYSTEM_MAINTENANCE",
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ]]);

    }
}
