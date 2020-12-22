import { Router } from '@angular/router';
import { Component, OnInit } from '@angular/core';
import {HttpClient} from '@angular/common/http';
import {FormControl} from '@angular/forms';
import {CdkDragDrop, moveItemInArray} from '@angular/cdk/drag-drop';
import { AppComponent } from '../app.component';
import { HelpersService } from '../helpers/helpers.service';

@Component({
  selector: 'app-to-do-list',
  templateUrl: './to-do-list.component.html',
  styleUrls: ['./to-do-list.component.css']
})
export class ToDoListComponent implements OnInit {
  list = {
    check: [],
    noCheck: []
  };
  username: string;
  model: any = {};
  checkControl = new FormControl();

  constructor(
    private http: HttpClient,
    private router: Router
  ) { }

  ngOnInit() {
    this.http.get(HelpersService.getApiBaseHref() + '/get-all.php').toPromise()
    .then(
      (response: any) => {
        console.log(response)

        this.list.check = response.filter((row: any) => Number(row.checked));
        this.list.noCheck = response.filter((row: any) => !Number(row.checked));

        console.log(this.list)
      }, 
      (reject) => {
        console.log(reject)
      }
    );

    this.checkControl.valueChanges.subscribe((value) => {
      console.log(value);
    })

    this.http.get(HelpersService.getApiBaseHref() + '/users/getActiveUser.php').toPromise()
    .then((response: any) => {
      this.username = response.user && response.user.username;
    })
  }

  logOut() {
    this.http.get(HelpersService.getApiBaseHref() + "/users/logOut.php").toPromise().then(() => {
      this.router.navigate(["/"]);
    })
  }

  save() {
    const order_id = this.list.noCheck.length ? Math.max(...[...this.list.noCheck].map((val) =>  Number(val.order_id))) : 1;
    this.http.post(HelpersService.getApiBaseHref() + `/${ this.model.id ? 'put' : 'post'}.php`, {
      ...this.model,
      order_id: order_id,
    }).toPromise().then(
      (response) => {
        const content = response[0];
        const index = this.list.noCheck.findIndex((row) => row.id === content.id);

        if (index === -1) {
          this.list.noCheck.unshift(content);
        } else {
          this.list.noCheck[index] = content;
        }

        this.model = {};
      },
      (rejection) => {
        alert('There was an error saving the data!');
      });
  }

  edit(id) {
    this.http.get(HelpersService.getApiBaseHref() + `/get.php?id=${id}`).toPromise().then((response) => {
      this.model = response[0];
    });
  }

  delete(item) {
    if (!Number(item.checked)) {
      this.list.noCheck = this.list.noCheck.filter((row) => row.id !== item.id);
    } else {
      this.list.check = this.list.check.filter((row) => row.id !== item.id);
    }

    this.http.delete(HelpersService.getApiBaseHref() + `/delete.php?id=${item.id}`).toPromise()
  }

  onCheck(item) {
    if (!Number(item.checked)) {
      this.list.check.unshift({
        ...item,
        checked: 1
      });
      this.list.noCheck = this.list.noCheck.filter((row) => row.id !== item.id);
    } else {
      this.list.noCheck.unshift({
        ...item,
        checked: 0
      });
      this.list.check = this.list.check.filter((row) => row.id !== item.id);
    }

    this.http.post(HelpersService.getApiBaseHref() + '/put.php', {
      ...item,
      checked: !Number(item.checked),
      order_id: Math.max(...this.list.noCheck.map((row) => Number(row.order_id))) + 1
    }).toPromise().then(
      (response) => {},
      (rejection) => {
        // TODO reset to prev state
      }
    );
  }

  updateOrder(event: CdkDragDrop<string[]>) {
    moveItemInArray(this.list.noCheck, event.previousIndex, event.currentIndex);
    let count = this.list.noCheck.length;

    this.list.noCheck.forEach((val, index) => {
      this.list.noCheck[index].order_id = count;

      count --;
    });

    this.http.put(HelpersService.getApiBaseHref() + '/update-list-order.php', this.list.noCheck).toPromise().then((response) => {
      console.log(response);
    });
  }
}
