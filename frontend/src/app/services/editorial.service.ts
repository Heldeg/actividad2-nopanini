import { Injectable } from '@angular/core';
import { environment } from '../../environments/environment.development';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root',
})
export class EditorialService {
  private apiUrl = `${environment.apiUrl}`;

  constructor(private http: HttpClient) {

  }
  // Obtener la lista de editoriales desde el backend
  public getEditorial(): Observable<any> {
    return this.http.get(this.apiUrl + '/editorials');
  }

  // Obtener una editorial específica por su ID
  public getEditorialById(id: number): Observable<any> {
    return this.http.get(this.apiUrl + '/editorials/' + id);
  }

  // Actualizar una editorial específica por su ID
  public updateEditorial(id: number, editorialData: any): Observable<any> {
    return this.http.put(this.apiUrl + '/editorials/' + id, editorialData);
  }

  // Crear una nueva editorial
  public createEditorial(editorialData: any): Observable<any> {
    return this.http.post(this.apiUrl + '/editorials', editorialData);
  }

  // Eliminar una editorial específica por su ID
  public deleteEditorial(id: number): Observable<any> {
    return this.http.delete(this.apiUrl + '/editorials/' + id);
  }

  // Busqueda avanzada de editoriales por su numero de telefono
  public searchEditorials(param: string, query: string): Observable<any> {
    return this.http.get(this.apiUrl + '/editorials/search?' + param + '=' + query);
  }
}
