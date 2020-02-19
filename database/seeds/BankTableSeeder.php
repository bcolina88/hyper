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

        DB::table('payment_methods')->insert([[
            'method' => "Pago Movil",
            'name' => "Trip",
            'rif' => "R-3425467578858",
            'phone' => "04167890678",
            'active'=> 1,
            'bank_id' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime   
        ],[
            'method' => "Transferecia",
            'name' => "Inversiones Trip",
            'rif' => "R-3425467578858",
            'phone' => "-",
            'active'=> 1,
            'bank_id' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime   
        ]]);


        DB::table('locations')->insert([[
            'x' => 10.234163,
            'y' => -68.005101,
            'name' => "Hesperia WTC Valencia",
            'address' => "Naguanagua, Av. 168 Salvador Feo La Cruz Este-Oeste, Valencia 2005, Carabobo",
            'percentagePriceIncrease' => '',
            'durationIncrease'=> '',
            'increaseStartDate' => '',
            'created_at' => new DateTime,
            'updated_at' => new DateTime   
        ],[
            'x' => 10.239143,
            'y' => -68.000142,
            'name' => "Centro Sambil Valencia",
            'address' => "Avenida 4, urbanización Ciudad Jardín Mañongo, Naguanagua, Valencia 2005, Carabobo",
            'percentagePriceIncrease' => '',
            'durationIncrease'=> '',
            'increaseStartDate' => '',
            'created_at' => new DateTime,
            'updated_at' => new DateTime   
        ],[
            'x' => 10.218071,
            'y' => -68.010032,
            'name' => 'Baguette\'s Coffee & Lunch',
            'address' => "Av. 102 Universidad, Valencia 2005, Carabobo",
            'percentagePriceIncrease' => '',
            'durationIncrease'=> '',
            'increaseStartDate' => '',
            'created_at' => new DateTime,
            'updated_at' => new DateTime   
        ],[
            'x' => 10.249914,
            'y' => -68.013488,
            'name' => "Hotel Guaparo INN",
            'address' => "Naguanagua 2005, Carabobo",
            'percentagePriceIncrease' => '',
            'durationIncrease'=> '',
            'increaseStartDate' => '',
            'created_at' => new DateTime,
            'updated_at' => new DateTime   
        ],[
            'x' => 10.255417,
            'y' => -68.006483,
            'name' => "Rodeo Grill",
            'address' => "Av. 181 Valencia, Naguanagua 2005, Carabobo",
            'percentagePriceIncrease' => '',
            'durationIncrease'=> '',
            'increaseStartDate' => '',
            'created_at' => new DateTime,
            'updated_at' => new DateTime   
        ],[
            'x' =>10.255257,
            'y' => -68.007156,
            'name' => "Hospital Metropolitano del Norte",
            'address' => "Av. 181 Valencia, Naguanagua 2005, Carabobo",
            'percentagePriceIncrease' => '',
            'durationIncrease'=> '',
            'increaseStartDate' => '',
            'created_at' => new DateTime,
            'updated_at' => new DateTime   
        ],[
            'x' => 10.214293,
            'y' => -68.014351,
            'name' => "Executive Suites Valencia",
            'address' => "Monseñor Adam con Avenida, Av. Andrés Eloy Blanco, Valencia 2001, Carabobo",
            'percentagePriceIncrease' => '',
            'durationIncrease'=> '',
            'increaseStartDate' => '',
            'created_at' => new DateTime,
            'updated_at' => new DateTime   
        ],[
            'x' => 10.213598,
            'y' => -68.014208,
            'name' => "Isabella Happy Drink & Restaurant",
            'address' => "2001, Valencia, Carabobo",
            'percentagePriceIncrease' => '',
            'durationIncrease'=> '',
            'increaseStartDate' => '',
            'created_at' => new DateTime,
            'updated_at' => new DateTime   
        ],[
            'x' => 10.217195,
            'y' => -68.005834,
            'name' => "Hermandad Gallega de Valencia",
            'address' => "Valencia 2001, Carabobo",
            'percentagePriceIncrease' => '',
            'durationIncrease'=> '',
            'increaseStartDate' => '',
            'created_at' => new DateTime,
            'updated_at' => new DateTime   
        ]]);
    }
}
