<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ["category_name" => "Hors d'oeuvres"],
            ["category_name" => "Amuse-bouche"],
            ["category_name" => "Salad"],
            ["category_name" => "Breakfast"],
            ["category_name" => "Dinner"],
            ["category_name" => "Sup"],
            ["category_name" => "Seafood"],
            ["category_name" => "Appetizer"],
            ["category_name" => "First Main Course"],
            ["category_name" => "Second Main Course"],
            ["category_name" => "Dessert"],
            ["category_name" => "Mignardise"],
            ["category_name" => "Cheese"],
            ["category_name" => "Palate Cleanser"],
        ];

        Category::insert($data);
    }
}
