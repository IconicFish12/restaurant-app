<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $guarded = [""];

    public function category()
    {
        return $this->belongsTo(Category::class, "category_id");
    }

    public function scopeFilter($query, array $filter)
    {
        // if(isset($filter['search'])  ? $filter['search'] : false){
        //     return  $query->where('name', 'LIKE', '%' . $filter['search'] . '%')
        //     ->orWhere('menu_type', 'LIKE', '%' .  $filter['search'] . '%')
        //     ->orWhere('description', 'LIKE', '%' . $filter['search'] . '%');
        // }

        $query->when($filter['search'] ?? false, function($query, $collect){
            return  $query->where('name', 'LIKE', '%' . $collect . '%')
            ->orWhere('menu_type', 'LIKE', '%' .  $collect . '%')
            ->orWhere('description', 'LIKE', '%' . $collect . '%');
        });

        // $query->when($filter['category'] ?? false, function( $query, $category){
        //     return $query->whereHas('category', function($query) use ($category){
        //         $query->where('category_name', $category);
        //     });
        // }); -> search with category
    }
}
