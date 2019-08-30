### TypeSCript
* Angular uses typescript when handling component data manipulations
* If there are actions that are special to a data type and the type is not shown, the code compilator can't generate the code
  
``` JavaScript
export class MyComponent {
  myText: string;
  myNumber: number;
  myArray: [];
  myBool: boolean;
  anyData: any;
  myFunction: void;

  numberArray1: number[];
  // OR
  numberArray2: Array<number>;

  export class User() {
    name: string;
    age: number;
    child_names: string[];
  }

  userEdmunds: User; // We assign the placeholders form User class for userEdmunds 
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

### server requests
``` JavaScript
export class MyComponent implements OnInit {
  list: any;

  constructor(
    private http: HttpClient,
  ) {
  }

  ngOnInit() {
    this.http.get('https://reqres.in/api/users?page=2').toPromise().then(
      (response) => {
        // Do something with the data
        this.list = response
      }
      (rejection) => {
        // Show an error that the request was not successful
      }
    )

    // Alternative for request handling;
    this.getData()
    this.calculateData();
  }

  async getData() {
    const request = new Promise((resolve, reject) => {
      resolve(this.http.get('https://reqres.in/api/users?page=2').toPromise());
    });

    this.list = await request;
  }

  // The power of async
  async calculateData() {
    const number1 = new Promise((resolve, reject) => {
      setTimeout(() => resolve(Math.random() * 100), 1000);
    });

    const number2 = new Promise((resolve, reject) => {
      setTimeout(() => resolve(Math.random() * 100), 3000);
    });

    const number3 = new Promise((resolve, reject) => {
      setTimeout(() => resolve(Math.random() * 100), 6000);
    });

    const awaitValue1 = await number1;
    const awaitValue2 = await number2;
    const awaitValue3 = await number3;

    console.log(awaitValue1, new Date());
    console.log(awaitValue2, new Date());
    console.log(awaitValue3, new Date());

    const sum = Number(awaitValue1) + Number(awaitValue2) + Number(awaitValue3);

    console.log(sum);
  }
}
```
### Checkup
1. Create a component
2. Make a request to a public API that has image links in it
3. Print the images to newly created component