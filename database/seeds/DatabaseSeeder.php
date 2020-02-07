<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(CarTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(DiscountCouponTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(BankTableSeeder::class);

    }
}
