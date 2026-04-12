import { Injectable } from '@angular/core';
import { environment } from '../../environments/environment.development';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root',
})
export class InventoryService {
  private apiUrl = `${environment.apiUrl}`;

  constructor(private http: HttpClient) {

  }
  // Obtener la lista de inventarios desde el backend
  public getInventory(): Observable<any> {
    return this.http.get(this.apiUrl + '/inventories');
  }

  // Obtener un inventario específico por su ID
  public getInventoryById(id: number): Observable<any> {
    return this.http.get(this.apiUrl + '/inventories/' + id);
  }

  // Actualizar un inventario específico por su ID
  public updateInventory(id: number, inventoryData: any): Observable<any> {
    return this.http.put(this.apiUrl + '/inventories/' + id, inventoryData);
  }
  // Crear un nuevo inventario
  public createInventory(inventoryData: any): Observable<any> {
    return this.http.post(this.apiUrl + '/inventories', inventoryData);
  }
  // Eliminar un inventario específico por su ID
  public deleteInventory(id: number): Observable<any> {
    return this.http.delete(this.apiUrl + '/inventories/' + id);
  }
  // Busqueda avanzada de inventarios por ubicación, id de libreria, isbn del libro, etc.
  public searchInventories(param: string, query: string): Observable<any> {
    return this.http.get(this.apiUrl + '/inventories/search?' + param + '=' + query);
  }
}
