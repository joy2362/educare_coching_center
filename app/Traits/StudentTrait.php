<?php
namespace App\Traits;

use App\Models\Classes;
use App\Models\studentDetails;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

trait StudentTrait {

    public function store_validation (Request $request){
        $request->validate([
            'firstname' => 'required|max:55',
            'lastname' => 'required|max:55',
            'dob' => 'required',
            'gender' => 'required',
            'father_name' => 'required',
            'mother_name' => 'required',
            'institute' => 'required',
            'parent_contact_number' => 'required|regex:/(01)[0-9]{9}/',
            'contact_number' => 'nullable|regex:/(01)[0-9]{9}/',
            'father_occupation' => 'required',

            'present_address' => 'required',
            'permanent_address' => 'required',

            'class' => 'required',
            'batch' => 'required',

            'division' => 'required',
            'district' => 'required',
            'avatar' => 'required',
        ]);
    }

    public function student_create(Request $request){
       return studentDetails::create([
            'first_name' => $request->firstname,
            'last_name' => $request->lastname,
            'father_name' => $request->father_name,
            'mother_name' => $request->mother_name,
            'current_institute' => $request->institute,
            'parent_contact_number' => $request->parent_contact_number,
            'contact_number' => $request->contact_number,
            'blood_group' => $request->blood_group,
            'father_occupation' => $request->father_occupation,
            'present_address' => $request->present_address,
            'permanent_address' => $request->permanent_address,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'district_id' => $request->district,
            'division_id' => $request->division,
            'class_id' => $request->class,
            'batch_id' => $request->batch,
        ]);
    }

    public function user_create( $class , $id ,$avatar, $email = null){
        $username = self::generate_username($class,$id);
        $password = Str::random('6');

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

    static function generate_username($id,$details){
        $class = Classes::find($id);
        $last_id = self::check_last_username($class,$details);

        $new_id = intval($last_id) + 1;
        $user_id =self::check_id_value($new_id);
        
        return now()->format('Y') . $class->class_code . $user_id;
    }

    static function check_id_value($id){
        return str_pad($id, 3, '0', STR_PAD_LEFT);
    }
    
    static function check_last_username($class,$id){
        //$slice = Str::after('This is my name', 'This is');
        // ' my name'
        $student = studentDetails::with('user')->where('id','!=',$id)->where('class_id',$class->id)->latest()->first();
       // return now()->format('Y') . $class->class_code;
        if(!empty($student)){
            if(!Str::startsWith($student->user->username , now()->format('Y'))){

                return 0;
            }else{
               return Str::after($student->user->username, now()->format('Y') . $class->class_code);
            }
        }else{
            return 0;
        }
    }

}
