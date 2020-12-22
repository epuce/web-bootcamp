import { Router } from '@angular/router';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.css']
})
export class RegisterComponent implements OnInit {
  registerFormData: any = {
    buttonTitle: "Register",
  }
  
  constructor(
    private http: HttpClient,
    private router: Router
  ) { }

  ngOnInit(): void {
    this.registerFormData.saveForm = this.register;
  }

  register(user: any) {
    this.http.post('http://localhost:8002/users/add', user).toPromise()
    .then((response: any) => {
      if (response.user_saved) {
        this.router.navigate(['/login']);
      } else {
        alert("Something went wrong")
      }
    })
  }
}
