import { Component } from '@angular/core';

@Component({
  selector: 'app-books',
  imports: [],
  templateUrl: './books.html',
  styleUrl: './books.css',
})
export class Books {
  protected readonly books = [
      { category: 'Clasicos', title: 'El Gran Gatsby' },
      { category: 'Ficcion', title: 'Cien Anos de Soledad' },
      { category: 'Misterio', title: 'El Codigo Da Vinci' },
      { category: 'Ciencia', title: 'Breve Historia del Tiempo' },
    ];
}
