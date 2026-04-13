import { Component, WritableSignal, signal, Input } from '@angular/core';
import { BookModel } from '../../models/book.model';
import { BookService } from '../../services/book.service';
import { finalize } from 'rxjs';



@Component({
  selector: 'app-books',
  imports: [],
  templateUrl: './books.html',
  styleUrl: './books.css',
})
export class Books {
  public bookList: WritableSignal<Array<BookModel>>;
  public loading = signal(true);

  constructor(private bookService: BookService) {
    this.bookList = signal<Array<BookModel>>([]);
  }

  @Input() set selectedCategory(category: string) {
    this.loading.set(true);
    const req = category
      ? this.bookService.searchBooks('category', category)
      : this.bookService.getBooks();
    req.pipe(finalize(() => this.loading.set(false))).subscribe({
      next: (info) => {
        console.log('Books fetched successfully:', info);
        this.bookList.set(info);
      },
      error: (err) => {
        console.error('Error fetching books:', err);
      }
    });
  }


  protected readonly booksTest = [
      { category: 'Clasicos', title: 'El Gran Gatsby' },
      { category: 'Ficcion', title: 'Cien Anos de Soledad' },
      { category: 'Misterio', title: 'El Codigo Da Vinci' },
      { category: 'Ciencia', title: 'Breve Historia del Tiempo' },
    ];
}
