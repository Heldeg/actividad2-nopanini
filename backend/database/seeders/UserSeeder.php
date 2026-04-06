<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Client;
use App\Models\Employee;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Users, clients, employees and administrators
     */
    public function run(): void
    {
        $userData = [
            [1, 'alice@example.com', 'Alice', 'Gonzalez', 'pass Alice1', 'F'],
            [2, 'bob@example.com', 'Bob', 'Martinez', 'pass Bob2', 'M'],
            [3, 'carla@example.com', 'Carla', 'Lopez', 'pass Carla3', 'F'],
            [4, 'diego@example.com', 'Diego', 'Rodriguez', 'pass Diego4', 'M'],
            [5, 'elena@example.com', 'Elena', 'Sanchez', 'pass Elena5', 'F'],
            [6, 'francisco@example.com', 'Francisco', 'Diaz', 'pass Francisco6', 'M'],
            [7, 'gabriela@example.com', 'Gabriela', 'Vargas', 'pass Gabriela7', 'F'],
            [8, 'hugo@example.com', 'Hugo', 'Castro', 'pass Hugo8', 'M'],
            [9, 'irene@example.com', 'Irene', 'Perez', 'pass Irene9', 'F'],
            [10, 'juan@example.com', 'Juan', 'Ramirez', 'pass Juan10', 'O'],
        ];
        // crear users
        foreach ($userData as $user) {
            $newUser = Users::create([
                'user_id' => $user[0],
                'email' => $user[1],
                'first_name' => $user[2],
                'last_name' => $user[3],
                'password' => Hash::make($user[4]),
                'gender' => $user[5],
            ]);
            // Add roles
            Client::create(['client_id' => $newUser->user_id]);

            Admin::create(['admin_id' => $newUser->user_id]);

            Employee::create([
                'employee_id' => $newUser->user_id,
                'dni' => 'DNI-' . $newUser->id . rand(1000, 9999),
                'tel_number' => '555-30' . sprintf('%02d', $newUser->id),
                'bank_account' => 'ES' . rand(10, 99) . ' 0000 0000 ' . rand(10, 99),
            ]);
        }



    }
}
