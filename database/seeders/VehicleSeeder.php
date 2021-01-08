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
        $vehicles = collect([
            'Golongan I	(Sedan, Jip, Pick Up/Truk Kecil, dan Bus)',
            'Golongan II (Truk dengan 2 gandar)',
            'Golongan III (Truk dengan 3 gandar)',
            'Golongan III (Truk dengan 3 gandar)',
            'Golongan IV (Truk dengan 4 gandar)',
            'Golongan V	(Truk dengan 5 gandar)',
            'Golongan VI (Kendaraan bermotor roda 2)',

        ]);
        $vehicles->each(function($vehicle){
            \App\Models\Vehicle::create([
                'type' => $vehicle
            ]);
        });
    }
}
