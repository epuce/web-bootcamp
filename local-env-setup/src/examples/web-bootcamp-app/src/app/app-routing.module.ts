import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { IndexComponent } from './index/index.component';
import { ListComponent } from './list/list.component';
import { AccessControlService } from './access-control.service';

const routes: Routes = [{
  path: 'index',
  component: IndexComponent
}, {
  path: 'list',
  component: ListComponent,
  canActivate: [AccessControlService]
}];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
