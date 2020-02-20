### PHP + HTML
* Displaying data directly in HTML
```php
// index.php
<?php
require_once "src/database-wrapper.php";

$database = new DatabaseWrapper();

$database->openDatabaseConnection('web-bootcamp');

$sql = "SELECT * FROM Users";

$response = $database->execute($sql);

$database->closeDatabaseConnection();
?>
```
```html
<table class="table">
    <thead>
    <tr bgcolor='#CCCCCC'>
        <th>Name</th>
        <th>Profession</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php
    while($row = mysqli_fetch_array($response)) {
        echo "<tr>";
        echo "<td>".$row['NAME']."</td>";
        echo "<td>".$row['PROFESSION']."</td>";
        echo "<td>
                <a class=\"btn btn-primary\" href=\"edit.php?id=$row[id]\">Edit</a> 
                <a class=\"btn btn-danger\" href=\"delete.php?id=$row[id]\">Delete (PHP)</a>
                <a class=\"btn btn-danger delete\" data-id=\"$row[id]\">Delete (jQuery)</a>
              </td>";
        echo "</tr>";
    }
    ?>
    </tbody>
</table>
```
### CRUD
* [C - create](extra-resources/W06L04/add.php)
* [R - read](extra-resources/W06L04/index.php)
* [U - update](extra-resources/W06L04/edit.php)
* [D - delete](extra-resources/W06L04/delete.php)

### Data manipulation with API requests
* [Requests with jQuery](extra-resources/W06L04/scripts.js)
* [PUT - update](extra-resources/W06L04/src/put.php)
* [POST - create](extra-resources/W06L04/src/post.php)
* [DELETE](extra-resources/W06L04/src/delete.php)

### Checkup
1. Create a new data table with minimum 2 fields
2. Add all 4 data manipulation functions with PHP
    * CREATE
    * READ
    * UPDATE
    * DELETE
