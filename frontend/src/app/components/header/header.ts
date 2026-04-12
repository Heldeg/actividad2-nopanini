import { Component } from '@angular/core';
import { Categories } from '../categories/categories';

@Component({
  selector: 'app-header',
  standalone: true,
  imports: [Categories],
  templateUrl: './header.html',
  styleUrl: './header.css',
})
export class Header {
  protected readonly categories = [
    'Todos',
    'Clasicos',
    'Ficcion',
    'Misterio',
    'Ciencia',
    'Fantasia',
    'Poesia',
  ];

  protected readonly books = [
    { category: 'Clasicos', title: 'El Gran Gatsby' },
    { category: 'Ficcion', title: 'Cien Anos de Soledad' },
    { category: 'Misterio', title: 'El Codigo Da Vinci' },
    { category: 'Ciencia', title: 'Breve Historia del Tiempo' },
  ];
}
