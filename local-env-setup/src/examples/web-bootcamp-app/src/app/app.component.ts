import { Component, OnInit, ViewChild } from '@angular/core';
import { Sport } from '../models/sports.model';
import { User } from '../models/users.model';
import { HttpClient } from '@angular/common/http';
import { FormControl, Validators, FormGroup } from '@angular/forms';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})

export class AppComponent implements OnInit {
  @ViewChild('mainPopup') grandPopape;
  title = 'web-bootcamp-app';
  name = "Ed";
  show = false;
  btn_class_green = false;
  sports: Sport[] = [{
    id: 1,
    name: "hockey",
    test: 1
  }, {
    id: 2,
    name: "tennis"
  }, {
    id: 3,
    name: "basketball"
  }].map(row => new Sport(row))


  user = {
    name: ''
  };

  form: FormGroup;
  controls = {
    name: new FormControl('', [Validators.required]),
  }

  constructor (
    private http: HttpClient
  ) {

  }
  ngOnInit() {
    this.form = new FormGroup(this.controls);

    this.form.valueChanges.subscribe((values) => {
        console.log("The new values are")
        console.log(values)
    })

    setTimeout(() => {
      this.name = "Jon";
    }, 10000);

    setInterval(() => {
      this.show = !this.show;
    }, 3000)
  }

  toggleClass() {
    this.btn_class_green = !this.btn_class_green;
  }

  users: User[];
  hasUserData = false;
  getData() {
    if (!this.hasUserData) {
      this.http.get('https://reqres.in/api/users').toPromise()
      .then(
        (response: any) => {
          console.log(response.data)
          this.users = response.data.map(row => new User(row));
          console.log(this.users);
        },
        (rejection) => {}
      )
      this.hasUserData = true;
    }
  }

  openPopup() {
    this.grandPopape.showPopup = true;
  }

  toggleListAccess() {
    localStorage.canAccessList = localStorage.canAccessList === 'true' ? false : true;
  }
}
 