import { RegisterComponent } from './users/register/register.component';
import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { ToDoListComponent } from './to-do-list/to-do-list.component';
import { LoginComponent } from './users/login/login.component';
import { CanActivateGuard } from './helpers/can-activate.guard';

const routes: Routes = [
  {
    path: '',
    component: LoginComponent,
    canActivate: [CanActivateGuard]
  }, {
    path: 'todo-list',
    component: ToDoListComponent,
    canActivate: [CanActivateGuard]
  }, {
    path: 'register',
    component: RegisterComponent,
    canActivate: [CanActivateGuard]
  }, {
    path: '**',
    redirectTo: ''
  }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
