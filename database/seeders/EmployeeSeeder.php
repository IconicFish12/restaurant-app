<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                "name" => "Ibnu Syawal Aliefian",
                "birth" => "2004-11-16",
                "age" => "18",
                "phone_number" => "082162941198",
                "position" => "Admin",
                "email" => "ibnuSyawal@gmail.com",
                "status" => "Y",
                "password" => Hash::make("gigantara")
            ],
            [
                "name" => "Mochammad Ibnu Kamil",
                "birth" => "2007-05-13",
                "age" => "16",
                "phone_number" => "083144158831",
                "position" => "Staff",
                "email" => "KamilCuyy@gmail.com",
                "status" => "Y",
                "password" => Hash::make("cocokologi")
            ],
            [
                "name" => "Muhammad Iqro Negoro",
                "birth" => "2005-08-18",
                "age" => "17",
                "phone_number" => "083144158812",
                "position" => "Staff",
                "email" => "IqroNegoro@gmail.com",
                "status" => "Y",
                "password" => Hash::make("iqroganteng")
            ],
            [
                "name" => "Aqilah Azzahra",
                "birth" => "2005-08-18",
                "age" => "17",
                "phone_number" => "083145418812",
                "position" => "Manager",
                "email" => "Aqilah1111@gmail.com",
                "status" => "N",
                "password" => Hash::make("gaktauapaan")
            ],
            [
                "name" => "Akhmad Alwan Rabbani",
                "birth" => "2005-07-11",
                "age" => "17",
                "phone_number" => "082176158812",
                "position" => "Chef",
                "email" => "ARRabbani@gmail.com",
                "status" => "Y",
                "password" => Hash::make("AlwanCoding")
            ],
        ];

        Employee::insert($data);
    }
}
