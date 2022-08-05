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
            'class_code'=>'01',
        ]);
        Classes::create([
            'name'=> 'Class 6',
            'admission_fee'=>1500,
            'monthly_fee'=>1300,
            'other_fee'=>1500,
            'class_code'=>'10',
        ]);
        Classes::create([
            'name'=> 'Class 7',
            'admission_fee'=>1500,
            'monthly_fee'=>1600,
            'other_fee'=>1500,
             'class_code'=>'11',
        ]);
        Classes::create([
            'name'=> 'Class 8',
            'admission_fee'=>1500,
            'monthly_fee'=>1600,
            'other_fee'=>1500,
             'class_code'=>'02',
        ]);
        Classes::create([
            'name'=> 'Class 9',
            'admission_fee'=>2000,
            'monthly_fee'=>2200,
            'other_fee'=>2000,
             'class_code'=>'20',
        ]);
        Classes::create([
            'name'=> 'Class 10',
            'admission_fee'=>2000,
            'monthly_fee'=>2200,
            'other_fee'=>2000,
             'class_code'=>'21',
        ]);
        Classes::create([
            'name'=> 'ssc',
            'admission_fee'=>2000,
            'monthly_fee'=>2200,
            'other_fee'=>2000,
             'class_code'=>'22',
        ]);

        Classes::create([
            'name'=> 'Hsc (Science)',
            'admission_fee'=>2000,
            'monthly_fee'=>2500,
            'other_fee'=>2000,
             'class_code'=>'30',
        ]);
        Classes::create([
            'name'=> 'Hsc (Humanities)',
            'admission_fee'=>2000,
            'monthly_fee'=>2500,
            'other_fee'=>2000,
             'class_code'=>'33',
        ]);
    }
}
