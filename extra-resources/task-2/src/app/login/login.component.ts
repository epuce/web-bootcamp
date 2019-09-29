import { Component, OnInit } from '@angular/core';
import { FormControl } from '@angular/forms';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {
  control: FormControl = new FormControl(false);

  constructor(
  ) { }

  ngOnInit() {
    this.control.valueChanges.subscribe((value) => {
      if (value) {
        localStorage.hasAccess = value;
      } else {
        delete localStorage.hasAccess;
      }
    })

    if (localStorage.hasAccess) {
      this.control.setValue(true);
    }
  }
}
