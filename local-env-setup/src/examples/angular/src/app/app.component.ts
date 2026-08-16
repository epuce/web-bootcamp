import { Component, signal } from '@angular/core';

@Component({
  selector: 'app-root',
  standalone: true,
  template: `
    <main class="app">
      <h1>You have clicked {{ count() }} times</h1>
      <button type="button" (click)="addOne()">Add one</button>
    </main>
  `,
  styles: [`
    .app {
      font-family: system-ui, sans-serif;
      max-width: 40rem;
      margin: 2rem auto;
      text-align: center;
    }
    button {
      padding: 0.5rem 1rem;
      font-size: 1rem;
      cursor: pointer;
    }
  `],
})
export class AppComponent {
  // signal() holds reactive state; call it as a function to read the value.
  count = signal(0);

  addOne(): void {
    this.count.update((n) => n + 1);
  }
}
