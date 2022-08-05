<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class studentDetails extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    }

    public function getUpdatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    }

    public function results()
    {
        return $this->hasMany(Result::class, 'student_id', 'id');
    }

     public function district()
     {
        return $this->belongsTo(District::class);
     }

     public function division(){
        return $this->belongsTo(Divisions::class);
     }

     public function class(){
         return $this->belongsTo(Classes::class);
     }

     public function batch(){
         return $this->belongsTo(Batch::class);
     }

    public function user(){
      return $this->hasOne(User::class);
   }

     public function getNameAttribute()
     {
        return "{$this->first_name} {$this->last_name}";
     }
}
