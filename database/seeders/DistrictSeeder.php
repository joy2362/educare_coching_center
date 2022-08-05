<?php

namespace Database\Seeders;

use App\Models\District;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        District::create(['name'=> 'Barguna' ,'slug' => 'barguna' ,'division_slug' => 'barisal']);
        District::create(['name'=> 'Barisal' ,'slug' => 'barisal' ,'division_slug' => 'barisal']);
        District::create(['name'=> 'Bhola' ,'slug' => 'bhola' ,'division_slug' => 'barisal']);
        District::create(['name'=> 'Jhalokati' ,'slug' => 'jhalokati' ,'division_slug' => 'barisal']);
        District::create(['name'=> 'Patuakhali' ,'slug' => 'patuakhali' ,'division_slug' => 'barisal']);
        District::create(['name'=> 'Pirojpur' ,'slug' => 'pirojpur' ,'division_slug' => 'barisal']);

        District::create(['name'=> 'Bandarban' ,'slug' => 'bandarban' ,'division_slug' => 'chittagong']);
        District::create(['name'=> 'Brahmanbaria' ,'slug' => 'brahmanbaria' ,'division_slug' => 'chittagong']);
        District::create(['name'=> 'Chandpur' ,'slug' => 'chandpur' ,'division_slug' => 'chittagong']);
        District::create(['name'=> 'Chittagong' ,'slug' => 'chittagong' ,'division_slug' => 'chittagong']);
        District::create(['name'=> 'Comilla' ,'slug' => 'comilla' ,'division_slug' => 'chittagong']);
        District::create(['name'=> 'Cox\'s Bazar' ,'slug' => 'cox\'s bazar' ,'division_slug' => 'chittagong']);
        District::create(['name'=> 'Feni' ,'slug' => 'feni' ,'division_slug' => 'chittagong']);
        District::create(['name'=> 'Khagrachhari' ,'slug' => 'khagrachhari' ,'division_slug' => 'chittagong']);
        District::create(['name'=> 'Lakshmipur' ,'slug' => 'lakshmipur' ,'division_slug' => 'chittagong']);
        District::create(['name'=> 'Noakhali' ,'slug' => 'noakhali' ,'division_slug' => 'chittagong']);
        District::create(['name'=> 'Rangamati Hil' ,'slug' => 'rangamati hil' ,'division_slug' => 'chittagong']);

        District::create(['name'=> 'Dhaka' ,'slug' => 'dhaka' ,'division_slug' => 'dhaka']);
        District::create(['name'=> 'Faridpur' ,'slug' => 'faridpur' ,'division_slug' => 'dhaka']);
        District::create(['name'=> 'Gazipur' ,'slug' => 'gazipur' ,'division_slug' => 'dhaka']);
        District::create(['name'=> 'Gopalganj' ,'slug' => 'gopalganj' ,'division_slug' => 'dhaka']);
        District::create(['name'=> 'Kishoreganj' ,'slug' => 'kishoreganj' ,'division_slug' => 'dhaka']);
        District::create(['name'=> 'Madaripur' ,'slug' => 'madaripur' ,'division_slug' => 'dhaka']);
        District::create(['name'=> 'Manikganj' ,'slug' => 'manikganj' ,'division_slug' => 'dhaka']);
        District::create(['name'=> 'Munshiganj' ,'slug' => 'munshiganj' ,'division_slug' => 'dhaka']);
        District::create(['name'=> 'Narayanganj' ,'slug' => 'narayanganj' ,'division_slug' => 'dhaka']);
        District::create(['name'=> 'Narsingdi' ,'slug' => 'narsingdi' ,'division_slug' => 'dhaka']);
        District::create(['name'=> 'Rajbari' ,'slug' => 'rajbari' ,'division_slug' => 'dhaka']);
        District::create(['name'=> 'Shariatpur' ,'slug' => 'shariatpur' ,'division_slug' => 'dhaka']);
        District::create(['name'=> 'Tangail' ,'slug' => 'tangail' ,'division_slug' => 'dhaka']);

        District::create(['name'=> 'Bagerhat' ,'slug' => 'bagerhat' ,'division_slug' => 'khulna']);
        District::create(['name'=> 'Chuadanga' ,'slug' => 'chuadanga' ,'division_slug' => 'khulna']);
        District::create(['name'=> 'Jessore' ,'slug' => 'jessore' ,'division_slug' => 'khulna']);
        District::create(['name'=> 'Jhenaidah' ,'slug' => 'jhenaidah' ,'division_slug' => 'khulna']);
        District::create(['name'=> 'Khulna' ,'slug' => 'khulna' ,'division_slug' => 'khulna']);
        District::create(['name'=> 'Kushtia' ,'slug' => 'kushtia' ,'division_slug' => 'khulna']);
        District::create(['name'=> 'Magura' ,'slug' => 'magura' ,'division_slug' => 'khulna']);
        District::create(['name'=> 'Meherpur' ,'slug' => 'meherpur' ,'division_slug' => 'khulna']);
        District::create(['name'=> 'Narail' ,'slug' => 'narail' ,'division_slug' => 'khulna']);
        District::create(['name'=> 'Satkhira' ,'slug' => 'satkhira' ,'division_slug' => 'khulna']);

        District::create(['name'=> 'Jamalpur' ,'slug' => 'jamalpur' ,'division_slug' => 'mymensingh']);
        District::create(['name'=> 'Mymensingh' ,'slug' => 'mymensingh' ,'division_slug' => 'mymensingh']);
        District::create(['name'=> 'Netrokona' ,'slug' => 'netrokona' ,'division_slug' => 'mymensingh']);
        District::create(['name'=> 'Sherpur' ,'slug' => 'sherpur' ,'division_slug' => 'mymensingh']);

        District::create(['name'=> 'Bogra' ,'slug' => 'bogra' ,'division_slug' => 'rajshahi']);
        District::create(['name'=> 'Joypurhat' ,'slug' => 'joypurhat' ,'division_slug' => 'rajshahi']);
        District::create(['name'=> 'Naogaon' ,'slug' => 'naogaon' ,'division_slug' => 'rajshahi']);
        District::create(['name'=> 'Natore' ,'slug' => 'natore' ,'division_slug' => 'rajshahi']);
        District::create(['name'=> 'Chapai Nawabganj' ,'slug' => 'chapai nawabganj' ,'division_slug' => 'rajshahi']);
        District::create(['name'=> 'Pabna' ,'slug' => 'pabna' ,'division_slug' => 'rajshahi']);
        District::create(['name'=> 'Rajshahi' ,'slug' => 'rajshahi' ,'division_slug' => 'rajshahi']);
        District::create(['name'=> 'Sirajganj' ,'slug' => 'sirajganj' ,'division_slug' => 'rajshahi']);

        District::create(['name'=> 'Dinajpur' ,'slug' => 'dinajpur' ,'division_slug' => 'rangpur']);
        District::create(['name'=> 'Gaibandha' ,'slug' => 'gaibandha' ,'division_slug' => 'rangpur']);
        District::create(['name'=> 'Kurigram' ,'slug' => 'kurigram' ,'division_slug' => 'rangpur']);
        District::create(['name'=> 'Lalmonirhat' ,'slug' => 'lalmonirhat' ,'division_slug' => 'rangpur']);
        District::create(['name'=> 'Nilphamar' ,'slug' => 'nilphamar' ,'division_slug' => 'rangpur']);
        District::create(['name'=> 'Panchagarh' ,'slug' => 'panchagarh' ,'division_slug' => 'rangpur']);
        District::create(['name'=> 'Rangpur' ,'slug' => 'rangpur' ,'division_slug' => 'rangpur']);
        District::create(['name'=> 'Thakurgaon' ,'slug' => 'thakurgaon' ,'division_slug' => 'rangpur']);

        District::create(['name'=> 'Habiganj' ,'slug' => 'habiganj' ,'division_slug' => 'sylhet']);
        District::create(['name'=> 'Moulvibazar' ,'slug' => 'moulvibazar' ,'division_slug' => 'sylhet']);
        District::create(['name'=> 'Sunamganj' ,'slug' => 'sunamganj' ,'division_slug' => 'sylhet']);
        District::create(['name'=> 'Sylhet' ,'slug' => 'sylhet' ,'division_slug' => 'sylhet']);


    }
}
