import { Injectable } from '@angular/core';
import { environment } from '../../environments/environment.development';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root',
})
export class OrderService {
  private apiUrl = `${environment.apiUrl}`;

  constructor(private http: HttpClient) {

  }
  // Obtener la lista de pedidos desde el backend
  public getOrders(): Observable<any> {
    return this.http.get(this.apiUrl + '/orders');
  }

  // Obtener un pedido específico por su ID
  public getOrderById(id: number): Observable<any> {
    return this.http.get(this.apiUrl + '/orders/' + id);
  }
  // Actualizar un pedido específico por su ID
  public updateOrder(id: number, orderData: any): Observable<any> {
    return this.http.put(this.apiUrl + '/orders/' + id, orderData);
  }
  // Crear un nuevo pedido
  public createOrder(orderData: any): Observable<any> {
    return this.http.post(this.apiUrl + '/orders', orderData);
  }
  // Eliminar un pedido específico por su ID
  public deleteOrder(id: number): Observable<any> {
    return this.http.delete(this.apiUrl + '/orders/' + id);
  }
}
