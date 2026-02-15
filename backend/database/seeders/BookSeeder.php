<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Books, author and classify
     */
    public function run(): void
    {
        $books = [
            ['978-0001', 1, 'Don Quijote', 'Desc...', '1', 'Español', 19.90, [11, 13], [23]], 
            ['978-0002', 2, 'La Casa de los Espíritus', 'Desc...', '2', 'Español', 14.50, [12], [21]],
            ['978-0003', 3, 'Cien años de soledad', 'Desc...', '3', 'Español', 18.00, [13], [23]],
            ['978-0004', 4, 'Como agua para chocolate', 'Desc...', '1', 'Español', 13.75, [14], [24]],
            ['978-0005', 5, 'La ciudad y los perros', 'Desc...', '2', 'Español', 15.00, [15], [21]],
            ['978-0006', 6, 'En el tiempo de las mariposas', 'Desc...', '1', 'Español', 12.99, [16], [22]],
            ['978-0007', 7, 'Ficciones', 'Desc...', '3', 'Español', 11.20, [17], [28]],
            ['978-0008', 8, 'Americanah', 'Desc...', '1', 'Inglés', 16.40, [18], [29]],
            ['978-0009', 9, 'Kafka en la orilla', 'Desc...', '2', 'Japonés', 17.00, [19], [21]],
            ['978-0010', 10, 'Demasiada felicidad', 'Desc...', '3', 'Inglés', 10.00, [20], [30]],
        ];

        foreach ($books as $b) {
            $book = Book::create([
                'isbn' => $b[0],
                'editorial_id' => $b[1], 
                'title' => $b[2],
                'description' => $b[3],
                'edition_num' => $b[4],
                'language' => $b[5],
                'price' => $b[6],
                'cover_image' => 'https://edit.org/images/cat/book-covers-big-2019101610.jpg', 
            ]);

            $book->authors()->attach($b[7]);
            $book->categories()->attach($b[8]);
        }
    }
}
