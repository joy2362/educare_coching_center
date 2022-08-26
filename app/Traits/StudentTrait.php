<?php
namespace App\Traits;

use App\Models\Classes;
use App\Models\studentDetails;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

trait StudentTrait {



    public function student_create(Request $request){
       return studentDetails::create([
            'first_name' => $request->firstname,
            'last_name' => $request->lastname,

            'current_institute' => $request->institute,

            'district_id' => $request->district,
            'division_id' => $request->division,

        ]);
    }

    public function user_create( $class , $id ,$avatar, $email = null){
        $username = self::generate_username($class,$id);

       $user = User::create([
            "username" => $username,
            "student_details_id" => $id,
            "password" => Hash::make($password),
            "email" => $email,
            "avatar" => $avatar,
        ]);

        $data = [
            'password' => $password,
            'username' => $username,
            'user' => $user,
        ];

        return $data;
    }


}
