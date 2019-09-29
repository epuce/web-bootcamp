import { Component, OnInit, OnDestroy } from '@angular/core';
import { select } from '@angular-redux/store';
import { AppActions } from '../app.actions';

@Component({
  selector: 'app-index',
  templateUrl: './index.component.html',
  styleUrls: ['./index.component.css']
})
export class IndexComponent implements OnInit, OnDestroy {
  @select() list$;
  columnDef: string[] = [
    'name',
    'currencies',
    'flag',
    'actions'
  ]

  constructor(
    private actions: AppActions,
  ) { }

  ngOnInit() {
    this.actions.loadList();
    this.actions.showRefreshBtn();
  }

  copyRow(index) {
    this.actions.copyRow(index)
  }

  deleteRow(index) {
    this.actions.deleteRow(index)
  }

  ngOnDestroy() {
    this.actions.hideRefreshBtn()
  }
}
