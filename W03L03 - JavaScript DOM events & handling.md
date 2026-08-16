# 🖱️ JavaScript DOM events & handling

## DOM Objects

### window - object describing the browsers state

* location - browser navigation section description

```JavaScript
window.location
```

* localStorage & sessionStorage - key/value store in the browser (localStorage persists; sessionStorage clears when the tab closes)

```JavaScript
// Values are always strings, so use setItem / getItem
localStorage.setItem('openTime', new Date().toISOString());
console.log(localStorage.getItem('openTime'));

// For arrays and objects, serialise with JSON
const user = { name: 'Ed', roles: ['admin', 'editor'] };
localStorage.setItem('user', JSON.stringify(user));

const saved = JSON.parse(localStorage.getItem('user'));
console.log(saved.roles[0]); // 'admin'

localStorage.removeItem('user'); // delete one key
```

* innerHeight/innerWidth - reads the window dimensions

```JavaScript
window.innerHeight
window.innerWidth
```

* actions
  * open()
  * close()
  * moveTo()
  * resizeTo()
  * focus()
  * other - [link](https://www.w3schools.com/jsref/obj_window.asp)

```JavaScript
// window.open(URL, name, specs)
const myWindow = window.open("https://google.com");

myWindow.resizeTo(500, 300);
myWindow.moveTo(100, 100);
myWindow.focus();
myWindow.close();
```

### document - object describing the DOM (HTML)

* write() & writeln() - avoid in modern code; called after load it wipes the whole page. Build nodes instead (querySelector + createElement / textContent, below).

```JavaScript
document.write('<p>This is a write document function test</p>'); // legacy, do not use
```

* cookie

```JavaScript
document.cookie = "test_cookie = Wooho it works"
// There are some issues regarding the way cookies ar retrieved
```

* activeElement

```JavaScript
document.activeElement // Returns currently active element
```

* classList - prints all the classes that are attached to the element
  * classList.add() - add a class to element
  * classList.remove() - remove the class from element
  * classList.toggle() - remove if the class is set, add if not

* element getter functions
  * getElementById()
  * getElementsByClassName()
  * getElementsByName()
  * getElementsByTagName()
  * **querySelector() / querySelectorAll()** - the modern, preferred way: they take any CSS selector

```JavaScript
document.getElementById('footer') // Returns a single element

// Prefer querySelector / querySelectorAll - one API, any CSS selector
document.querySelector('#footer')          // first match (or null)
document.querySelectorAll('.font-small')   // a NodeList of all matches, loop it with forEach
```

* addEventListener()

```JavaScript
// Triggers a function when the element with id "email" is clicked
document.getElementById('email').addEventListener('click', function(){})

// Triggers a function when the element body is active and a keyup event is triggered
document.body.addEventListener('keyup', function() {})
```

* others - [link](https://www.w3schools.com/js/js_htmldom_document.asp)

## Selectors

* firstChild & lastChild

```JavaScript
// Takes the first element from nested items
document.getElementsByTagName('ul')[0].firstChild
```

* childNodes

```JavaScript
// Selects all body child elements
document.body.childNodes
```

* nextSibling

```JavaScript
// Selects the next li element (in this case with index 1)
document.getElementsByTagName('li')[0].nextSibling
```

* previousSibling

```JavaScript
// Selects the previous li element (in this case with index 2)
document.getElementsByTagName('li')[3].previousSibling
```

## Events / Listeners

* click

```JavaScript
// Trigger a function when the element is clicked
document.getElementsByTagName('button')[0].addEventListener('click', function() {})
```

* scroll

```JavaScript
// Trigger a function when the element is scrolled
document.getElementById('scroll-wrapper').addEventListener('scroll', function() {})
```

* resize

```JavaScript
// Trigger a function when the window is resized
window.addEventListener("resize", function(){});
```

* load / DOMContentLoaded

```JavaScript
// DOMContentLoaded fires as soon as the HTML is parsed (before images finish) - usually what you want
document.addEventListener("DOMContentLoaded", function(){});

// load fires once everything (images, styles) is done, and it lives on window
window.addEventListener("load", function(){});
```

* keyup/keydown/keypress

```JavaScript
// Triggers a function on any keyup event when the document is active (in focus)
document.addEventListener("keyup", function(){});
```

* others - [link](https://developer.mozilla.org/en-US/docs/Web/Events)

> [!TIP]
> **Checkup**
>
> 1. Retrieve the domain name
> 2. Save and then retrieve some data with localStorage
> 3. Add some cookies
> 4. Create a list, loop thru the list elements and add a class to each of the list elements
> 5. Handle window
>    1. Open new window
>    2. Change it's size
>    3. Write data to it
>    4. Add an event listener that triggers window close
> 6. Create the HTML (css if needed) and add three different event listeners to created HTML
