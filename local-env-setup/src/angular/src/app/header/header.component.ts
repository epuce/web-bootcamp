import { Component } from '@angular/core';
import { RouterLink, RouterLinkActive } from '@angular/router';

/**
 * Standalone header shown on every page.
 * `routerLink` navigates without a full page reload; `routerLinkActive`
 * adds a class to the link matching the current URL.
 */
@Component({
  selector: 'app-header',
  standalone: true,
  imports: [RouterLink, RouterLinkActive],
  template: `
    <header class="app-header">
      <span class="app-header__brand">Angular 18 demo</span>
      <nav class="app-header__nav">
        <a routerLink="/" routerLinkActive="app-header__link--active" [routerLinkActiveOptions]="{ exact: true }">Home</a>
        <a routerLink="/login" routerLinkActive="app-header__link--active">Login</a>
      </nav>
    </header>
  `,
  styles: [`
    .app-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0.75rem 1.25rem;
      background: #1976d2;
      color: #fff;
    }
    .app-header__brand {
      font-weight: 700;
    }
    .app-header__nav {
      display: flex;
      gap: 1rem;
    }
    .app-header__nav a {
      color: #fff;
      text-decoration: none;
    }
    .app-header__link--active {
      text-decoration: underline;
    }
  `]
})
export class HeaderComponent {}
