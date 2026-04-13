import { Component } from '@angular/core';
import { Footer } from '../../footer/footer';
import { AuthService } from '../../../services/auth/auth.service';
import { Router, RouterLink } from '@angular/router';
import { FormsModule } from '@angular/forms';


@Component({
  selector: 'app-register',
  imports: [Footer, FormsModule, RouterLink],
  templateUrl: './register.html',
  styleUrl: './register.css',
})
export class Register {
  public request: any;
  public errorMessage: string;

  constructor(
    private authService: AuthService,
    private router: Router,
  ) {
    this.request = {
      name: '',
      lastName: '',
      email: '',
      password: '',
      confirmPassword: '',
      gender: ''
    };
    this.errorMessage = '';


  }

onSubmit(): void {
    if (this.request.password !== this.request.confirmPassword) {
      this.errorMessage = 'Las contraseñas no coinciden.';
      return;
    }

    const userData = {
      first_name: this.request.name,
      last_name: this.request.lastName,
      email: this.request.email,
      password: this.request.password,
      gender: this.request.gender
    };

    this.authService.register(userData).subscribe({
      next: (response) => {
        this.router.navigate(['/']); 
      },
      error: (error) => {
        if (error.error && error.error.message) {
           this.errorMessage = error.error.message;
        } else {
           this.errorMessage = 'Hubo un problema al crear la cuenta. Intenta de nuevo.';
        }
      }
    });
  }
}
