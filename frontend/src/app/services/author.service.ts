import { Injectable } from '@angular/core';
import { environment } from '../../environments/environment.development';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root',
})
export class AuthorService {
  private apiUrl = `${environment.apiUrl}`;

  constructor(private http: HttpClient) {

  }
  // Obtener la lista de autores desde el backend
  public getAuthors(): Observable<any> {
    return this.http.get(this.apiUrl + '/authors');
  }

  // Obtener un autor específico por su ID
  public getAuthorById(id: number): Observable<any> {
    return this.http.get(this.apiUrl + '/authors/' + id);
  }

  // Actualizar un autor específico por su ID
  public updateAuthor(id: number, authorData: any): Observable<any> {
    return this.http.put(this.apiUrl + '/authors/' + id, authorData);
  }

  // Crear un nuevo autor
  public createAuthor(authorData: any): Observable<any> {
    return this.http.post(this.apiUrl + '/authors', authorData);
  }

  // Eliminar un autor específico por su ID
  public deleteAuthor(id: number): Observable<any> {
    return this.http.delete(this.apiUrl + '/authors/' + id);
  }

  // Busqueda avanzada de autores por nombre, genero, país, etc.
  public searchAuthors(param: string, query: string): Observable<any> {
    return this.http.get(this.apiUrl + '/authors/search?' + param + '=' + query);
  }
}
