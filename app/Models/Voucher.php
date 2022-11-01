<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $guarded = [""];

    public function scopeFilter($query, array $filter)
    {
        $query->when($filter['search'] ?? false, function($query, $collect){
            $query->where('name', 'LIKE' , '%' . $collect . '%')
            ->orWhere('code', 'LIKE', '%' . $collect . '%')
            ->orWhere('type', 'LIKE', '%' . $collect . '%')
            ->ordWhere('description', 'LIKE' , '%' . $collect . '%')
            ->ordWhere('limit', 'LIKE' , '%' . $collect . '%')
            ->ordWhere('expired', 'LIKE' , '%' . $collect . '%');
        });
    }
}
