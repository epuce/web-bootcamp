### CSS basics
    
* CSS privides the visual part of a web page

* Structure
![css structure](img/W02L01-css_basics.png)
    * Selector: references the HTML element(s) that the style will be applied to
    * Property: the css description of the visual effect
    * Property value: visual description modifier (size, color, position,special value, etc.)
    * Declaration: Property + it's value
    * {}: every style block after the selectior is wrapped in braces
    * ; shows that current declarations has ended, the last one can be left empty, but best practices don't recomend it
* Include in HTML
    
```HTML
<head>
    <link rel="stylesheet" href="path/to/file.css">
</head>

<style>
    table {
        width: 100%
    }

    table td {
        border: 1px soldid #000000
    }
</style>
```

* Most common CSS values
    * Special words (usually self describing)
        * colors (red, blue, black, etc.)
        * display (block, inline, flex)
        * text-align: (left, right, center)
        * etc.
    * Size related - all values are converted to px based on the condition (pixels can be split, but that can have problems)
        * auto
        * full numbers - used for special properties
        * px - pixels, based on page pixel count
        * % - percent from parent element size
        * vw, vh - based on window size
        * em - basded on parent element font-size
        * rem - based on html element font-size
        * calc(100px + 100%) - calculates the value needed and converts to px
    * Color related
        * Hex - #0000FF
        * RGB - rgb(255, 0, 0)
        * RGB - rgba(255, 0, 0, .5)
        * HSL - hsl(0, 100%, 50%)
        * HSLA - hsla(0, 100%, 50%, .5)
    * Global values
        * inherit - value it's parent element has
        * initial - same as no value vould be set
    * Font related properties are given to their child elements 
        * font-size
        * text-align
        * line-hight
        * color
        * etc.

### CSS selectors
| Selector | Example | Explenation |
|----------|---------|-------------|
| tag | h1 | Selects all elements with this tag name |
| #id | #name | Selects the element with stated ID |
| .class | .border-table | Selects all ements with stated class |
| .class.class | .border-table.row-style | Selects all elements that have these two (or more) classes used together. Can also be sude with tags, IDs' |
| .class .class | .border-table .cell-age | Selects all cells with class |.cell-age that have a parent element with class .border-table. Can be used with tag and IDs' (only as parent) also |
| * | * | Selects all elements (.border-table * would select all chld elements of .border-tabl) |
| .class1, class2 | .border-table, border-title | Both classes have the same styling. Also can be used with tagds and IDs' |
| element>element | div > p |  Selects all firs level child p tags of div |
| element+element | h1 + div | Selects first div tags that are placed after h1 and have no other element in between (on the same level) |
| element~element | .border-table ~ p | Selects all firs level child p that come after .border-table elements
| [attribute] | [required] | Selects all elements with stated html atribute (no matter what value) |
| [attribute=value] | [type=checkbox] | Selects all ements with stated html atribute and it's value
| [attribute~=value] | [title~=name] | Selects all elements that have an atribute that includes the specified text |
| [attribute^=value] |	[lang^=en] | Selects all elements that have an atribut thats starts with the stated text |
| [attribute$=value] | [href$=".pdf"]| Selects all elements that have an atribut thats ends with the stated text |
| [attribute*=value] | [href*=".com"] | Gets all elements with atribute that containes stated value

### CSS state selectors (alvays together with a pre stated element)
| Selector | Example | Explenation |
|----------|---------|-------------|
| :focus | input:focus | Styles focused input element |
| :hover | h1:hover | Styles level 1 heading tag when cursos moves in its' space |
| :first-child :last-child | td:firs-child | Styles first or last same lavel element (last cell in row for example) |
| :root | :root | As we can use component approach, there is a possibility that the higher level element is not html, so :root can style the parent element depending on scope | 
| :not(element) | a:not(.noStyle) | Styles all elements except chosen ones |

### Full list of all CSS selectors
[Link](https://www.w3schools.com/cssref/css_selectors.asp)
