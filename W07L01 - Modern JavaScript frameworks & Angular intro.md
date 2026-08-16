### Angular project setup
* npm install -g @angular/cli
* ng new you-name-here (I would use "web", as we will integrate it in to the main project)
* All ng commands are stated under projects README.md
* Run watcher for files to be compiled when changed
### Component Setup
```TypeScript
import { Component, signal } from '@angular/core';

@Component({
  // Modern Angular (v17+) components are standalone: no NgModule needed.
  // Whatever the template uses is listed directly in `imports`.
  standalone: true,
  selector: 'app-example',
  imports: [],
  templateUrl: './example.component.html',
  styleUrl: './example.component.css',
})
export class ExampleComponent {
    // State lives in signals: read with heading(), update with heading.set(...)
    heading = signal('My Heading');
}
```

### Data binding & template control flow
```HTML
<!-- Built-in control flow (Angular 17+); no *ngIf / *ngFor imports needed -->
@if (loggedIn()) {
  <h1>{{ heading() }}</h1>
}

<ul>
  @for (item of items(); track item.id) {
    <li [class.active]="item.active">{{ item.name }}</li>
  }
</ul>
```
* Older code uses the structural directives `*ngIf`, `*ngFor` and `[ngClass]`; the `@if` / `@for`
  block syntax above replaced them and is the current default.