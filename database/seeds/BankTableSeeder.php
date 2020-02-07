<?php

use Illuminate\Database\Seeder;

class BankTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
        
        DB::table('currencys')->insert([[
            'description' => "USD",
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime   
        ],[
            'description' => "Bs.S",
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime   
        ],[
            'description' => "Euros",
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime   
        ]]);


        DB::table('banks')->insert([[
            'name' => "Oficina",
            'currency_id' => 2,
            'created_at' => new DateTime,
            'updated_at' => new DateTime   
        ],[
            'name' => "BOFA",
            'currency_id' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime   
        ],[
            'name' => "Banesco",
            'currency_id' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "Chase Bank",
            'currency_id' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ]]);


        DB::table('bank_accounts')->insert([[
            'accountNumber' => "N/A",
            'type' => "Cuenta de la Oficina",
            'currency' => "Bs.S.​",
            'comment' => "Cuenta de la Oficina",
            'beginningBalance'=> 0.00,
            'currentBalance' => 0.00,
            'owner_id' => 1,
            'bank_id' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime   
        ]]);
    }
}
