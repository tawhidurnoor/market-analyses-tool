<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $divisions = [
            ['division_name' => 'Barishal'],
            ['division_name' => 'Chattogram'],
            ['division_name' => 'Dhaka'],
            ['division_name' => 'Khulna'],
            ['division_name' => 'Rajshahi'],
            ['division_name' => 'Rangpur'],
            ['division_name' => 'Mymensingh'],
            ['division_name' => 'Sylhet'],
        ];

        DB::table('divisions')->insert($divisions);
    }
}
