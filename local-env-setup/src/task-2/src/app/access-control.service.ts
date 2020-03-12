import { CanActivate, Router } from "@angular/router";
import { Injectable } from "@angular/core";

@Injectable({
    providedIn: 'root',
})

export class AccessControlService implements CanActivate {
    constructor(
        private router: Router
    ) {
    }
    
    canActivate() {
        if (localStorage.hasAccess) {
            return true;
        }

        this.router.navigate(['login']);
    }
}