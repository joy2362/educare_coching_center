<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable ;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $guarded = [];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function details()
    {
        return $this->belongsTo(studentDetails::class, 'student_details_id','id');
    }

    public function getAvatarAttribute($value)
    {
        if (!empty($value)) {
            return Storage::url($value) ;
        }
         return null;
    }

    /**
     * Get the class.
    */
    public function classes()
    {
        return $this->belongsToMany( Classes::class )->using( studentDetails::class );
    }

    public function credit()
    {
        return $this->hasMany(StudentCredit::class);
    }

    public function debit()
    {
        return $this->hasMany(StudentDebit::class);
    }


}
