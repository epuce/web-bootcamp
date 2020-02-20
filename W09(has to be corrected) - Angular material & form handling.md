### Angular material
* [documentation](https://material.angular.io/components/categories)
* Add the npm packages
```JavaScript
"dependencies": {
    "@angular/cdk": "^7.0.1",
    "@angular/material": "^7.0.1",
}
```
* Add the component module import to app.module.ts
```JavaScript
"imports": [
    ...
    MatTableModule,
    MatInputModule,
    MatButtonModule,
    ...
]
```
* Add form control module import to app.module.ts
```JavaScript
"imports": [
    ...
    FormsModule,
    ReactiveFormsModule,
    ...
]
```
* Set up material component HTML & JS if needed
```HTML
<!-- For table -->
<table mat-table
       [dataSource]="list$">

    <ng-container matColumnDef="id">
        <th mat-header-cell
            *matHeaderCellDef>
            
            #
        </th>

        <td mat-cell
            *matCellDef="let item">

           {{ item.id }}
        </td>
    </ng-container>

    <ng-container matColumnDef="name">
        <th mat-header-cell
            *matHeaderCellDef>
            
            Name
        </th>

        <td mat-cell
            *matCellDef="let item">

           {{ item.name }}
        </td>
    </ng-container>

    <tr mat-header-row
        *matHeaderRowDef="displayedColumns"></tr>

    <tr mat-row
        *matRowDef="let row; columns: displayedColumns;"></tr>
</table>
```
```JavaScript
// For table
export class MyComponentName {
    displayedColumns: string[]: [
        'id',
        'name'
    ]
}
```
```HTML
<!-- For input -->
<mat-form-field class="col-xl-12">
    <input matInput
           placeholder="Name"
           [formControl]="controls.name"/>
</mat-form-field>

<mat-checkbox [formControl]="controls.active">
    Active
</mat-checkbox>
```
```JavaScript
// For input
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
* Set up a state manager for list handling from - https://reqres.in/api/users?page=2 where page number is set buy you
* Show requested data in a angular material table
* Set up an angular material input field where the user enters a number
* Add a button that requests the data with page number that is set in the input field
* Show a loading symbol while the request is pending
* Update the table