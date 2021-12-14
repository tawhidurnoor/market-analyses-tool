<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = [
            [
                'district_id' => 18,
                'city_name' => 'Dhaka City'
            ],
            [
                'district_id' => 18,
                'city_name' => 'Savar'
            ],
        ];

        DB::table('cities')->insert($cities);
    }
}
