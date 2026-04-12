import { Injectable } from '@angular/core';
import { environment } from '../../environments/environment.development';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root',
})
export class LibraryService {
  private apiUrl = `${environment.apiUrl}`;

  constructor(private http: HttpClient) {

  }
  // Obtener la lista de bibliotecas desde el backend
  public getLibrary(): Observable<any> {
    return this.http.get(this.apiUrl + '/libraries');
  }
  // Obtener una biblioteca específica por su ID
  public getLibraryById(id: number): Observable<any> {
    return this.http.get(this.apiUrl + '/libraries/' + id);
  }
  // Actualizar una biblioteca específica por su ID
  public updateLibrary(id: number, libraryData: any): Observable<any> {
    return this.http.put(this.apiUrl + '/libraries/' + id, libraryData);
  }
  // Crear una nueva biblioteca
  public createLibrary(libraryData: any): Observable<any> {
    return this.http.post(this.apiUrl + '/libraries', libraryData);
  }
  // Eliminar una biblioteca específica por su ID
  public deleteLibrary(id: number): Observable<any> {
    return this.http.delete(this.apiUrl + '/libraries/' + id);
  }
  // Busqueda avanzada de bibliotecas por su nombre, dirección, etc.
  public searchLibraries(param: string, query: string): Observable<any> {
    return this.http.get(this.apiUrl + '/libraries/search?' + param + '=' + query);
  }
}
