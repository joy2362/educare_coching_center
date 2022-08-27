<?php
namespace App\Traits;

trait SendSmsTrait {
    //do something useful
     private $bulkSms_user_id, $bulkSms_user_password , $bulksms_url;

     public function __construct(){
         $this->bulkSms_user_id = config('bulkSms.username');
         $this->bulkSms_user_password = config('bulkSms.password');
         $this->bulksms_url = config('bulkSms.url');
     }

     public function prepareNumber($student){
         $number = "";
         foreach ($student as $row){
            $number = $row.",". $number ;
         }
         return $number;
     }

     public function admission($id,$password): string
     {
         return "Congratulations. Admission Successful. Username:".$id ." Password:".$password
         .". https://www.educaremymbd.com";
     }

     public function result($subject,$result,$total): string
     {
        return "Result published for ".$subject." . Your result " .$result."/".$total.".";
     }

    public function payment(): string
    {
        return "Your payment is successful.";
    }

     public function prepareSms($number,$text): array
     {
         return array(
             'username'=> $this->bulkSms_user_id,
             'password'=> $this->bulkSms_user_password,
             'number'=> $number ,
             'message'=> "$text" ,
         );
     }


     public function send($data){
         $ch = curl_init(); // Initialize cURL
         curl_setopt($ch, CURLOPT_URL, $this->bulksms_url);
         curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
         curl_exec($ch);
     }

}
