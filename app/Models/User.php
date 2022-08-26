<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
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


    public function getAvatarAttribute($value)
    {
        if (!empty($value)) {
            return Storage::url($value) ;
        }
         return null;
    }

    public function class()
    {
        return $this->belongsTo(Classes::class);
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }
    public function details(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(userDetail::class);
    }

    public function credit(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(StudentCredit::class);
    }

    public function debit(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(StudentDebit::class);
    }

    public static function getLastUsername($classId,$batchId): string
    {
        $class = Classes::find($classId);
        $students = User::where('class_id',$classId)->where('batch_id',$batchId)->latest('id')->get();

        if(!empty($students)){
            foreach ($students as $student){
                if( Str::startsWith(  $student->username , now()->format('Y'))){
                    $id = intval(Str::after($student->username, now()->format('Y') . $class->class_code))+1 ;
                    break;
                }
            }
        }else{
            $id = 1;
        }

        return  now()->format('Y') . $class->class_code . str_pad($id, 3, '0', STR_PAD_LEFT);
    }

    public static function getUserInfo($request,$pass = null){
        $userInfo = $request->only('email');
        $userInfo['class_id'] = $request->class;
        $userInfo['batch_id'] = $request->batch;
        if ($pass){
            $userInfo['password'] = Hash::make( $pass);
        }
        $userInfo['username'] = User::getLastUsername($request->class , $request->batch);

        return $userInfo;
    }

    public static function addAdmissionFee($id){
        $student = User::with('class')->find($id);
        $fee = [
            [
                'type' => 'admission fee',
                'amount' => $student->class->admission_fee,
            ],
            [
            'type' => 'other fee',
            'amount' => $student->class->other_fee,
            ],
            [
                'type' => 'monthly fee',
                'amount' => $student->class->monthly_fee,
            ]
        ];
        $student->credit()->createMany($fee);
    }
}
