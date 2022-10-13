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
            ["category_name" => "Mie"],
            ["category_name" => "Makanan Berat"],
            ["category_name" => "Salad"],
            ["category_name" => "Makanan Ringan"],
            ["category_name" => "Es Krim"],
        ];

        Category::insert($data);
    }
}
