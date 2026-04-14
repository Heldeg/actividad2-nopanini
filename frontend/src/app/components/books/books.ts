import { Component, Input, OnInit, WritableSignal, signal } from '@angular/core';
import { BookModel } from '../../models/book.model';
import { BookService } from '../../services/book.service';
import { finalize } from 'rxjs';
import { CommonModule, UpperCasePipe } from '@angular/common';
import { MatDialog } from '@angular/material/dialog';
import { BookDetailModal } from '../book-detail-modal/book-detail-modal';



@Component({
  selector: 'app-books',
  imports: [UpperCasePipe, CommonModule],
  templateUrl: './books.html',
  styleUrl: './books.css',
})
export class Books {
  public bookList: WritableSignal<Array<BookModel>>;
  public loading = signal(true);
  private currentCategory = '';
  private currentSearchQuery = '';
  private initialized = false;

  constructor(
    private bookService: BookService,
    public dialog: MatDialog
  ) {
    this.bookList = signal<Array<BookModel>>([]);
  }

  ngOnInit(): void {
    this.initialized = true;
    this.loadBooks();
  }

  @Input() set selectedCategory(category: string) {
    this.currentCategory = category.trim().toLowerCase();

    if (this.initialized) {
      this.loadBooks();
    }
  }

  @Input() set searchQuery(query: string) {
    this.currentSearchQuery = query.trim().toLowerCase();

    if (this.initialized) {
      this.loadBooks();
    }
  }

  private loadBooks(): void {
    this.loading.set(true);
    const req = this.currentSearchQuery
      ? this.bookService.searchBooks('title', this.currentSearchQuery)
      : this.currentCategory
        ? this.bookService.searchBooks('category', this.currentCategory)
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

  bookDetails(book: BookModel): void {
    this.dialog.open(BookDetailModal, {
      width: '560px',
      data: { book }
    });
  }
}
