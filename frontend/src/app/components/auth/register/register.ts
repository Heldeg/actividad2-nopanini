import { Component, signal, WritableSignal } from '@angular/core';
import { Footer } from '../../footer/footer';
import { AuthService } from '../../../services/auth/auth.service';
import { Router, RouterLink } from '@angular/router';
import { FormsModule } from '@angular/forms';
import { finalize } from 'rxjs';


@Component({
  selector: 'app-register',
  imports: [Footer, FormsModule, RouterLink],
  templateUrl: './register.html',
  styleUrl: './register.css',
})
export class Register {
  public request: any;
  public errorMessage: WritableSignal<string>;
  public loading: WritableSignal<boolean>;

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
    this.errorMessage = signal('');
    this.loading = signal(false);


  }

onSubmit(): void {
    if (this.loading()) {
      return;
    }

    this.errorMessage.set('');

    if (this.request.password !== this.request.confirmPassword) {
      this.errorMessage.set('Las contraseñas no coinciden.');
      return;
    }

    const userData = {
      first_name: this.request.name,
      last_name: this.request.lastName,
      email: this.request.email,
      password: this.request.password,
      gender: this.request.gender
    };

    this.loading.set(true);

    this.authService.register(userData).pipe(
      finalize(() => this.loading.set(false))
    ).subscribe({
      next: (response) => {
        this.router.navigate(['/']); 
      },
      error: (error) => {
        if (error.error && error.error.message) {
           this.errorMessage.set(error.error.message);
        } else {
           this.errorMessage.set('Hubo un problema al crear la cuenta. Intenta de nuevo.');
        }
      }
    });
  }
}
