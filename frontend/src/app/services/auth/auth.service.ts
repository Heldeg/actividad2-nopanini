import { Injectable } from '@angular/core';
import { environment } from '../../../environments/environment.development';
import { HttpClient } from '@angular/common/http';
import { Observable, tap } from 'rxjs';

@Injectable({
  providedIn: 'root',
})
export class AuthService {
  private apiUrl = `${environment.apiUrl}`;

  constructor(private http: HttpClient) {
  }

  public login(credentials: any): Observable<any> {
    return this.http.post(`${this.apiUrl}/login`, credentials).pipe(
      tap((response: any) => {
        if (response.access_token) {
          this.setToken(response.access_token);
        }
        if (response.role) {
          localStorage.setItem('userRole', response.role);
        }
      })
    );
  }

  private setToken(token: string): void {
    localStorage.setItem('authToken', token);
  }

  public getToken(): string | null {
    return localStorage.getItem('authToken');
  }

  public isLoggedIn(): boolean {
    return this.getToken() !== null;
  }
  
  public logout(): void {

  }
  public register() {

  }
}
