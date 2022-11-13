<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $guarded = [""];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'id');
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
