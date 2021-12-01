<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class adminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name'=> 'abdullahzahidjoy',
            'email'=> 'admin@admin.com',
            'password'=> hash::make('1234'),
            'avatar'=>'asset/img/avatars/admin/admin.png',
        ]);
    }
}
