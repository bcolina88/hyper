<?php

use Illuminate\Database\Seeder;

class DiscountCouponTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        DB::table('discount_coupons')->insert([[
            'name' => "Bienvenida a Trip",
            'discount' => "50%",
            'typeUse' => 1,
            'active' => 1,
            'expirationDate' => '01-01-2050',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ]]);

    }
}
