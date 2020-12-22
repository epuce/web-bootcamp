import { FormControl } from '@angular/forms';
import { Router } from '@angular/router';
import { HttpClient } from '@angular/common/http';
import { Component, OnInit } from '@angular/core';
import { HelpersService } from 'src/app/helpers/helpers.service';

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.css']
})
export class RegisterComponent implements OnInit {
  data = {
    buttonTitle: "Register",
    user: {
      username: "",
      password: ""
    },
    saveForm: null,
  }

  controls: any = {
    username: new FormControl(),
    password: new FormControl()
  }

  constructor(
    private http: HttpClient,
    private router: Router
  ) { 
  }

  ngOnInit() {
    this.data.saveForm = this.saveUser;
  }

  saveUser() {
    this.http.post(HelpersService.getApiBaseHref() + '/users/save.php', this.data.user).toPromise()
    .then(
      () => {
        this.router.navigate(['/']);
      }, 
      (reject: any) => {
        console.log(reject)
      }
    );
  }
}
