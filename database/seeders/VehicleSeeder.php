<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vehicles = [
            [
                'type' =>  'Golongan V.a (Bis sedang, tinggi <= 7m)',
                'budget' => '800300'
            ],
            [
                'type' =>  'Golongan V.b (Truk sedang, tinggi <= 7m)',
                'budget' => '495400'
            ],
            [
                'type' =>  'Golongan VI.a (Bis besar, tinggi <= 10m)',
                'budget' => '1277000'
            ],
            [
                'type' =>  'Golongan VI.b (Truk besar, tinggi <= 10m)',
                'budget' => '702100'
            ],
            [
                'type' =>  'Golongan VII (Truk trailer, tinggi <=12m)',
                'budget' => '1047600'
            ],
            [
                'type' =>  'Golongan VIII (Truk trailer, tinggi <= 16m)',
                'budget' => '1260600'
            ],
            [
                'type' =>  'Golongan IX (Truk trailer, tinggi >16m)',
                'budget' => '2659100'
            ],
        ];

        foreach ($vehicles as $vehicle) {
            \App\Models\Vehicle::create($vehicle);
        }
    }
}
