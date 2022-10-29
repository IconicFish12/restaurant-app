<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Contact extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function scopeFilter($query, array $filter)
    {
        $query->when($filter['search'] ?? false, function($query, $collect){
            return $query->where('name', 'LIKE', '%' . $collect. '%')
            ->orWhere('email', 'LIKE', '%' . $collect. '%')
            ->orWhere('message', 'LIKE', '%' . $collect. '%')
            ->orWhere('phone_number', 'LIKE', '%' . $collect. '%')
            ;
        });
    }
}
