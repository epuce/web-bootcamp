import { Router } from '@angular/router';
import { HttpClient } from '@angular/common/http';
import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {
  loginFormData: any = {
    buttonTitle: "Login",
  }

  constructor(
    private http: HttpClient,
    private router: Router
  ) { }

  ngOnInit(): void {
    console.log("init Login")
    this.loginFormData.saveForm = this.login;
  }

  login() {
    console.log(this);

    this.http.post('http://localhost:8000/angular/api/users/login.php', {}).toPromise()
    .then((response: any) => {
      if (response.has_access) {
        this.router.navigate([""])
      } else {
        alert('No access');
      }
    })
    console.log("trigger login")
  }
}
