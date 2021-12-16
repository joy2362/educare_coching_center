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
        Classes::create([
            'name'=> 'Class 5',
            'admission_fee'=>1500,
            'monthly_fee'=>1300,
            'other_fee'=>1500,
        ]);
        Classes::create([
            'name'=> 'Class 7',
            'admission_fee'=>1500,
            'monthly_fee'=>1600,
            'other_fee'=>1500,
        ]);
        Classes::create([
            'name'=> 'Class 8',
            'admission_fee'=>1500,
            'monthly_fee'=>1600,
            'other_fee'=>1500,
        ]);
        Classes::create([
            'name'=> 'Class 9',
            'admission_fee'=>2000,
            'monthly_fee'=>2200,
            'other_fee'=>2000,
        ]);
        Classes::create([
            'name'=> 'ssc',
            'admission_fee'=>2000,
            'monthly_fee'=>2200,
            'other_fee'=>2000,
        ]);
        Classes::create([
            'name'=> 'Hsc',
            'admission_fee'=>2000,
            'monthly_fee'=>2500,
            'other_fee'=>2000,
        ]);
    }
}
