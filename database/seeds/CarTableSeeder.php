<?php

use Illuminate\Database\Seeder;

class CarTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


         DB::table('type_cars')->insert([[
            'name' => "A",
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "B",
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "C",
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "D",
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ]]);


        DB::table('marcas')->insert([[
            'name' => "Audi",
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "BMW",
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "Chevrolet",
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "Citroen",
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "Daihatsu",
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "Dodge",
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "Fiat",
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "Ford",
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ]]);


         DB::table('models')->insert([[
            'name' => "Coronet",
            'active' => 1,
            'marca_id' => 6,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "Dart",
            'marca_id' => 6,
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "Demon",
            'marca_id' => 6,
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "D100",
            'marca_id' => 6,
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "Royal",
            'marca_id' => 6,
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "Journey",
            'marca_id' => 6,
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "Caliber",
            'marca_id' => 6,
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "Fargo",
            'marca_id' => 6,
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "Durango",
            'marca_id' => 6,
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "300",
            'marca_id' => 6,
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "600",
            'marca_id' => 6,
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "900",
            'marca_id' => 6,
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "500",
            'marca_id' => 6,
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "Ram",
            'marca_id' => 6,
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "D100",
            'marca_id' => 6,
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "Dakota",
            'marca_id' => 6,
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "Caravan",
            'marca_id' => 6,
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "Fusion",
            'marca_id' => 8,
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "Crown",
            'marca_id' => 8,
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "Victoria",
            'marca_id' => 8,
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "Falcon",
            'marca_id' => 8,
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "Festiva",
            'marca_id' => 8,
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "Focus",
            'marca_id' => 8,
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "Granada",
            'marca_id' => 8,
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "Laser",
            'marca_id' => 8,
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "Mustang",
            'marca_id' => 8,
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "Taurus",
            'marca_id' => 8,
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "Hot",
            'marca_id' => 8,
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "Rod",
            'marca_id' => 8,
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "Escort",
            'marca_id' => 8,
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "Ltd",
            'marca_id' => 8,
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "555E",
            'marca_id' => 8,
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "Chiva",
            'marca_id' => 8,
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "Ecosport",
            'marca_id' => 8,
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "Panel",
            'marca_id' => 8,
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "Edge",
            'marca_id' => 8,
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "Flex",
            'marca_id' => 8,
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "Courier",
            'marca_id' => 8,
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "Escape",
            'marca_id' => 8,
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "Expedition",
            'marca_id' => 8,
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "Explorer",
            'marca_id' => 8,
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "Llanero",
            'marca_id' => 8,
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "Bronco",
            'marca_id' => 8,
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "Piragua",
            'marca_id' => 8,
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "Aeromax",
            'marca_id' => 8,
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "Cargo",
            'marca_id' => 8,
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "815",
            'marca_id' => 8,
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "F350",
            'marca_id' => 8,
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "600",
            'marca_id' => 8,
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "F8000",
            'marca_id' => 8,
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "F 600",
            'marca_id' => 8,
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "F 350[7]",
            'marca_id' => 8,
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "F9000",
            'marca_id' => 8,
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "F-150",
            'marca_id' => 8,
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "Cargo 1019",
            'marca_id' => 8,
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "Cargo 816",
            'marca_id' => 8,
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "F250",
            'marca_id' => 8,
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "Nueva",
            'marca_id' => 8,
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "Ranger",
            'marca_id' => 8,
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "Explorer",
            'marca_id' => 8,
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "F100",
            'marca_id' => 8,
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "F-150",
            'marca_id' => 8,
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ],[
            'name' => "F350",
            'marca_id' => 8,
            'active' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ]]);

    }
}
