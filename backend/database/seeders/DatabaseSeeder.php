<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            PropertySeeder::class,
            BookSeeder::class,
            LibrarySeeder::class,
            OrderSeeder::class,
            InteractionSeeder::class
        ]);

        $this->command->info('¡Database Created successfully!');
        $this->command->info('The database has been seeded with the initial data.');
    }
}
