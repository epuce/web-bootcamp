import { Routes } from '@angular/router';
import { LoginComponent } from './login/login.component';
import { IndexComponent } from './index/index.component';
import { accessGuard } from './guards/access.guard';

export const routes: Routes = [
  {
    path: '',
    pathMatch: 'full',
    component: IndexComponent,
    // canMatch runs before the route is matched; a returned UrlTree redirects.
    canMatch: [accessGuard]
  },
  {
    path: 'login',
    component: LoginComponent
  },
  // Anything else falls back to the (guarded) index.
  { path: '**', redirectTo: '' }
];
