import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent implements OnInit {

  ngOnInit() {
    // this.calculateData();
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

    // const awaitValue1 = await number1;
    // const awaitValue2 = await number2;
    // const awaitValue3 = await number3;

    console.log(await number1, new Date());
    console.log(await number2, new Date());
    console.log(await number3, new Date());

    const sum = Number(await number1) + Number(await number2) + Number(await number3);

    console.log(sum, new Date());
  }
}
