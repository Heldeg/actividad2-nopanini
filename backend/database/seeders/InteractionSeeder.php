<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InteractionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Likes and preferences
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            // User Likes
            DB::table('user_likes')->insert([
                'client_id' => $i,
                'isbn' => '978-' . sprintf('%04d', $i),
                'created_at' => now(),
            ]);

            // Preferences (Cliente le gusta Propiedad/Categoría)
            // Asignamos que al cliente 1 le gusta la Categoría 21, etc.
            DB::table('preferences')->insert([
                'client_id' => $i,
                'property_id' => 20 + $i, // Apunta a las Categorías (IDs 21-30)
                'created_at' => now(),
            ]);
        }
    }
}
