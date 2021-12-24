<?php

namespace Database\Seeders;

use App\Models\Batch;
use Illuminate\Database\Seeder;

class BatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1 ; $i <= 9 ; $i++){
            Batch::create([
                'class_id' => $i,
                'name'=> 'Batch 1',
                'batch_start' => '07:30:00',
                'batch_end' => '09:30:00',
            ]);
            Batch::create([
                'class_id' => $i,
                'name'=> 'Batch 2',
                'batch_start' => '09:45:00',
                'batch_end' => '11:45:00',
            ]);
            Batch::create([
                'class_id' => $i,
                'name'=> 'Batch 3',
                'batch_start' => '12:45:00',
                'batch_end' => '14:45:00',
            ]);
            Batch::create([
                'class_id' => $i,
                'name'=> 'Batch 4',
                'batch_start' => '15:00:00',
                'batch_end' => '18:00:00',
            ]);

        }
    }
}
