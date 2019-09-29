import {NgModule} from '@angular/core';
import {RouterModule, Routes} from '@angular/router';
import { LoginComponent } from 'src/app/login/login.component';
import { IndexComponent } from 'src/app/index/index.component';
import { AccessControlService } from 'src/app/access-control.service';

const routes: Routes = [
    {
        path: 'login',
        component: LoginComponent,
    }, {
        path: '',
        component: IndexComponent,
        canActivate: [AccessControlService]
    },  {
        path: '**',
        redirectTo: 'login',
    }
];

@NgModule({
    imports: [RouterModule.forRoot(routes)],
    exports: [RouterModule]
})
export class AppRoutingModule {
}
