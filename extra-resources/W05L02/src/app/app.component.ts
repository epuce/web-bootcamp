import { Component, OnInit } from '@angular/core';
import { AppActions } from './app.actions';
import { select } from '@angular-redux/store';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent implements OnInit {
  constructor(
  ){}

  ngOnInit() {
    this.calculateData();
  }

  async calculateData() {
    const number1 = new Promise((resolve, reject) => {
      setTimeout(() => resolve(Math.random() * 100), 10000);
    });

    const number2 = new Promise((resolve, reject) => {
      setTimeout(() => resolve(Math.random() * 100), 15000);
    });

    const number3 = new Promise((resolve, reject) => {
      setTimeout(() => resolve(Math.random() * 100), 2500);
    });

    console.log(await number1, new Date());
    console.log(await number2, new Date());
    console.log(await number3, new Date());

    const sum = Number(await number1) + Number(await number2) + Number(await number3);

    console.log(sum, new Date());
  }
}
