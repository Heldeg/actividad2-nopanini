import { Component, inject, signal, WritableSignal } from '@angular/core';
import { Categories } from '../categories/categories';
import { AuthService } from '../../services/auth/auth.service';
import { RouterLink } from '@angular/router';
import { Router } from '@angular/router';

@Component({
  selector: 'app-header',
  standalone: true,
  imports: [Categories, RouterLink],
  templateUrl: './header.html',
  styleUrl: './header.css',
})
export class Header {
  public authService: AuthService = inject(AuthService);
  public isLoggedIn: WritableSignal<boolean>;
  constructor(private router: Router) {
    this.isLoggedIn = signal<boolean>(this.authService.isLoggedIn());
  }
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

  onLogin() {
    this.router.navigate(['/login']);
  }


  onLogout() {
    this.authService.logout().subscribe({
      next: (info) => {
        console.log('Logout successful:', info);
        this.isLoggedIn.set(this.authService.isLoggedIn());
      }, error: (error) => {
        console.error('Logout error:', error);
      }
      
    });
  }
}
