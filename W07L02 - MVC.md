### MVC & Entities
* M - models
* V - views
* C - controllers
* Entities

### Project structure
```PHP
// Project tree
root_folder/
--controllers/
----users/
------index.php
------add/
--------index.php
--entity/
----User.php
--helpers/
----database-wrapper.php
--models/
----UserModel.php
--views/
----user-form.php
----user-list.php
```
### Models
```PHP
// UserModel.php
<?php
class UserModel
{
	protected $db;

	public function __construct(DatabaseWrapper $db)
	{
		$this->db = $db;
	}

	public function getAllUsers() {
		return $this->db->execute('SELECT * FROM Users');
	}

	public function createUser(User $user)
	{
		return $this->db->execute("INSERT INTO Users (name, profession) VALUES ('" . $user->name. "', '" . $user->profession . "')");
	}
}
```
### Views
```PHP
// user-list.php
<table>
	<?php foreach ($users as $row): ?>
		<tr>
			<td>
				<?= $row['id']?>
			</td>
			<td>
				<?= $row['name'] ?>
			</td>
			<td>
				<?= $row['profession'] ?>
			</td>
		</tr>
	<?php endforeach ?>
</table>
```
### Controllers
```PHP
controllers/users/index.php
<?php
include_once '../../helpers/database-wrapper.php';

$db = new DatabaseWrapper();
$db->openDatabaseConnection();

// Make your model available
include '../../models/UserModel.php';

// Create an instance
$userModel = new UserModel($db);
$users = $userModel->getAllUsers();

// Show the view
include '../../views/user-list.php';
```

### Entities
```PHP
// User.php
<?php
class User {
	public $name;
	public $profession;
	public $id;

	public function __construct() {
	}

	/**
	 * @param mixed $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * @param mixed $name
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * @param mixed $profession
	 */
	public function setProfession($profession) {
		$this->profession = $profession;
	}
}
```

### Checkup
* Create new table in database
* Using MVC and Entity model
    * Create two different screens
    * On of the screen has some type of data manipulation (create, update, filter by parameter, etc.)
    * Use setters for Entity management

