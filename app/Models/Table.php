<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;

    protected $guarded = [""];

    public function scopeFilter($query, array $filter)
    {
        $query->when($filter['search'] ?? false, function($query, $collect){
            $query->where('table_number', 'LIKE' , '%' . $collect . '%');
        });
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }
}
