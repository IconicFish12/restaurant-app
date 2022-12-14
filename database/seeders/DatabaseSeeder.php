<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Attendance;
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
        Employee::factory(10)->create();
        Table::factory(30)->create();

        $data = [
            [
                "name" => "Ibnu Syawal Aliefian",
                "birth" => "2004-11-04",
                "phone_number" => "082162941198",
                "role" => "admin",
                "username" => "Admin",
                "password" => Hash::make('password'),
                "email" => "superglidingogre0571@gmail.com"
            ],
            [
                "name" => "Mochammad Ibnu Kamil",
                "birth" => "2007-05-13",
                "phone_number" => "081123515454",
                "role" => "costumer",
                "username" => "IbnuKamil",
                "password" => Hash::make('password'),
                "email" => "blastergmly@gmail.com"
            ],
        ];

        User::insert($data);

        $this->call([
            CategorySeeder::class,
            EmployeeSeeder::class,
        ]);
    }
}
