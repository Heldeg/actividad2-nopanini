import { Component, DestroyRef, EventEmitter, Output, inject, signal, WritableSignal } from '@angular/core';
import { AuthService } from '../../services/auth/auth.service';
import { Router } from '@angular/router';
import { TitleCasePipe } from '@angular/common';
import { debounceTime, distinctUntilChanged, finalize, Subject } from 'rxjs';
import { takeUntilDestroyed } from '@angular/core/rxjs-interop';

@Component({
  selector: 'app-header',
  standalone: true,
  imports: [TitleCasePipe],
  templateUrl: './header.html',
  styleUrl: './header.css',
})
export class Header {
  public authService: AuthService = inject(AuthService);
  private destroyRef = inject(DestroyRef);
  private searchTerms = new Subject<string>();
  public isLoggedIn: WritableSignal<boolean>;
  public logoutLoading: WritableSignal<boolean>;
  @Output() searchChanged = new EventEmitter<string>();

  constructor(private router: Router) {
    this.isLoggedIn = signal<boolean>(this.authService.isLoggedIn());
    this.logoutLoading = signal(false);

    this.searchTerms.pipe(
      debounceTime(300),
      distinctUntilChanged(),
      takeUntilDestroyed(this.destroyRef)
    ).subscribe((query) => {
      this.searchChanged.emit(query);
    });
  }

  onLogin() {
    this.router.navigate(['/login']);
  }

  getRole(): string {
    return (this.authService as any).getRole ? (this.authService as any).getRole() : 'Usuario';
  }

  onLogout() {
    if (this.logoutLoading()) {
      return;
    }

    this.logoutLoading.set(true);

    this.authService.logout().pipe(
      finalize(() => this.logoutLoading.set(false))
    ).subscribe({
      next: (info) => {
        console.log('Logout successful:', info);
        this.isLoggedIn.set(this.authService.isLoggedIn());
      }, error: (error) => {
        console.error('Logout error:', error);
      }
      
    });
  }

  onSearch(event: Event) {
    const input = event.target as HTMLInputElement;
    const query = input.value.trim().toLowerCase();
    this.searchTerms.next(query);
  }

}
