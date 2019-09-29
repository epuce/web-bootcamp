import { Component, OnInit } from '@angular/core';
import { AppActions } from '../app.actions';
import { select } from '@angular-redux/store';

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.css']
})
export class HeaderComponent implements OnInit {
  @select() refreshBtn$
  showRefresh: boolean;
  
  constructor(
    private actions: AppActions
  ) { }

  ngOnInit() {
    this.refreshBtn$.subscribe((value) => {
      this.showRefresh = value;
    })
  }

  refreshList() {
    this.actions.loadList();
  }
}
