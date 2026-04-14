import { Component, signal, WritableSignal, Output, EventEmitter } from '@angular/core';
import { CategoryService } from '../../services/category.service';
import { CommonModule } from '@angular/common';
import { CategoryModel } from '../../models/category.model';
import { finalize } from 'rxjs';


@Component({
  selector: 'app-categories',
  imports: [CommonModule],
  templateUrl: './categories.html',
  styleUrl: './categories.css',
})
export class Categories {
  public categories: WritableSignal<Array<CategoryModel>>;
  public loading = signal(true);
  public activeIndex = signal(0);

  @Output() categorySelected = new EventEmitter<string>();

  constructor(private categoryService: CategoryService) {
    this.categories = signal<Array<CategoryModel>>([]);
    this.categoryService.getCategories().pipe(
      finalize(() => {
        this.loading.set(false);
      })
    ).subscribe({
        next: (info) => {
          console.log('Categories fetched successfully:', info);
          this.categories.set(info);
        },
        error: (err) => {
          console.error('Error fetching categories:', err);
        }
    });
  }

  selectCategory(index: number, categoryName: string): void {
    this.activeIndex.set(index);
    this.categorySelected.emit(categoryName);
  }

}
