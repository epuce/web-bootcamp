## DOM Objects

### window - object describing the browsers state

* location - browser navigation section description
```JavaScript
window.location
```
* localStorage & sessionStorage - place to store browser related data
```JavaScript
// Only first level objects can be stored in localStorage & sessionStorage
window.localStorage.open_time = new Date();

console.log(window.localStorage.open_time) // logs "Thu Aug 19 2019 15:23:49 GMT+0300 (Eastern European Summer Time)" to console
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

<!-- TODO add more detail to window open -->
```JavaScript
// window.open(URL, name, specs, replace)
var myWindow = window.open("https://google.com");

myWindow.resizeTo(500, 300);
myWindow.focus();
myWindow.(100, 100);
myWindow.close();
```
### document - object describing the DOM (HTML)

* write() & writeln()
```JavaScript
// Writes writes the newly stated content
document.write('<p>This is a write document function test</p>');
// writeln adds a newline at the end of written statement
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
```JavaScript
document.getElementById('footer') // Returns a single object
document.getElementsByClassName('font-small') // Returns an array with all elements that have this class
```

* addEventListener()
```JavaScript
// Triggers a function when the element with id "email" is clicked
document.getElementById('email').addEventListener('click', function(){})

// Triggers a function when the element body is active and a keyup event is triggered
document.getElementsByTagName('body')[0].addEventListener('keyup', function() {})
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
document.getElementsByTagName('body')[0].childNodes
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
* load
```JavaScript
// It is called when the DOM is ready which can be prior to images and other external content is loaded
document.addEventListener("load", function(){});
```
* keyup/keydown/keypress
```JavaScript
// Triggers a function on any keyup event when the document is active (in focus)
document.addEventListener("keyup", function(){});
```
* others - [link](https://developer.mozilla.org/en-US/docs/Web/Events)

### Checkup
1. Retrieve the domain name
2. Save and then retrieve some data with localStorage
3. Add some cookies
4. Create a list, loop thru the list elements and add a class to each of the list elements
5. Handle window
   1. Open new window
   2. Change it's size
   3. Write data to it
   4. Add an event listener that triggers window close
6. Create the HTML (css if needed) and add three different event listeners to created HTML