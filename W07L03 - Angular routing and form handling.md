### Angular routing
* Angular is as single page application system: what does that mean?
    * After initial page lode, only extra data that is needed for the new page to load is loaded. So the static page elements, styles, scripts and others are not loaded again.
    * [documentation](https://angular.io/guide/router)

```JavaScript
const routes: Routes = [
    {
        path: 'login',
        component: LoginComponent
    }, {
        path: '',
        loadChildren: './index/index.module#IndexModule',
        canLoad: [AccessControlService]
    }, {
        path: '**',
        redirectTo: 'login'
    }
];

@NgModule({
    imports: [RouterModule.forRoot(routes)],
    exports: [RouterModule]
})
export class AppRoutingModule {
}
```

```JavaScript
export class AccessControlService implements CanLoad {
    constructor(
        private router: Router
    ) {
    }
    
    // For component handling
    canActivate() {
        if (localStorage.loggedIn === "true") {
            return true;
        }

        this.router.navigate(['login']);
    }

    // For child lazy loading
    canLoad() {
        if (localStorage.loggedIn === "true") {
            return true;
        }

        this.router.navigate(['login']);
    }
}
```

### Checkup
* Set up a static component (like header, or footer) that will be shown on all pages
* Add two pages that display different components
* Allow to access one of the pages by a condition (like, if there has been a click on a button in the first page)
* Display some server data on the page with access restrictions

### Angular form handling

* Add form control module import to app.module.ts
```JavaScript
"imports": [
    ...
    FormsModule,
    ReactiveFormsModule,
    ...
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

```JavaScript
// JavaScript
export class MyComponentName implements OnInit {
    form: FormGroup;
    controls: any = {
        name: new FormControl('', [Validators.required]),
        active: new FormControl(),
    };

    ngOnInit() {
        this.form = new FormGroup(this.controls);

        this.form.valueChanges.subscribe((values) => {
            console.log("The new values are")
            console.log(values)
        })
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