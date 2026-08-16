## jQuery - JavaScript library

> **2026 note:** jQuery is **legacy**. It was created to paper over inconsistent, verbose browser
> APIs, but modern browsers made most of it unnecessary: `querySelectorAll`, `classList`,
> `addEventListener` and `fetch` now do natively what jQuery wrapped. You still meet it in older
> codebases (and WordPress), so it is worth recognising, but in new code reach for the native APIs
> (or a framework). The AJAX section below pairs the jQuery with its vanilla equivalent.

* Using $ means that we are referring to a jQuery selector

### Initialization
```HTML
<head>
    <!-- other head scripts/tags-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- other head scripts/tags-->
</head>
```

```JavaScript
// javascript file
$(function() {
})

$(window).on('load', function() {
})

$(document).ready(function() {
})
```

### Selectors (almost same as for css)
* \* - wild selector (all elements)
* .class - based on stated class
* tag - based on tag name
* #id - based on id
* .class, .class, tag - multi element selector

```JavaScript
$('#footer') // same as document.getElementById('footer')

$('.my-class') // similar to document.getElementsByClassName('my-class')

$('.my-class, table') // no equivalent for plain JavaScript

$('span.font-small') // combined selector similar to document.querySelectorAll('span .font-small')
```

### Pseudo-selectors
* :visible/:hidden - based on the element state
* [type="email"] - attribute based (close to css)
* .find() - find in child nodes
* .filter() - filter by selected elements
* .eq() - select a specific element based on it's index in list

```JavaScript
$('input[type="email"]') // Attribute based

$('.nav:hidden') // selects hidden elements that have class nav
$('#popup').is(':hidden') // return true or false

$('.header').find('.logo') // Look for child elements that contain .logo class

$('li').filter('.active') // Looks between li elements and select those that have active class

$('div').eq(1) // same as document.getElementsByClassName('div')[1]
```

### CSS related
* .addClass()
* .removeClass()
* .css()
* .hasClass()
* .toggleClass()
```JavaScript
$('selector').css('property', value) // Set a single property
$('selector').css({
    "property": "value",
    "property": "value"
}) // Set multiple css properties
$('selector').css('property') // Read the property value
```

* .offset()
* .position()
* .scrollTop()/.scrollLeft() - manage element scroll
* .height()/.width() - get element dimensions
```JavaScript
$('selector').offset() // gets the element placement according to documents
$('selector').position() // gets the element placement according to parent element

$('body').scrollTop(100) // Scroll 100 pixels down
```

### Manipulations
* .clone()
* .prepend()/.prependTo() - add element as first in HTML parent element list
* .append()/.appendTo() add element as last in HTML parent element list
* .insertAfter()/.insertBefore()
```JavaScript
const $cloneEl = $('selector').clone() // Clone element

// These two do the same only from what element reference point
// The element that is set in the new element is set as the last one
$('selector').append($cloneEl) 
$cloneEl.appendTo($('selector'))

// These two do the same only from what element reference point
// The element that is set in the new element is set as the first one
$('selector').prepend($cloneEl) 
$cloneEl.prependTo($('selector'))
```

### Visual effects
* .hide()/.show()/.toggle() - handles css display property
* .fadeIn()/.fadeOut()/.fadeToggle() - time can be specified how fast does the element showup or hides
* .slideDown()/.slideUp()/.slideToggle() - slide animation to show/hide element

### Event Handling
* .on('event', function(){}) - adds event to the element
* .ajax(params) - communicate with server
  * jQuery wrapper that handles the communication with server

```JavaScript
$('selector').on('click', function() {}) // Adds the function to all elements

// same as (vanilla):
document.querySelectorAll('selector').forEach((el) => {
    el.addEventListener('click', () => {});
});
```

```JavaScript
// Request to the server (jQuery)
$.ajax({
  method: "GET",
  url: "https://jsonplaceholder.typicode.com/users"
})
.done(function( response ) {
    $('body').append('<ul class="new-list"></ul>')

    response.forEach(function(val) {
        $('.new-list').append('<li>'+val.email+'</li>')
    })
});
```

The same request with the native **fetch** API and async/await, no jQuery:
```JavaScript
async function loadUsers() {
    const res = await fetch('https://jsonplaceholder.typicode.com/users');
    const users = await res.json();

    const list = document.createElement('ul');
    list.className = 'new-list';
    for (const user of users) {
        const li = document.createElement('li');
        li.textContent = user.email; // textContent (not innerHTML) avoids HTML injection
        list.append(li);
    }
    document.body.append(list);
}
loadUsers();
```
* good API for playing around - [link](https://jsonplaceholder.typicode.com)
* public API - [link](https://github.com/public-apis/public-apis)
  
### All jQuery options: [cheat-sheet](https://oscarotero.com/jquery/)

### Checkup
1. Add an click event to a button that toggles it's class (add some style to the class)
2. Create an HTML element, append a new one to it and one before
3. Add a button to an element that when clicked scrolls 50% of the element height;
4. Create an ajax request that prints response data to the page (style it, make it look nice)