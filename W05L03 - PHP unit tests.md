# 🧪 PHP unit tests

## Setup

* Step by step setup for our docker (composer+phpunit) - [link](https://getcomposer.org/doc/00-intro.md)

### All commands have to be run in docker console

* Composer (php package manager)
    1. php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
    2. apt-get install wget
    2. HASH="$(wget -q -O - https://composer.github.io/installer.sig)"
    3. php -r "if (hash_file('SHA384', 'composer-setup.php') === '$HASH') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
        * This should return: `Installer verified`
    4. php composer-setup.php --install-dir=/usr/local/bin --filename=composer
        * check if composer is installed by typing: `composer`
* XAMPP setup
    * cd to server main folder (default: htcdocs)
    * run: `php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"`
    * run: `php composer-setup.php`
    * run: `php composer.phar install`
* phpunit (php unit test library)
    1. composer require --dev phpunit/phpunit ^11
    2. composer.json file and some others were generated in our project. Edit the composer.json file to look like:
        ```JSON
        {
            "autoload": {
                "classmap": ["./"]
            },
            "require-dev": {
                "phpunit/phpunit": "^11.0"
            }
        }
        ```
    3. create a folder that will hold all the tests (e.g. `tests/`)
    4. run: `composer dump-autoload`
    5. to run the tests: `./vendor/bin/phpunit --testdox tests`

## Look at the user that he could use your system like this

![Testers VS Users gif](img/testers-VS-users.gif)

## Logic

* We will specify a folder that will contain all the tests, only files that end with Test.php will be treated as tests
* The tests are written so we imitate the function (or function group) by passing different parameters and expecting some specific result
* Tests are usually written based on the amount of code we cover (test)
* We test also for failed results

```PHP
// file UserTest.php
use PHPUnit\Framework\TestCase;

final class UserTest extends TestCase
{
    private PDO $pdo;
    private UserModel $users;

    protected function setUp(): void
    {
        // Point tests at a dedicated TEST database, never the real one
        $this->pdo = new PDO('mysql:host=localhost;dbname=web_bootcamp_test', 'root', 'root_password');
        // Wrap each test in a transaction so tests can't affect one another...
        $this->pdo->beginTransaction();
        $this->users = new UserModel($this->pdo);
    }

    protected function tearDown(): void
    {
        // ...and undo it afterwards, leaving the database exactly as it was
        $this->pdo->rollBack();
    }

    public function testAddAndGetUser(): void
    {
        $userId = $this->users->createUser(['name' => 'Test name', 'password' => 'secret']);
        $user = $this->users->getUserById($userId);

        $this->assertNotNull($user);
        $this->assertSame('Test name', $user['name']);
        // Passwords are stored hashed, so the raw value must NOT appear in the row
        $this->assertNotSame('secret', $user['password']);
        $this->assertTrue(password_verify('secret', $user['password']));
    }
}
```

Two habits worth calling out: give tests their **own database** (or mock the data layer) so they never
depend on production data, and for pure logic (no DB, no network, like the date helper below) no setup
is needed at all, just call the function and assert.

## Example

```PHP
// Function to test - get how many months are in use between two dates
public static function getMonthsSelectedCount($date1, $date2){
    $start = new DateTime($date1);
    $start->modify('first day of this month');
    $end = new DateTime($date2);
    $end->modify('first day of next month');
    $interval = DateInterval::createFromDateString('1 month');
    $period = new DatePeriod($start, $interval, $end);

    return iterator_count($period) - 1;
}

// Test
public function testGetMonthsSelectedCount() {
    $date1 = '2020-01-01';
    $date2 = '2020-01-05';
    $this->assertEquals(0, HF::getMonthsSelectedCount($date1, $date2));

    $date1 = '2020-01-01';
    $date2 = '2020-02-01';
    $this->assertEquals(1, HF::getMonthsSelectedCount($date1, $date2));

    $date1 = '2020-01-30';
    $date2 = '2020-02-28';
    $this->assertEquals(1, HF::getMonthsSelectedCount($date1, $date2));

    $date1 = '2020-01-30';
    $date2 = '2020-02-01';
    $this->assertEquals(1, HF::getMonthsSelectedCount($date1, $date2));

    $date1 = '2020-01-01';
    $date2 = '2020-02-28';
    $this->assertEquals(1, HF::getMonthsSelectedCount($date1, $date2));

    $date1 = '2019-12-30';
    $date2 = '2020-02-28';
    $this->assertEquals(2, HF::getMonthsSelectedCount($date1, $date2));

    $date1 = '2019-12-01';
    $date2 = '2020-02-01';
    $this->assertEquals(2, HF::getMonthsSelectedCount($date1, $date2));

    $date1 = '2019-12-30';
    $date2 = '2020-02-01';
    $this->assertEquals(2, HF::getMonthsSelectedCount($date1, $date2));

    $date1 = '2019-12-01';
    $date2 = '2020-02-28';
    $this->assertEquals(2, HF::getMonthsSelectedCount($date1, $date2));

    $date1 = '2019-12-30';
    $date2 = '2020-03-30';
    $this->assertEquals(3, HF::getMonthsSelectedCount($date1, $date2));

    $date1 = '2019-12-01';
    $date2 = '2020-03-01';
    $this->assertEquals(3, HF::getMonthsSelectedCount($date1, $date2));

    $date1 = '2019-12-30';
    $date2 = '2020-03-01';
    $this->assertEquals(3, HF::getMonthsSelectedCount($date1, $date2));

    $date1 = '2019-12-01';
    $date2 = '2020-03-30';
    $this->assertEquals(3, HF::getMonthsSelectedCount($date1, $date2));
}
```

> [!TIP]
> **Checkup**
>
> 1. Create Product CRUD logic (DB + PHP) and one not database related function
> 2. Create test for each of the CRUD logic and the extra function, test for valid and invalid response
