### Angular routing
* Angular is as single page application system: what does that mean?
    * After initial page lode, only extra data that is needed for the new page to load is loaded. So the static page elements, styles, scripts and others are not loaded again.
    * [documentation](https://angular.io/guide/router)

```TypeScript
import { Routes } from '@angular/router';

export const routes: Routes = [
    { path: 'login', component: LoginComponent },
    {
        path: '',
        // Lazy-load a standalone component with a dynamic import
        // (the old string "./x.module#XModule" syntax was removed)
        loadComponent: () => import('./index/index.component').then((m) => m.IndexComponent),
        canMatch: [accessGuard],   // CanLoad is deprecated; use CanMatch
    },
    { path: '**', redirectTo: 'login' },
];

// Wired up without NgModule, in main.ts:
//   bootstrapApplication(AppComponent, { providers: [provideRouter(routes)] });
```

```TypeScript
import { CanMatchFn, Router } from '@angular/router';
import { inject } from '@angular/core';

// Guards are now plain functions, not classes; inject whatever they need
export const accessGuard: CanMatchFn = () => {
    const router = inject(Router);

    if (localStorage.getItem('loggedIn') === 'true') {
        return true;
    }
    return router.parseUrl('/login'); // returning a UrlTree performs the redirect
};
```

### Checkup
* Set up a static component (like header, or footer) that will be shown on all pages
* Add two pages that display different components
* Allow to access one of the pages by a condition (like, if there has been a click on a button in the first page)
* Display some server data on the page with access restrictions

### Angular form handling

* Import `ReactiveFormsModule` in the standalone component's `imports` (there is no app.module.ts anymore)
```TypeScript
@Component({
    standalone: true,
    imports: [ReactiveFormsModule],
    // ...
})
```

```HTML
<!-- HTML -->
<input placeholder="Name" 
       [formControl]="controls.name"/>

<label>
    <input type="checkbox" [formControl]="controls.active">
        Active
</label>
```

```TypeScript
export class MyComponentName {
    // Typed reactive form; nonNullable keeps the values non-null
    form = new FormGroup({
        name: new FormControl('', { nonNullable: true, validators: [Validators.required] }),
        active: new FormControl(false, { nonNullable: true }),
    });

    constructor() {
        this.form.valueChanges.subscribe((values) => {
            console.log('The new values are', values);
        });
    }
}
```

### Checkup
1. Create two different pages (components)
2. Add a form to one of them with the possibility for a user to login
    * Create form validation (can add some classes based on that)
    * If the login has been successful (can imitate this) save some flag to localStorage and redirect to the other page
3. Allow to access the second page only if the login has been successful
    * redirect back to login if not