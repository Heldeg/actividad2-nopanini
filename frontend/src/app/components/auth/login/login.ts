import { Component } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { AuthService } from '../../../services/auth/auth.service';
import { Footer } from '../../footer/footer';

@Component({
  selector: 'app-login',
  imports: [FormsModule, Footer],
  templateUrl: './login.html',
  styleUrl: './login.css',
  providers: [AuthService]
})
export class Login {
  public request: any;
  constructor(private authService: AuthService) {
    this.request = {
      email: '',
      password: '',
    }


  }

  onSubmit(): void {
    this.authService.login(this.request).subscribe({
      next: (response) => {
        // Handle successful login
      },
      error: (error) => {
        // Handle login error
      }
    });
  }


}
