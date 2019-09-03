import { Component, OnInit } from '@angular/core';
import { select } from '@angular-redux/store';
import { AppActions } from '../app.actions';

@Component({
  selector: 'app-index',
  templateUrl: './index.component.html',
  styleUrls: ['./index.component.css']
})
export class IndexComponent implements OnInit {
  @select() request$;

  response: any;

  constructor(
    private appActions: AppActions
  ){}

  ngOnInit() {
    this.appActions.request()

    this.request$.subscribe((response) => {
      this.response = response;
    })
  }
}
