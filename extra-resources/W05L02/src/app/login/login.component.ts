import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl, Validators } from '@angular/forms';

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

  constructor() { }

  ngOnInit() {
    this.form = new FormGroup(this.controls);

    this.form.valueChanges.subscribe((values) => {
        console.log("The new values are")
        console.log(values)
    })
  }

  onClick() {
    console.log(this.form)
    localStorage.loggedIn = localStorage.loggedIn !== "true";
  }
}
