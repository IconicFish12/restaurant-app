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
        $this->belongsTo(User::class, 'user_id');
    }

    public function menu()
    {
        $this->hasMany(Menu::class, 'menu_id');
    }

    public function table()
    {
        $this->belongsTo(Table::class, 'table_id');
    }

    // public function payment()
    // {
    //     $this->belongsTo(PaymentMethod::class, 'payment_id');
    // }
}
