import { Component } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { AuthService } from '../../../services/auth/auth.service';
import { Footer } from '../../footer/footer';
import { Router, RouterLink } from '@angular/router';

@Component({
  selector: 'app-login',
  imports: [FormsModule, Footer, RouterLink],
  templateUrl: './login.html',
  styleUrl: './login.css',
})
export class Login {
  public request: any;
  public errorMessage: string;
  constructor(
    private authService: AuthService,
    private router: Router,
  ) {
    this.request = {
      email: '',
      password: '',
    }
    this.errorMessage = '';


  }

  onSubmit(): void {
    this.authService.login(this.request).subscribe({
      next: (response) => {
        this.router.navigate(['/home']);
      },
      error: (error) => {
        this.errorMessage = 'Credenciales inválidas. Por favor, inténtalo de nuevo.';
      }
    });
  }


}
