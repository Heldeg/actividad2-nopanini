import { Component, signal } from '@angular/core';
import { Header } from '../header/header';
import { Categories } from "../categories/categories";
import { Books } from "../books/books";
import { Footer } from '../footer/footer';

@Component({
  selector: 'app-home',
  standalone: true,
  imports: [Header, Categories, Books, Footer],
  templateUrl: './home.html',
  styleUrl: './home.css',
})
export class Home {
  public selectedCategory = signal('');

  onCategorySelected(category: string): void {
    this.selectedCategory.set(category);
  }
}
