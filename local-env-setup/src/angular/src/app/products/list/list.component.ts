import { HttpClient } from '@angular/common/http';
import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-list',
  templateUrl: './list.component.html',
  styleUrls: ['./list.component.css']
})
export class ProductsListComponent implements OnInit {
  list: any[] = [];
  product: Product = new Product({});

  constructor(
    private http: HttpClient
  ) {

  }

  ngOnInit() {
    this.http
    .get('http://localhost:8000/angular/api/products/list.php')
    .toPromise()
    .then(
      (response: any) => {
        this.list = response;
      },
      (reject) => {
        alert(reject)
      }
    )
  }

  deleteProduct(id: string) {
    const payload = new FormData();
    payload.append('id', id);

    this.http.post(this.getApiUrl("delete.php"), payload)
    .toPromise()
    .then(
      (response) => {
        this.list = this.list.filter((product: any) => product.id !== id);
      },
      (reject) => {
        alert(JSON.stringify(reject));
      }
    )
  }

  startEditProduct(id: string) {
    console.log(typeof id);
    this.http.get(this.getApiUrl("get.php?id=" + id))
    .toPromise()
    .then(
      (response: any) => {
        this.product = new Product(response);
      },
      (reject) => {
        alert(JSON.stringify(reject));
      }
    )
  }

  editProduct() {
    const payload = new FormData();

    payload.append('name', this.product.name)
    payload.append('price', "" + this.product.price)
    if (this.product.id) {
      payload.append('id', "" + this.product.id)
      this.http.post(this.getApiUrl('edit.php'), payload).toPromise()
      .then(
        (response) => {
          const index = this.list.findIndex((product) => product.id === this.product.id);

          console.log(index);

          this.list[index] = this.product;
          this.product = new Product({}); 
        },
        (reject) => {

        }   
      )
      // update
    } else {
      // create
      this.http.post(this.getApiUrl('add.php'), payload).toPromise()
      .then(
        (response: any) => {
          this.product.id = response.id;

          this.list.push(this.product);
          this.product = new Product({}); 
        },
        (reject) => {

        }   
      )
    }
  }

  getApiUrl(endPoint: string) {
    return "http://localhost:8000/angular/api/products/" + endPoint;
  }
}


class Product {
  price: Number;
  name: string;
  id: string;

  constructor(data: any) {
    this.price = Number(data.price);
    this.name = data.name;
    this.id = data.id;
  }
}
