<?php

namespace Database\Seeders;

use App\Models\Classes;
use Illuminate\Database\Seeder;

class ClassesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Classes::create(['name'=> 'Class 6']);
      Classes::create(['name'=> 'Class 7']);
      Classes::create(['name'=> 'Class 8']);
      Classes::create(['name'=> 'Class 9']);
      Classes::create(['name'=> 'Class 10']);
    }
}
