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
	public function __construct(private PDO $pdo) {}

	public function getAllUsers(): array
	{
		return $this->pdo->query('SELECT id, name, profession FROM Users')->fetchAll(PDO::FETCH_ASSOC);
	}

	public function createUser(User $user): void
	{
		// Placeholders (?) keep user data out of the SQL string, so there is no injection
		$stmt = $this->pdo->prepare('INSERT INTO Users (name, profession) VALUES (?, ?)');
		$stmt->execute([$user->name, $user->profession]);
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
// controllers/users/index.php
<?php
require __DIR__ . '/../../vendor/autoload.php'; // PSR-4 autoloading, no per-file require (see the PHP basics lesson)

// $pdo is a single shared database connection
$userModel = new UserModel($pdo);
$users = $userModel->getAllUsers();

// Show the view
require __DIR__ . '/../../views/user-list.php';
```

### Entities
```PHP
// User.php
<?php
class User {
	public ?int $id = null;
	public string $name = '';
	public string $profession = '';

	public function setId(int $id): void {
		$this->id = $id;
	}

	public function setName(string $name): void {
		$this->name = $name;
	}

	public function setProfession(string $profession): void {
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

