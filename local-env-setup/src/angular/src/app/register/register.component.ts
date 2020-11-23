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
  
  constructor() { }

  ngOnInit(): void {
    console.log("init Register")
    this.registerFormData.saveForm = this.register;
  }

  register() {
    console.log("trigger register");
  }
}
