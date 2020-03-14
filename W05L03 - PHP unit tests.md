## Setup
* Step by step setup for our docker (composer+phpunit) - [link](https://linuxize.com/post/how-to-install-and-use-composer-on-ubuntu-18-04/)

#### All commands have to be run in docker console
* Composer (php package manager)
    1. php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
    2. apt-get install wget
    2. HASH="$(wget -q -O - https://composer.github.io/installer.sig)"
    3. php -r "if (hash_file('SHA384', 'composer-setup.php') === '$HASH') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
        * This should return: `Installer verified`
    4. php composer-setup.php --install-dir=/usr/local/bin --filename=composer
        * check if composer is installed by typing: `composer`
* phpunit (php unit test library)
    1. composer require --dev phpunit/phpunit ^9
    2. composer.json file and some others were generated in our project. Edit the composer.json file to look like:
        ```JSON
        {
            "autoload": {
                "classmap": ["./"]
            },
            "require-dev": {
                "phpunit/phpunit": "^9"
            }
        }
        ```
    3. run: `composer dump-autoload`
    4. to run the tests `./vendor/bin/phpunit --testdox tests` 

# Look at the user that he could use your system like this
![Testers VS Users gif](img/testers-VS-users.gif)

### Logic
* We will specify a folder that will contain all the tests, only files that end with Test.php will be treated as tests
* The tests are written so we imitate the function (or function group) by passing different parameters and expecting some specific result
* Tests are usually written based on the amount of code we cover (test)
* We test also for failed results

```PHP
// file UserTest.php

use PHPUnit\Framework\TestCase; // Include the class to extend

class userTest extends TestCase {
    public function testGetAllUsers(): void
    {
        $result = UserModel::getAllUsers();
        $users = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $users[] = $row;
        }

        $this->assertThat(5, $this->lessThan(count($users))); // Test if we have more than 5 users in the database
    }
    
    public function testAddAndGetUser(): void
    {
        $data = [
            "name" => "Test name",
            "password" => "Test password"
        ];

        $userId = UserModel::addUser($data);
        $result = UserModel::getUserById($userId);
        
        var_dump($userId);

        $this->assertEquals(1, $result->num_rows);
        try {
            while ($row = mysqli_fetch_assoc($result)) {
                $this->assertNotNull($row["password"]);
                $this->assertNotNull($row["password"]);
                $this->assertEquals($data["name"], $row["name"]);
                $this->assertEquals($data["password"], $row["password"]);
            }
        } finally {
            UserModel::deleteUserById($userId);
        }
    }
}
```
### Example
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
### Checkup 
1. Create Product CRUD logic (DB + PHP) and one not database related function
2. Create test for each of the CRUD logic and the extra function, test for valid and invalid response