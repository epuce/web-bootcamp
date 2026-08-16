### TypeSCript
* Angular uses typescript when handling component data manipulations
* If there are actions that are special to a data type and the type is not shown, the code compilator can't generate the code
  
```TypeScript
// Define your own shapes with an interface (or a class)
interface User {
  name: string;
  age: number;
  childNames: string[];
}

export class MyComponent {
  myText: string = '';
  myNumber: number = 0;
  myBool: boolean = false;
  anyData: any;                 // "any" opts out of type checking, avoid it

  numberArray1: number[] = [];
  // OR
  numberArray2: Array<number> = [];

  userEdmunds!: User;           // typed with the interface above
}
```
``` JavaScript
let array; // If the variable has not been set, always add a data type

array = [1, 2, 3, 4];

array.map((num) => {
  return num.length(); // Would return an error, as Angular knows, that numbers don't have length property

  return num**2; // Valid return statement
})
```

### Server requests
`HttpClient` returns an RxJS **Observable**. `.toPromise()` was removed in recent Angular, so convert
with `firstValueFrom()` (or subscribe, or expose it as a signal with `toSignal`).
```TypeScript
import { Component, inject, OnInit } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { firstValueFrom } from 'rxjs';

interface User { id: number; name: string; email: string; }

export class MyComponent implements OnInit {
  private http = inject(HttpClient);   // modern DI, no constructor boilerplate
  list: User[] = [];

  async ngOnInit() {
    try {
      const res = await firstValueFrom(
        this.http.get<User[]>('https://jsonplaceholder.typicode.com/users'),
      );
      this.list = res;
    } catch {
      // show an error that the request was not successful
    }

    await this.calculateData();
  }

  // The power of async: run independent work concurrently with Promise.all
  async calculateData() {
    const delay = (ms: number) =>
      new Promise<number>((resolve) => setTimeout(() => resolve(Math.random() * 100), ms));

    // ~6s total, not 1+3+6=10s, because they run at the same time
    const [a, b, c] = await Promise.all([delay(1000), delay(3000), delay(6000)]);
    console.log(a + b + c);
  }
}
```
### Checkup
1. Create a component
2. Make a request to a public API that has image links in it
3. Print the images to newly created component