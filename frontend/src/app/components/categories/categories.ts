import { Component, signal, WritableSignal } from '@angular/core';
import { CategoryService } from '../../services/category.service';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { ChangeDetectorRef } from '@angular/core';
import { CommonModule } from '@angular/common';
import { CategoryModel } from '../../models/category.model';


@Component({
  selector: 'app-categories',
  imports: [CommonModule],
  templateUrl: './categories.html',
  styleUrl: './categories.css',
})
export class Categories {
  public categories: WritableSignal<Array<CategoryModel>>;
  constructor(
    private categoryService: CategoryService,
    private cdRef: ChangeDetectorRef
  ) {
    this.categories = signal<Array<CategoryModel>>([]);
    this.categoryService.getCategories().subscribe({
      next: (info) => {
        console.log('Categories fetched successfully:', info);
        this.categories.set(info);
        this.cdRef.detectChanges();
      },
      error: (err) => {
        console.error('Error fetching categories:', err);
      }
    });
  }

  protected readonly categoriesTest = [
    'Todos',
    'Clasicos',
    'Ficcion',
    'Misterio',
    'Ciencia',
    'Fantasia',
    'Poesia',
  ];
}
