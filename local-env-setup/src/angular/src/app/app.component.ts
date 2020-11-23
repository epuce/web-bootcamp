import { Router } from '@angular/router';
import { HttpClient } from '@angular/common/http';
import { Component } from '@angular/core';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {

  constructor(
    private http: HttpClient,
    private router: Router
  ) {

  }

  logOut() {
    this.http.get('http://localhost:8000/angular/api/users/logOut.php').toPromise()
    .then(() => {
      this.router.navigate(['/login']);
    })
  }
}
