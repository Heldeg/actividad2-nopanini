import { Component, Inject } from '@angular/core';
import { MatDialogModule, MatDialog, MAT_DIALOG_DATA } from '@angular/material/dialog';
import { BookModel } from '../../models/book.model';
import { CommonModule } from '@angular/common';


@Component({
  selector: 'app-book-detail-modal',
  imports: [MatDialogModule, CommonModule],
  templateUrl: './book-detail-modal.html',
  styleUrl: './book-detail-modal.css',
})
export class BookDetailModal {

  constructor(
    public dialog: MatDialog,
    @Inject(MAT_DIALOG_DATA) public data: { book: BookModel }
  ) {}

  closeDialog(): void {
    this.dialog.closeAll();
  }

}
