<?php

namespace Database\Seeders;

use App\Models\Divisions;
use Illuminate\Database\Seeder;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Divisions::create(['name'=> 'Barisal','slug'=>"barisal"]);
        Divisions::create(['name'=> 'Chittagong','slug'=>"chittagong"]);
        Divisions::create(['name'=> 'Dhaka','slug'=>"dhaka"]);
        Divisions::create(['name'=> 'Khulna','slug'=>"khulna"]);
        Divisions::create(['name'=> 'Mymensingh','slug'=>"mymensingh"]);
        Divisions::create(['name'=> 'Rajshahi','slug'=>"rajshahi"]);
        Divisions::create(['name'=> 'Rangpur','slug'=>"rangpur"]);
        Divisions::create(['name'=> 'Sylhet','slug'=>"sylhet"]);
    }
}
