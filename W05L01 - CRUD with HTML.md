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
* [C - create](local-env-setup/src/W05L01/add.php)
* [R - read](local-env-setup/src/W05L01/index.php)
* [U - update](local-env-setup/src/W05L01/edit.php)
* [D - delete](local-env-setup/src/W05L01/delete.php)

### Data manipulation with API requests
* [Requests with jQuery](local-env-setup/src/W05L01/scripts.js)
* [PUT - update](local-env-setup/src/W05L01/src/put.php)
* [POST - create](local-env-setup/src/W05L01//src/post.php)
* [DELETE](local-env-setup/src/W05L01//src/delete.php)

### Checkup
1. Create a new data table with minimum 2 fields
2. Add all 4 data manipulation functions with PHP
    * CREATE
    * READ
    * UPDATE
    * DELETE
