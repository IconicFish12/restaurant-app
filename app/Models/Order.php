<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [""];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }

    public function table()
    {
        return $this->belongsTo(Table::class, 'table_id');
    }

    public function scopeFilter($query, array $filter)
    {
        $query->when($filter['search'] ?? false, function($query, $collect){
            $query->where('name', 'LIKE' , '%' . $collect . '%')
            ->orWhere('employee_code', 'LIKE', '%' . $collect . '%')
            ->orWhere('position', 'LIKE', '%' . $collect . '%')
            ->ordWhere('phone_number', 'LIKE' , '%' . $collect . '%');
        });
    }

    // public function payment()
    // {
    //     $this->belongsTo(PaymentMethod::class, 'payment_id');
    // }
}
