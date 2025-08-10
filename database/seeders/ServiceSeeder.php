<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\Subservice;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        $flight = Service::updateOrCreate(
            ['code' => 'FLT'],
            ['name' => 'Flight', 'description' => 'Airline ticket service']
        );

        $hotel = Service::updateOrCreate(
            ['code' => 'HLT'],
            ['name' => 'Hotel', 'description' => 'Accommodation service']
        );

        $car = Service::updateOrCreate(
            ['code' => 'CR'],
            ['name' => 'Car Rental', 'description' => 'Vehicle rental service']
        );

        // Flight Subservices
        Subservice::updateOrCreate(['code' => 'ECO'], ['service_id' => $flight->id, 'name' => 'Economy', 'description' => 'Standard economy class']);
        Subservice::updateOrCreate(['code' => 'BUS'], ['service_id' => $flight->id, 'name' => 'Business', 'description' => 'Business class']);
        Subservice::updateOrCreate(['code' => 'FST'], ['service_id' => $flight->id, 'name' => 'First', 'description' => 'First class']);

        // Hotel Subservices
        Subservice::updateOrCreate(['code' => 'STD'], ['service_id' => $hotel->id, 'name' => 'Standard', 'description' => 'Standard room']);
        Subservice::updateOrCreate(['code' => 'DLX'], ['service_id' => $hotel->id, 'name' => 'Deluxe', 'description' => 'Deluxe room']);
        Subservice::updateOrCreate(['code' => 'SUI'], ['service_id' => $hotel->id, 'name' => 'Suite', 'description' => 'Suite room']);

        // Car Rental Subservices
        Subservice::updateOrCreate(['code' => 'ECO'], ['service_id' => $car->id, 'name' => 'Economy Car', 'description' => 'Compact and fuel-efficient']);
        Subservice::updateOrCreate(['code' => 'SUV'], ['service_id' => $car->id, 'name' => 'SUV', 'description' => 'Sport Utility Vehicle']);
        Subservice::updateOrCreate(['code' => 'LUX'], ['service_id' => $car->id, 'name' => 'Luxury', 'description' => 'Premium vehicles']);

        $this->command->info('✅ Service and Subservice data seeded.');
    }
}
