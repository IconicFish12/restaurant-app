<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Employee;
use App\Models\Table;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        Employee::factory(10)->create();
        Table::factory(30)->create();

        $data = [
            [
                "firstname" => "Ibnu Syawal",
                "lastname" => "Aliefian",
                "birth" => "2004-11-04",
                "phone_number" => "082162941198",
                "role" => "admin",
                "username" => "Admin",
                "password" => Hash::make('password'),
                "email" => "superglidingogre0571@gmail.com"
            ],
            [
                "firstname" => "Mochammad Ibnu",
                "lastname" => "Kamil",
                "birth" => "2007-05-13",
                "phone_number" => "081123515454",
                "role" => "costumer",
                "username" => "IbnuKamil",
                "password" => Hash::make('password'),
                "email" => "IbnuKamil@gmail.com"
            ],
        ];

        User::insert($data);

        $this->call([
            CategorySeeder::class,
            EmployeeSeeder::class
        ]);
    }
}
