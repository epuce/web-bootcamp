## Angular state handling/management

When `@Input`/`@Output` chains and shared services stop scaling, reach for a state store.

### First: do you actually need one?
* For most apps, **Angular signals** (`signal`, `computed`, `effect`) plus a small shared service are
  enough, and that is the current default recommendation. Add a full store only for genuinely complex,
  widely-shared state.

### NgRx (the Redux pattern for Angular)
* Install: `npm install @ngrx/store @ngrx/effects @ngrx/store-devtools` (the abandoned
  `@angular-redux/store` and hand-wired `redux` packages are no longer used).
* Register it without an NgModule:
```TypeScript
// main.ts
import { bootstrapApplication } from '@angular/platform-browser';
import { provideStore } from '@ngrx/store';
import { provideStoreDevtools } from '@ngrx/store-devtools';

bootstrapApplication(AppComponent, {
    providers: [
        provideStore({ users: usersReducer }),
        provideStoreDevtools(),
    ],
});
```
* The flow is always: **state** → **actions** (things that happened) → **reducers** (pure functions
  that produce the next state) → **selectors** (read a slice) → components dispatch actions and select
  state. NgRx also offers lighter **SignalStore** and **ComponentStore** for feature/local state.

> The same idea in other ecosystems: Vue has **Pinia**; React has **Redux Toolkit** or **Zustand**,
> with **TanStack Query** handling server state. Different names, same pattern.
