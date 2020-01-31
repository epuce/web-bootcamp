### Browser tools
https://docs.google.com/presentation/d/1MNBR_8x_nU3wEJfrXEBfxc5BH-2DnLRREw0ofJr5rpw/edit?usp=sharing

### HTML basics - tags
* DOM
* Tag types and differences - https://www.w3schools.com/tags/default.asp
    * Regular tags
    * Self Closing tags
    * Tag naming and their differences
    * Purpose tags
### Basic HTML structure

```html
<!DOCTYPE html>
<html>
    <head>
        <title>Page Title</title>
    </head>
    <body>
        <h1>Headline</h1>
        <p>This is a paragraph.</p>

        <div>building block</div>
    </body>
</html>
```

* All Web pages have this structure
    * The <!DOCTYPE> declaration is not an HTML tag; it is an instruction to the web browser about what version of HTML the page is written in.
    * html
        * container for all elements
        * tels the browser that this is an html file
        * represents the root of an HTML document
    * head - contains tags that describes the html part that is not page content
        * https://htmlhead.dev/
    * body - contains tags that can be displayed in the browser

### Tags and their special relationships
* table and it's childe elements
```html
<table>
<thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
    </tr>
</thead>
<tbody>
    <tr>
        <td>1</td>
        <td>Jānis</td>
    </tr>
    <tr>
        <td>2</td>
        <td>Pēteris</td>
    </tr>
    <tr>
        <td>3</td>
        <td>Juris</td>
    </tr>
</tbody>
</table>
```

* form and it's corresponding elements

```html
<form>
    <label for="name">Name</label>
    <input id="name"/>

    <label for="age">Age</label>
    <input id="age" type="number">

    <button type="submit">Save</button>
</form>
```

* list and it's child's
```html
<ol>
    <li>
        My favorite foods:

        <ul>
            <li>Pizza</li>
            <li>Pasta</li>
            <li>Hot-dogs</li>
        </ul>
    </li>
    <li>
        My favorite sports:

        <ul>
            <li>Hockey</li>
            <li>Beach volleyball</li>
        </ul>
    </li>
</ol>
``

* other commonly used tags
    * a - for links to inner ot outer sources
    * img - for image handling
    * div - just a block wrapper
    * span - just a inline wrapper
    * br -  self closing new line tag
    * <!--...--> comment tag (not displayed in browser)