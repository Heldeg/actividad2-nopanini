<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Client;
use App\Models\Employee;
use App\Models\User;
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
            ['alice@example.com', 'Alice', 'Gonzalez', 'pass Alice1', 'F'],
            ['bob@example.com', 'Bob', 'Martinez', 'pass Bob2', 'M'],
            ['carla@example.com', 'Carla', 'Lopez', 'pass Carla3', 'F'],
            ['diego@example.com', 'Diego', 'Rodriguez', 'pass Diego4', 'M'],
            ['elena@example.com', 'Elena', 'Sanchez', 'pass Elena5', 'F'],
            ['francisco@example.com', 'Francisco', 'Diaz', 'pass Francisco6', 'M'],
            ['gabriela@example.com', 'Gabriela', 'Vargas', 'pass Gabriela7', 'F'],
            ['hugo@example.com', 'Hugo', 'Castro', 'pass Hugo8', 'M'],
            ['irene@example.com', 'Irene', 'Perez', 'pass Irene9', 'F'],
            ['juan@example.com', 'Juan', 'Ramirez', 'pass Juan10', 'O'],
        ];
        // crear users
        foreach ($userData as $user) {
            $newUser = User::create([
                'email' => $user[0],
                'first_name' => $user[1],
                'last_name' => $user[2],
                'password' => Hash::make($user[3]),
                'gender' => $user[4],
            ]);
            // Add roles
            Client::create(['client_id' => $newUser->id]);

            Admin::create(['admin_id' => $newUser->id]);

            Employee::create([
                'employee_id' => $newUser->id,
                'dni' => 'DNI-' . $newUser->id . rand(1000, 9999),
                'tel_number' => '555-30' . sprintf('%02d', $newUser->id),
                'bank_account' => 'ES' . rand(10, 99) . ' 0000 0000 ' . rand(10, 99),
            ]);
        }



    }
}
