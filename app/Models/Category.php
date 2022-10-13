<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [""];

   public function scopeFilter($query, array $filter)
   {
        // if(isset($filter['search'])  ? $filter['search'] : false){
        //     return $query->where('category_name', 'LIKE', '%' . $filter['search']. '%');
        // } --> manual

        $query->when($filter['search'] ?? false, function($query, $collect){
            return $query->where('category_name', 'LIKE', '%' . $collect . '%');
        });
   }
}
