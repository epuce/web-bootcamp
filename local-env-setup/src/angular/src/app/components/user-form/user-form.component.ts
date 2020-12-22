import { Router } from '@angular/router';
import { HttpClient } from '@angular/common/http';
import { Component, Input, OnInit } from '@angular/core';

@Component({
  selector: 'app-user-form',
  templateUrl: './user-form.component.html',
  styleUrls: ['./user-form.component.css']
})
export class UserFormComponent implements OnInit {
  @Input() data: any = {
    buttonTitle: '',
  };
  
  user = {
    username: '',
    password: '',
  }

  saveForm = (user: any) => {}
  constructor(
    private http: HttpClient,
    private router: Router
  ) { }

  ngOnInit(): void {
    this.saveForm = this.data.saveForm;
    console.log(this);
  }

}
