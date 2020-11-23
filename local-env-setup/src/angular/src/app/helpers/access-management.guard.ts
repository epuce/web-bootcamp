import { Router } from '@angular/router';
import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { CanActivate, ActivatedRouteSnapshot, RouterStateSnapshot, UrlTree } from '@angular/router';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class AccessManagementGuard implements CanActivate {
  
  constructor(
    private http: HttpClient,
    private router: Router
  ) {}
  
  async canActivate(
    route: ActivatedRouteSnapshot,
    state: RouterStateSnapshot
  ) {
    
    const hasAccess = await this.http.get('http://localhost:8000/angular/api/users/hasAccess.php')
    .toPromise().then((response: any) => {
      return response.has_access
    });
    
    if (hasAccess) {
      return true;
    } else {
      this.router.navigate(['/login']);
      return false;
    }
  }
  
}
