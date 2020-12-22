import { Router } from '@angular/router';
import { HttpClient } from '@angular/common/http';
import { Component, OnInit } from '@angular/core';
import { HelpersService } from 'src/app/helpers/helpers.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {
  data = {
    buttonTitle: "Log in",
    user: {
      username: "",
      password: ""
    },
    saveForm: null,
  }

  

  constructor(
    private http: HttpClient,
    private router: Router
  ) { }

  ngOnInit() {
    this.data.saveForm = this.saveForm;
  }

  saveForm() {
    const payload = new FormData();
    payload.append('username', this.data.user.username);
    payload.append('password', this.data.user.password);

    console.log(payload);
    
    this.http.post(HelpersService.getApiBaseHref() + '/users/login.php', payload).toPromise()
    .then(
      (response: any) => {
        console.log(response);
        if (response.valid_login) {
          this.router.navigate(['/todo-list']);          
        }
      }, 
      (reject: any) => {
        console.log(reject)
      }
    );
  }
}
