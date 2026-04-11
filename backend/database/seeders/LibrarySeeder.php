<?php

namespace Database\Seeders;

use App\Models\Belong;
use App\Models\Inventory;
use App\Models\Library;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LibrarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Library and inventory
     */
    public function run(): void
    {
        $libraries = [
            ['Biblioteca Central', 'Av. Principal 123', '555-2001'],
            ['Biblioteca Norte', 'Calle Norte 45', '555-2002'],
            ['Biblioteca Sur', 'Calle Sur 67', '555-2003'],
            ['Biblioteca Este', 'Calle Este 89', '555-2004'],
            ['Biblioteca Oeste', 'Calle Oeste 10', '555-2005'],
            ['Biblioteca Playa', 'Av. Mar 77', '555-2006'],
            ['Biblioteca Montaña', 'Camino Alto 22', '555-2007'],
            ['Biblioteca Urbana', 'Plaza 5', '555-2008'],
            ['Biblioteca Rural', 'Carretera 8', '555-2009'],
            ['Biblioteca Universitaria', 'Campus 1', '555-2010'],  
        ];

        foreach ($libraries as $lib) {
            Library::create([
                'name' => $lib[0],
                'address' => $lib[1],
                'tel_number' => $lib[2],
            ]);
        }

        $inventories = [
            [1, 10, 'Estantería A', '978-0001'],
            [2, 15, 'Estantería B', '978-0002'],
            [3, 20, 'Estantería C', '978-0003'],
            [4, 5, 'Estantería D', '978-0004'],
            [5, 12, 'Estantería E', '978-0005'],
            [6, 8, 'Estantería F', '978-0006'],
            [7, 18, 'Estantería G', '978-0007'],
            [8, 25, 'Estantería H', '978-0008'],
            [9, 7, 'Estantería I', '978-0009'],
            [10, 30, 'Estantería J', '978-0010'],
        ];

        foreach ($inventories as $inv) {
            Inventory::create([
                'library_id' => $inv[0],
                'quantity' => $inv[1],
                'location' => $inv[2],
                'isbn' => $inv[3], // Se asigna el ISBN directamente al inventario
            ]);
        }
        
        // Se eliminó el bucle $belongs
    }
}
