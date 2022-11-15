<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Employee extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];
    protected $guarded = [""];

    protected $guard = "employee";

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'employee_id');
    }

    public function work()
    {
        return $this->hasMany(Work::class, 'employee_id');
    }

    public function Performance()
    {
        return $this->hasMany(Performance::class, 'employee_id');
    }

    public function scopeFilter($query, array $filter)
    {
        $query->when($filter['search'] ?? false, function($query, $collect){
            $query->where('name', 'LIKE' , '%' . $collect . '%')
            ->orWhere('employee_code', 'LIKE', '%' . $collect . '%')
            ->orWhere('position', 'LIKE', '%' . $collect . '%')
            ->ordWhere('phone_number', 'LIKE' , '%' . $collect . '%')
            ->ordWhere('active', 'LIKE' , '%' . $collect . '%');
        });
    }
}


