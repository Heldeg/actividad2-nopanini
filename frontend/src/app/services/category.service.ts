import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { environment } from '../../environments/environment.development';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root',
})
export class CategoryService {
  private apiUrl = `${environment.apiUrl}`;

  constructor(private http: HttpClient) {

  }

  // Obtener la lista de categorías desde el backend
  public getCategories(): Observable<any> {
    return this.http.get(this.apiUrl + '/categories');
  }

  // Obtener una categoría específica por su ID
  public getCategoryById(id: number): Observable<any> {
    return this.http.get(this.apiUrl + '/categories/' + id);
  }

  // Actualizar una categoría específica por su ID
  public updateCategory(id: number, categoryData: any): Observable<any> {
    return this.http.put(this.apiUrl + '/categories/' + id, categoryData);
  }

  // Crear una nueva categoría
  public createCategory(categoryData: any): Observable<any> {
    return this.http.post(this.apiUrl + '/categories', categoryData);
  }

  // Eliminar una categoría específica por su ID
  public deleteCategory(id: number): Observable<any> {
    return this.http.delete(this.apiUrl + '/categories/' + id);
  }

  // Busqueda avanzada de categorías por nombre, categoria del padre, etc.
  public searchCategories(param: string, query: string): Observable<any> {
    return this.http.get(this.apiUrl + '/categories/search?' + param + '=' + query);
  }
}
