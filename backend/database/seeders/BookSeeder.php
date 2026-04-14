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
    ['978-0001', 1, 'Don Quijote', 'Las aventuras de un hidalgo que, tras leer libros de caballería, pierde la razón y decide hacerse caballero andante.', '1', 'Español', 19.90, [11, 13], [23], 'https://edit.org/images/cat/book-covers-big-2019101610.jpg'], 
    ['978-0002', 2, 'La Casa de los Espíritus', 'Una saga familiar que sigue los movimientos sociales y políticos de la época poscolonial en Chile a través de tres generaciones.', '2', 'Español', 14.50, [12], [21], 'https://covers.openlibrary.org/b/id/12547141-L.jpg'],
    ['978-0003', 3, 'Cien años de soledad', 'La historia de siete generaciones de la familia Buendía en el pueblo ficticio de Macondo, obra cumbre del realismo mágico.', '3', 'Español', 18.00, [13], [23], 'https://covers.openlibrary.org/b/id/10403334-L.jpg'],
    ['978-0004', 4, 'Como agua para chocolate', 'Novela que mezcla gastronomía y sentimientos, donde las emociones de la protagonista se transmiten a través de sus recetas.', '1', 'Español', 13.75, [14], [24], 'https://covers.openlibrary.org/b/id/12838330-L.jpg'],
    ['978-0005', 5, 'La ciudad y los perros', 'Relato crudo sobre la vida de los cadetes en un colegio militar de Lima, exponiendo la brutalidad y la jerarquía social.', '2', 'Español', 15.00, [15], [21], 'https://covers.openlibrary.org/b/id/8231945-L.jpg'],
    ['978-0006', 6, 'En el tiempo de las mariposas', 'Basada en la vida de las hermanas Mirabal, quienes se opusieron valientemente a la dictadura de Trujillo en la República Dominicana.', '1', 'Español', 12.99, [16], [22], ''],
    ['978-0007', 7, 'Ficciones', 'Colección de relatos laberínticos que exploran conceptos sobre el infinito, espejos, bibliotecas y la naturaleza del tiempo.', '3', 'Español', 11.20, [17], [28], 'https://covers.openlibrary.org/b/id/10530754-L.jpg'],
    ['978-0008', 8, 'Americanah', 'Una joven nigeriana emigra a Estados Unidos, enfrentándose a cuestiones de raza, identidad y el significado de "pertenecer".', '1', 'Inglés', 16.40, [18], [29], 'https://covers.openlibrary.org/b/id/12834372-L.jpg'],
    ['978-0009', 9, 'Kafka en la orilla', 'Relato surrealista que entrelaza las vidas de un joven fugitivo y un anciano que puede hablar con los gatos.', '2', 'Japonés', 17.00, [19], [21], 'https://covers.openlibrary.org/b/id/12711042-L.jpg'],
    ['978-0010', 10, 'Demasiada felicidad', 'Una serie de cuentos que exploran los rincones oscuros y las revelaciones inesperadas en la vida cotidiana de las personas.', '3', 'Inglés', 10.00, [20], [30], 'https://covers.openlibrary.org/b/id/10355406-L.jpg'],
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
                'cover_image' => $b[9],
            ]);

            $book->authors()->attach($b[7]);
            $book->categories()->attach($b[8]);
        }
    }
}
