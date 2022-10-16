<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Employee extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function scopeFilter($query, array $filter)
    {
        $query->when($filter['search'] ?? false, function($query, $collect){
            $query->where('name', 'LIKE' , '%' . $collect . '%')
            ->orWhere('employee_code', 'LIKE', '%' . $collect . '%')
            ->orWhere('position', 'LIKE', '%' . $collect . '%')
            ->ordWhere('phone_number', 'LIKE' , '%' . $collect . '%');
        });
    }
}
