<?php
namespace App\Traits;

trait SendSmsTrait {
    //do somthing useful
     private $bluksms_user_id, $bluksms_user_password , $bluksms_url;

     public function __construct(){
         $this->bluksms_user_id = env('BULKSMS_USER_ID');
         $this->bluksms_user_password = env('BULKSMS_PASSWORD');
         $this->bluksms_url = env('BULKSMS_URL');
     }

     public function prepare_number($student){
         $number = "";
         foreach ($student as $row){
            $number = $row->parent_contact_number.",". $number ;
         }
     }

     public function admission($id,$student_password){
         return "Congratulations. Admission Successful. Username:".$id ." Password:".$student_password
         .". https://www.educaremymbd.com";
     }

     public function result($subject,$result,$total){
        return "Result published for ".$subject." . Your result " .$result."/".$total.".";
     }

    public function payment(){
        return "Your payment is successful.";
    }

     public function prepare_data($number,$text){
         $data = array(
             'username'=> $this->bluksms_user_id,
             'password'=> $this->bluksms_user_password,
             'number'=> $number,
             'message'=> "$text" ,
         );
         return $data;
     }


     public function send($data){
         $ch = curl_init(); // Initialize cURL
         curl_setopt($ch, CURLOPT_URL, $this->bluksms_url);
         curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
         curl_exec($ch);
     }

}
