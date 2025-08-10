<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    public function run()
    {
        DB::table('cities')->delete();
        DB::table('provinces')->delete();
        DB::table('countries')->delete();

        // Insert Iran
        $iranId = DB::table('countries')->insertGetId([
            'name' => 'Iran',
            'code' => 'IR',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $turkeyId = DB::table('countries')->insertGetId([
            'name' => 'Turkey',
            'code' => 'TR',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $uaeId = DB::table('countries')->insertGetId([
            'name' => 'United Arab Emirates',
            'code' => 'AE',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Provinces of Iran
        $provinces = [
            ['name' => 'Tehran', 'country_id' => $iranId],
            ['name' => 'Isfahan', 'country_id' => $iranId],
            ['name' => 'Fars', 'country_id' => $iranId],
            ['name' => 'Razavi Khorasan', 'country_id' => $iranId],
            ['name' => 'East Azerbaijan', 'country_id' => $iranId],
        ];

        foreach ($provinces as $province) {
            $province['created_at'] = now();
            $province['updated_at'] = now();
            $provinceId = DB::table('provinces')->insertGetId($province);

            $cities = [];

            switch ($province['name']) {
                case 'Tehran':
                    $cities = ['Tehran', 'Eslamshahr', 'Malard', 'Robat Karim'];
                    break;
                case 'Isfahan':
                    $cities = ['Isfahan', 'Khomeinishahr', 'Shahin Shahr', 'Falavarjan'];
                    break;
                case 'Fars':
                    $cities = ['Shiraz', 'Marvdasht', 'Kharameh', 'Sepidan'];
                    break;
                case 'Razavi Khorasan':
                    $cities = ['Mashhad', 'Neyshabur', 'Sabzevar', 'Torbat-e Heydarieh'];
                    break;
                case 'East Azerbaijan':
                    $cities = ['Tabriz', 'Marand', 'Sarab', 'Ahar'];
                    break;
            }

            foreach ($cities as $cityName) {
                DB::table('cities')->insert([
                    'name' => $cityName,
                    'province_id' => $provinceId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Provinces of Turkey
        $turkeyProvinces = [
            ['name' => 'Istanbul', 'country_id' => $turkeyId],
            ['name' => 'Ankara', 'country_id' => $turkeyId],
            ['name' => 'Izmir', 'country_id' => $turkeyId],
        ];

        foreach ($turkeyProvinces as $province) {
            $province['created_at'] = now();
            $province['updated_at'] = now();
            $provinceId = DB::table('provinces')->insertGetId($province);

            $cities = [];

            switch ($province['name']) {
                case 'Istanbul':
                    $cities = ['Istanbul', 'Beylikdüzü', 'Tuzla', 'Pendik'];
                    break;
                case 'Ankara':
                    $cities = ['Ankara', 'Çankaya', 'Keçiören', 'Yenimahalle'];
                    break;
                case 'Izmir':
                    $cities = ['Izmir', 'Bornova', 'Karşıyaka', 'Foça'];
                    break;
            }

            foreach ($cities as $cityName) {
                DB::table('cities')->insert([
                    'name' => $cityName,
                    'province_id' => $provinceId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Provinces of UAE
        $uaeProvinces = [
            ['name' => 'Dubai', 'country_id' => $uaeId],
            ['name' => 'Abu Dhabi', 'country_id' => $uaeId],
            ['name' => 'Sharjah', 'country_id' => $uaeId],
        ];

        foreach ($uaeProvinces as $province) {
            $province['created_at'] = now();
            $province['updated_at'] = now();
            $provinceId = DB::table('provinces')->insertGetId($province);

            $cities = [];

            switch ($province['name']) {
                case 'Dubai':
                    $cities = ['Dubai', 'Jebel Ali', 'Al Ain'];
                    break;
                case 'Abu Dhabi':
                    $cities = ['Abu Dhabi', 'Zayed City', 'Al Ain'];
                    break;
                case 'Sharjah':
                    $cities = ['Sharjah', 'Kalba', 'Dibba Al-Hisn'];
                    break;
            }

            foreach ($cities as $cityName) {
                DB::table('cities')->insert([
                    'name' => $cityName,
                    'province_id' => $provinceId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        $this->command->info('✅ Location data seeded successfully.');
    }
}
