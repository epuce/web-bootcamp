import { Component, OnInit } from '@angular/core';
import { select } from '@angular-redux/store';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent implements OnInit {
  hasAccess: boolean;
  @select() access$;

  ngOnInit() {
    this.access$.subscribe((value) => {
      this.hasAccess = value;
    })
  }
}
