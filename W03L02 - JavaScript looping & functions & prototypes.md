### JavaScript Loops

* **for** loop
```JavaScript
// define the starting value
// set the condition for executing the loop
// set the step for the variable to be modified with
for (let i = 0; i < 3; i++) {
    console.log('Hello Nr' + i)
}
// This will console log:
// 'Hello Nr0'
// 'Hello Nr1'
// 'Hello Nr2'
```

* **while** loop
  
```JavaScript
// define the starting value outside the loop
// set the condition for executing the loop
// inside the loop function modify the starting value variable
let i = 3;
while (i > 0) {
    console.log('Hello Nr' + i)
    i--
}
// This will console log:
// 'Hello Nr3'
// 'Hello Nr2'
// 'Hello Nr1'
```

* **forEach** loop - can be applied only for arrays

```JavaScript
const array = [true, true, false, true];

array.forEach(function(value, index) {
    if (value) {
        console.log('The value at index ' +index+ ' is true')
    } else {
        console.log('The value at index ' +index+ ' is false')
    }
});

// This will console log:
// The value at index 0 is true
// The value at index 1 is true
// The value at index 2 is false
// The value at index 3 is true
```

* **map** loop - can be applied only for arrays (modifies it self)
```JavaScript
const array = [1, 2, 3, 4];

const sqrtArray = array.map(function(value) {
    return value**2 // modifies the number to the power of two
});

console.log(sqrtArray)
// This will console log:
// [1, 4, 9, 16]
```
* Other useful array/object iteration (all on MDN)
  * [for...of](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Statements/for...of) - the modern way to loop the values of an array
  * [for...in](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Statements/for...in) - loop the keys of an object
  * [reduce](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/reduce) - fold an array into a single value
  * [filter](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/filter) - keep only the items that match
  * [find](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/find) / [findIndex](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/findIndex) - first match / its index
  * [some](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/some) / [every](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/every) - test if any / all match

### JavaScript functions
* Anonymous - no name to refer to
```JavaScript
// The function that is executed is an anonymous one
document.body.addEventListener('click', function() {
    console.log('you just did a click')
})
```
* Declared - there is a name to refer to
```JavaScript
// The function that is executed on the click and does not matter where in the fil it has been declared
function onClick() {
    console.log('you just did a click')
}

document.body.addEventListener('click', onClick)
```
* Declared and assigned to a variable - only introduced to the scope when declared

```JavaScript
// With const/let this THROWS a ReferenceError: onClick is used before it is declared (the "temporal dead zone")
document.body.addEventListener('click', onClick);

const onClick = function() {
    console.log('you just did a click');
};

// From here on it works, the listener below can see the function
document.body.addEventListener('click', onClick);
```

* ES6 arrow functions (same, but different, but still the same)
```JavaScript
let customFn = () => {
    // Do something
}
```

#### Function parameters
* We can pass parameters to function to change the conditions how to execute the function
  
```JavaScript
function sayHelloTo(name) {
    alert('Hello ' + name)
}

sayHelloTo('Edmunds');
// This will show an alert window with text:
// Hello Edmunds

// Passing multiple parameters
function witchNumberIsBigger(a, b) {
    if (a > b) {
        console.log('First passed number is bigger')
    } else {
        console.log('Second passed number is bigger')
    }
}

// WHAT HAPPENS IF WE PASS TWO EQUAL NUMBERS?

// If you don't know how many parameters you'll need
const monthlyBill = function(amount, ...theRest) {
    let totalBill = amount;

    theRest.forEach((value) => {
        totalBill += value;
    })

    return totalBill;
}
monthlyBill(10.50, 3.70, 20) // Return 34.2
monthlyBill(10.50, 3.70, 20, 7.5, 23.55) // Return 65.25

// Reading parameters from object
let myData = (params) => {
    const {name, surname, isActive} = params;

    console.log(name)
    console.log(surname)
    console.log(isActive)
}

myData({name: 'Ed', surname: 'Pūce', isActive:true});
// This will console log:
// Ed
// Pūce
// true
```

### JavaScript classes (and prototypes)

Every JS value has a **prototype**, a shared object it inherits properties and methods from. The
built-in types each have one:

* Built in
  * Object
  * Array
  * Function
  * Number
  * Date

Since ES6 you define your own types with the **`class`** keyword, cleaner syntax over that same
prototype mechanism. This is the modern way (the old `function User() { this.x = ... }` constructor
style still works, but you will rarely write it).

```JavaScript
class User {
    constructor(username, email, password) {
        this.username = username;
        this.email = email;
        this.password = password;
    }

    getPassword() {
        console.log(this.password);
    }
}

const userNr1 = new User("Ed", "edm.puce@gmail.com", "qwerty");
userNr1.getPassword(); // logs: qwerty

// `extends` inherits everything from User; `super(...)` calls its constructor
class Admin extends User {
    constructor(username, email, password) {
        super(username, email, password);
        this.isAdmin = true;
    }

    notifyAdmin() {
        console.log(`Hey ${this.username}, you have admin rights`);
    }
}

const boss = new Admin("Alex", "alex@example.com", "secret");
boss.notifyAdmin(); // Hey Alex, you have admin rights
boss.getPassword(); // inherited from User
```

### Checkup
1. create a loop that prints every second number starting from 10 and ending with 20
2. loop thru an array and print out it's content
3. modify array of numbers by multiplying the numbers by itself
4. Declare a function that can be called even if it's defined after it is called
5. define a function that can be called only after it has been declared
6. create an arrow function with two or more parameters
7. create a function with unknown amount of parameters
8. create a function that accepts object as an parameters and reads assigns it's key/value pairs to function variables
9. Use two of built in prototype functions
10. Create your own prototype
    1. create new instance
    2. call a function from it 