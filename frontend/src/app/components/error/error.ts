import { Component } from '@angular/core';
import { RouterLink } from '@angular/router';
import { Categories } from '../categories/categories';
import { Footer } from '../footer/footer';
import { Header } from '../header/header';

@Component({
  selector: 'app-error',
  standalone: true,
  imports: [Header, Categories, Footer, RouterLink],
  templateUrl: './error.html',
  styleUrl: './error.css',
})
export class Error {

}
