import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl, Validators } from '@angular/forms';
import { HttpClient } from '@angular/common/http';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {
  form: FormGroup;
  controls: any = {
      name: new FormControl('', [Validators.required]),
      active: new FormControl(''),
  };

  constructor(
    private http: HttpClient
  ) { }

  ngOnInit() {
    this.form = new FormGroup(this.controls);

    this.form.valueChanges.subscribe((values) => {
        console.log("The new values are")
        console.log(values)
    })
  }

  onClick() {
    localStorage.loggedIn = localStorage.loggedIn !== "true";

    this.http.get('/api/get.php').toPromise().then((response) => {

    })
  }
}
