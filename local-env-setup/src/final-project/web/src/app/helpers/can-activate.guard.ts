import { Router } from '@angular/router';
import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { CanActivate, ActivatedRouteSnapshot, RouterStateSnapshot, UrlTree } from '@angular/router';
import { HelpersService } from "./helpers.service";

@Injectable({
  providedIn: 'root'
})
export class CanActivateGuard implements CanActivate {
  constructor(
    private http: HttpClient,
    private router: Router,
  ) {

  }

  async canActivate(
    next: ActivatedRouteSnapshot,
    state: RouterStateSnapshot
  ) {
    const canActivate = await this.http.post(HelpersService.getApiBaseHref() + "/users/getActiveUser.php", {}).toPromise()
      .then((response: any) => {
        return response && response.is_session_active;
      });

    if (canActivate) {
      if (['/register', '/'].includes(state.url)) {
        this.router.navigate(["/todo-list"]);
      } else {
        return true;
      }
    } else {
      if (['/register', '/'].includes(state.url)) {
        return true;
      } else {
        this.router.navigate(["/"]);
      }
    }
  }
}
