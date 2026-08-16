import { inject } from '@angular/core';
import { CanMatchFn, Router, UrlTree } from '@angular/router';

/**
 * Functional route guard (Angular 15+ style — no class, no @Injectable).
 * Runs as a `canMatch` guard: the route only matches when the visitor is
 * "logged in". Otherwise it returns a UrlTree, which the router treats as a
 * redirect to the login page.
 */
export const accessGuard: CanMatchFn = (): boolean | UrlTree => {
  const router = inject(Router);
  const loggedIn = localStorage.getItem('loggedIn') === 'true';

  return loggedIn ? true : router.createUrlTree(['/login']);
};
