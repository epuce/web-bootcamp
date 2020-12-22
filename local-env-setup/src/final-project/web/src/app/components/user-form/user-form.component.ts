import { Router } from '@angular/router';
import { HttpClient } from '@angular/common/http';
import { Component, OnInit, Input } from '@angular/core';

@Component({
  selector: 'app-user-form',
  templateUrl: './user-form.component.html',
  styleUrls: ['./user-form.component.css']
})
export class UserFormComponent implements OnInit {
  @Input() data: any;
  user: any;
  buttonTitle: string;
  saveForm: any;

  constructor(
    private http: HttpClient,
    private router: Router
  ) {

  }

  ngOnInit() {
    this.user = this.data.user;
    this.buttonTitle = this.data.buttonTitle;
    this.saveForm = this.data.saveForm;
  }

}
