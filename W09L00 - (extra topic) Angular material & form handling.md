### Angular material
* [documentation](https://material.angular.io/components/categories)
* Add the npm packages
```JavaScript
"dependencies": {
    "@angular/cdk": "^18.0.0",
    "@angular/material": "^18.0.0",
}
```
* Import the Material components you use directly in the standalone component's `imports` (Material is
  standalone now, there is no app.module.ts):
```TypeScript
@Component({
    standalone: true,
    imports: [MatTableModule, MatInputModule, MatButtonModule, MatCheckboxModule, ReactiveFormsModule],
    // ...
})
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
    displayedColumns: string[] = ['id', 'name'];
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
export class MyComponentName {
    form = new FormGroup({
        name: new FormControl('', { nonNullable: true, validators: [Validators.required] }),
        active: new FormControl(false, { nonNullable: true }),
    });
}
```
### Checkup
* Set up a state manager for list handling from - https://jsonplaceholder.typicode.com/posts?_page=1&_limit=10 where the page number is set by you
* Show requested data in a angular material table
* Set up an angular material input field where the user enters a number
* Add a button that requests the data with page number that is set in the input field
* Show a loading symbol while the request is pending
* Update the table