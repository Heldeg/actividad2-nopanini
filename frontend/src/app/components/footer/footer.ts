import { Component } from '@angular/core';

@Component({
  selector: 'app-footer',
  standalone: true,
  imports: [],
  templateUrl: './footer.html',
  styleUrl: './footer.css',
})
export class Footer {
  protected readonly siteLinks = ['Inicio', 'Catalogo', 'Novedades', 'Ofertas'];
  protected readonly supportLinks = ['Ayuda', 'Envios', 'Devoluciones', 'Terminos'];
}
