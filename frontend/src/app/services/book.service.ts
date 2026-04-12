import { Injectable } from '@angular/core';
import { environment } from '../../environments/environment.development';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root',
})
export class BookService {
  private apiUrl = `${environment.apiUrl}`;
  constructor(private http: HttpClient) {

  }

  // Obtener la lista de libros desde el backend
  public getBooks(): Observable<any> {
    return this.http.get(this.apiUrl + '/books');
  }

  // Obtener un libro específico por su ID
  public getBookById(id: number): Observable<any> {
    return this.http.get(this.apiUrl + '/books/' + id);
  }

  // Actualizar un libro específico por su ID
  public updateBook(id: number, bookData: any): Observable<any> {
    return this.http.put(this.apiUrl + '/books/' + id, bookData);
  }

  // Crear un nuevo libro
  public createBook(bookData: any): Observable<any> {
    return this.http.post(this.apiUrl + '/books', bookData);
  }

  // Eliminar un libro específico por su ID
  public deleteBook(id: number): Observable<any> {
    return this.http.delete(this.apiUrl + '/books/' + id);
  }

  // Busqueda avanzada de libros por título, descripción, numero de edición, etc.
  public searchBooks(param: string, query: string): Observable<any> {
    return this.http.get(this.apiUrl + '/books/search?' + param + '=' + query);
  }

}
