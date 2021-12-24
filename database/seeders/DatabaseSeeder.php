<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            adminSeeder::class,
            ClassesSeeder::class,
            DivisionSeeder::class,
            DistrictSeeder::class,
            BatchSeeder::class,
            SubjectSeeder::class,
        ]);

        // \App\Models\User::factory(10)->create();
    }
}
