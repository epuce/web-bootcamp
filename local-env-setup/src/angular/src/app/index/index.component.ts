import { Component, OnInit, inject, signal } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { firstValueFrom } from 'rxjs';
import { Router } from '@angular/router';

interface User {
  id: number;
  name: string;
  email: string;
}

/**
 * Protected landing page (reachable only through the `accessGuard`).
 * Demonstrates three modern Angular features:
 *  - `signal()` reactive state for the counter,
 *  - `HttpClient` + `firstValueFrom` to await an Observable like a Promise,
 *  - the built-in `@if` / `@for` control-flow syntax in the template.
 */
@Component({
  selector: 'app-index',
  standalone: true,
  template: `
    <section class="index">
      <h1>Welcome</h1>
      <p>You are logged in. This page is protected by <code>accessGuard</code>.</p>

      <div class="index__counter">
        <button type="button" (click)="decrement()">-</button>
        <strong>{{ count() }}</strong>
        <button type="button" (click)="increment()">+</button>
        <span>(signal-based counter)</span>
      </div>

      <h2>Users</h2>

      @if (loading()) {
        <p>Loading users…</p>
      } @else if (error()) {
        <p class="index__error">{{ error() }}</p>
      } @else {
        <ul class="index__list">
          @for (user of users(); track user.id) {
            <li>
              <strong>{{ user.name }}</strong> — {{ user.email }}
            </li>
          } @empty {
            <li>No users found.</li>
          }
        </ul>
      }

      <button type="button" class="index__logout" (click)="logout()">Log out</button>
    </section>
  `,
  styles: [`
    .index { max-width: 40rem; }
    .index__counter { display: flex; align-items: center; gap: 0.75rem; margin: 1rem 0; }
    .index__counter button { width: 2rem; cursor: pointer; }
    .index__list { line-height: 1.8; }
    .index__error { color: #c62828; }
    .index__logout { margin-top: 1.5rem; padding: 0.5rem 1rem; cursor: pointer; }
  `]
})
export class IndexComponent implements OnInit {
  private readonly http = inject(HttpClient);
  private readonly router = inject(Router);

  // signal() holds reactive state; call it as a function to read the value.
  readonly count = signal(0);
  readonly users = signal<User[]>([]);
  readonly loading = signal(true);
  readonly error = signal<string | null>(null);

  increment(): void {
    this.count.update((n) => n + 1);
  }

  decrement(): void {
    this.count.update((n) => n - 1);
  }

  async ngOnInit(): Promise<void> {
    try {
      // firstValueFrom turns the HttpClient Observable into a Promise so we
      // can await it. JSONPlaceholder is a free, key-less public API.
      const users = await firstValueFrom(
        this.http.get<User[]>('https://jsonplaceholder.typicode.com/users')
      );
      this.users.set(users);
    } catch {
      this.error.set('Could not load users. Please try again later.');
    } finally {
      this.loading.set(false);
    }
  }

  logout(): void {
    localStorage.removeItem('loggedIn');
    this.router.navigate(['/login']);
  }
}
