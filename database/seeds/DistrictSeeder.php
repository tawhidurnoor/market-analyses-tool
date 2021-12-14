<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $districts = [
            [
                'division_id' => 1,
                'district_name' => 'Barguna District'
            ],
            [
                'division_id' => 1,
                'district_name' => 'Barisal District'
            ],
            [
                'division_id' => 1,
                'district_name' => 'Bhola District'
            ],
            [
                'division_id' => 1,
                'district_name' => 'Jhalokathi District'
            ],
            [
                'division_id' => 1,
                'district_name' => 'Patuakhali District'
            ],
            [
                'division_id' => 1,
                'district_name' => 'Pirojpur District'
            ],
            [
                'division_id' => 2,
                'district_name' => 'Bandarban District'
            ],
            [
                'division_id' => 2,
                'district_name' => 'Brahmanbaria District'
            ],
            [
                'division_id' => 2,
                'district_name' => 'Chandpur District'
            ],
            [
                'division_id' => 2,
                'district_name' => 'Chittagonj District'
            ],
            [
                'division_id' => 2,
                'district_name' => 'Comilla District'
            ],
            [
                'division_id' => 2,
                'district_name' => 'Cox\'s Bazar District'
            ],
            [
                'division_id' => 2,
                'district_name' => 'Feni District'
            ],
            [
                'division_id' => 2,
                'district_name' => 'Khagrachari District'
            ],
            [
                'division_id' => 2,
                'district_name' => 'Lakshmipur District'
            ],
            [
                'division_id' => 2,
                'district_name' => 'Noakhali District'
            ],
            [
                'division_id' => 2,
                'district_name' => 'Rangamati District'
            ],
            [
                'division_id' => 3,
                'district_name' => 'Dhaka District'
            ],
            [
                'division_id' => 3,
                'district_name' => 'Faridpur District'
            ],
            [
                'division_id' => 3,
                'district_name' => 'Gazipur District'
            ],
            [
                'division_id' => 3,
                'district_name' => 'Gopalganj District'
            ],
            [
                'division_id' => 3,
                'district_name' => 'Kishoreganj District'
            ],
            [
                'division_id' => 3,
                'district_name' => 'Madaripur District'
            ],
            [
                'division_id' => 3,
                'district_name' => 'Manikganj District'
            ],
            [
                'division_id' => 3,
                'district_name' => 'Munshiganj District'
            ],
            [
                'division_id' => 3,
                'district_name' => 'Narayanganj District'
            ],
            [
                'division_id' => 3,
                'district_name' => 'Narshingdi District'
            ],
            [
                'division_id' => 3,
                'district_name' => 'Rajbari District'
            ],
            [
                'division_id' => 3,
                'district_name' => 'Shariatpur District'
            ],
            [
                'division_id' => 3,
                'district_name' => 'Tangail District'
            ],
        ];

        DB::table('districts')->insert($districts);
    }
}
