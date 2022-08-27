<?php

namespace App\Models;

use App\Models\System\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class userDetail extends BaseModel
{
    use HasFactory;

    protected $guarded = [];

    public function district(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    public function division(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Divisions::class);
    }

    public static function getData($request){
        $data = $request->only('father_name','mother_name','parent_contact_number','contact_number','blood_group','father_occupation','present_address','permanent_address','gender','dob');
        $data['first_name'] = $request->firstname;
        $data['last_name'] = $request->lastname;
        $data['current_institute'] = $request->institute;
        $data['district_id'] = $request->district;
        $data['division_id'] = $request->division;
        return $data;
    }

    public function getNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }


}
