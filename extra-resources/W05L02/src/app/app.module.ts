import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppComponent } from './app.component';
import { HeaderComponent } from './header/header.component';
import { IndexComponent } from './index/index.component';
import { LoginComponent } from './login/login.component';
import { AppRoutingModule } from 'src/app/app-routing.module';
import { AccessControlService } from './access-control.service';
import { StoreModuleNgRedux } from './app-store.module';
import { AppActions } from './app.actions';
import { HttpClientModule } from '@angular/common/http';

@NgModule({
  declarations: [
    AppComponent,
    HeaderComponent,
    IndexComponent,
    LoginComponent,
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    StoreModuleNgRedux,
    HttpClientModule
  ],
  providers: [
    AccessControlService,
    AppActions
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
