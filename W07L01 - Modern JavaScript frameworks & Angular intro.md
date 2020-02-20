### Angular project setup
* npm install -g @angular/cli
* ng new you-name-here (I would use "web", as we will integrate it in to the main project)
* All ng commands are stated under projects README.md
* Run watcher for files to be compiled when changed
### Component Setup
``` JavaScript
import { Component } from '@angular/core';

@Component({
  selector: 'selector-name',
  templateUrl: './components-html-file.component.html',
  styleUrls: ['./components-css-file.component.css']
})
export class ComponentName {
    // Components JavaScript Logic
}
```

### Data binding & TypeScript
```JavaScript
export class ComponentName {
    heading: string = "My Heading"
}
```
```HTML
<!-- Most used JavaScript functionality -->
<!-- *ngFor="let item of itemList" -->
<!-- *ngIf="true" -->
<!-- [ngClass]="{'my-class': true/false statement}" -->
<h1>{{ heading }}</h1>
```