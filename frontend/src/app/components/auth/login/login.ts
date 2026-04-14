import { Component, signal, WritableSignal } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { AuthService } from '../../../services/auth/auth.service';
import { Footer } from '../../footer/footer';
import { Router, RouterLink } from '@angular/router';
import { finalize } from 'rxjs';

@Component({
  selector: 'app-login',
  imports: [FormsModule, Footer, RouterLink],
  templateUrl: './login.html',
  styleUrl: './login.css',
})
export class Login {
  public request: any;
  public errorMessage: WritableSignal<string>;
  public loading: WritableSignal<boolean>;

  constructor(
    private authService: AuthService,
    private router: Router,
  ) {
    this.request = {
      email: '',
      password: '',
    }
    this.errorMessage = signal('');
    this.loading = signal(false);
  }

  onSubmit(): void {
    if (this.loading()) {
      return;
    }

    this.errorMessage.set('');
    this.loading.set(true);

    this.authService.login(this.request).pipe(
      finalize(() => this.loading.set(false))
    ).subscribe({
      next: (response) => {
        this.router.navigate(['/home']);
      },
      error: (error) => {
        this.errorMessage.set('Credenciales inválidas. Por favor, inténtalo de nuevo.');
      }
    });
  }


}
