<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Category;
use App\Models\Editorial;
use App\Models\Property;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Editorial, author, categories
     */
    public function run(): void
    {
        $editorials = [
            [1, 'Main Plaza Property', '555-1001'],
            [2, 'Northside Property', '555-1002'],
            [3, 'Downtown Property', '555-1003'],
            [4, 'Lakeside Property', '555-1004'],
            [5, 'Hilltop Property', '555-1005'],
            [6, 'Riverside Property', '555-1006'],
            [7, 'Seaview Property', '555-1007'],
            [8, 'Garden Property', '555-1008'],
            [9, 'Sunset Property', '555-1009'],
            [10, 'Cedar Property', '555-1010'],
        ];
        foreach ($editorials as $ed) {
            $prop = Property::create(['id' => $ed[0], 'name' => $ed[1]]);
            Editorial::create(['editorial_id' => $prop->id, 'tel_number' => $ed[2]]);
        }

        $authors = [
            [11, 'Miguel de Cervantes', 'M', 'España', '1547-09-29', '1616-04-22'],
            [12, 'Isabel Allende', 'F', 'Chile', '1942-08-02', null],
            [13, 'Gabriel Garcia Marquez', 'M', 'Colombia', '1927-03-06', '2014-04-17'],
            [14, 'Laura Esquivel', 'F', 'México', '1950-09-30', null],
            [15, 'Mario Vargas Llosa', 'M', 'Perú', '1936-03-28', '2025-04-13'],
            [16, 'Julia Alvarez', 'F', 'República Dominicana', '1950-03-27', null],
            [17, 'Jorge Luis Borges', 'M', 'Argentina', '1899-08-24', '1986-06-14'],
            [18, 'Chimamanda Ngozi Adichie', 'F', 'Nigeria', '1977-09-15', null],
            [19, 'Haruki Murakami', 'M', 'Japón', '1949-01-12', null],
            [20, 'Alice Munro', 'F', 'Canadá', '1931-07-10', '2024-05-13'],
        ];
        foreach ($authors as $au) {
            $prop = Property::create(['id' => $au[0], 'name' => $au[1]]); // El nombre de propiedad es el nombre del autor
            Author::create([
                'author_id' => $prop->id,
                'full_name' => $au[1],
                'gender' => $au[2],
                'country' => $au[3],
                'birth_date' => $au[4],
                'death_date' => $au[5],
            ]);
        }
        $categories = [
            [21, 'Ficción', null],
            [22, 'No ficción', null],
            [23, 'Clásicos', 21],
            [24, 'Romance', 21],
            [25, 'Ciencia ficción', 21],
            [26, 'Biografías', 22],
            [27, 'Infantil', null],
            [28, 'Poesía', 21],
            [29, 'Ensayo', 22],
            [30, 'Misterio', 21],
        ];
        foreach ($categories as $cat) {
            $prop = Property::create(['id' => $cat[0], 'name' => $cat[1]]);
            Category::create([
                'category_id' => $prop->id,
                'name' => $cat[1],
                'parent_category_id' => $cat[2]
            ]);
        }
    }
}
