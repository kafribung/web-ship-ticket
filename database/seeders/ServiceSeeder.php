<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = ['orang', 'kendaraan'];
        foreach ($services as $service) {
            \App\Models\Service::create([
                'type' => $service
            ]);
        }
    }
}
