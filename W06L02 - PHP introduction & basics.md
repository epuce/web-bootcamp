### Back end technologies
1. What do we need?
   1. Web server
   2. Back End language/technologies
   3. Data base

2. Check if PHP has been installed if not install it - globally on your machine
3. Check if mysql has bene installed if not install it - globally on your machine

4. Start a web server
```PHP
// Run the command in terminal
// The localhost:8000 can be any link that is used to access the server
// The router.php is your created router file, using "-t path/to/folder" can be used to specify a folder where the servers starting point is set  
php -S localhost:8000 router.php
```
```PHP
// router.php - not mandatory
<?php
if (preg_match('/^\/api/', $_SERVER["REQUEST_URI"])) {
    $path = substr($_SERVER["REQUEST_URI"], 4);
    include(__DIR__."/src/$path");
} else if (preg_match('/^[^\.]+$/', $_SERVER["REQUEST_URI"])) {
    include(__DIR__."/public/index.html");
} else {
    $path = $_SERVER["REQUEST_URI"];
    include(__DIR__."/public$path");
}
?>
```

* Most of BE technologies can be implemented directly in HTML
```HTML
<form action="get.php" method="get">
    <div>Name: <input type="text" name="name"></div>
    <div>E-mail: <input type="email" name="email">
</div>
<button type="submit">Save User</button>
```

```PHP
// get.php
Hi <?php echo $_GET["name"]; ?><br>
You have subscribed with e-mail: <?php echo $_GET["email"]; ?>
```
* [documentation](https://www.w3schools.com/php/)
* Conditioning - almost the same a in  JavaScript
```PHP
<?php
if ($condition) {
   ?>
   <b>This is true.</b>
   <?php
} else {
   ?>
   <b>This is false.</b>
   <?php
}?>
```
* Concatenation
```PHP
<?php
$name = "Edmunds";
$profession = "programmer";

"Hi, my nam is " . $name . ", I'm a " . $profession;

// Result: Hi, my nam is Edmunds, I'm a programmer;
?>
```
* Data types:
  * boolean
  * integer
  * float
  * string
  * array
  * object
  * NULL

* Commands
  * print/println
  * echo
  * array_pop/array_push/array_search
  * fopen/fclose/file_get_contents/etc. - file reading, [link](https://teamtreehouse.com/library/reading-files-into-a-string-or-array)
  * serialize/unserialize
  * require/require_once/include
  * etc.

* Command line script
```PHP
<?php
function xTime($starttime) {
    // Get the difference between start and end in microseconds, as a float value
    $diff = microtime(true) - $starttime;

    // Break the difference into seconds and microseconds
    $sec = intval($diff);
    $micro = $diff - $sec;

    // result will look like "00:00:02.452"
    return strftime('%T', mktime(0, 0, $sec)) . str_replace('0.', '.', sprintf('%.3f', $micro));
}

function title(string $title) {
    global $start;
    echo PHP_EOL;
    echo ' -> '.$title.' ('.xTime($start).')'.PHP_EOL;
    echo PHP_EOL;
}

$folderName = "my-project";

if (isset($argv[1]) && is_string($argv[1])) {
    $folderName = strtolower($argv[1]);
}

$git  = 'https://github.com/epuce/web-bootcamp.git';

title('Git clone');
echo shell_exec("cd ../; git clone $git $folderName");

title('npm install');
echo shell_exec("cd ../; npm install --prefix $folderNameAngular-project").PHP_EOL;
title('npm start ng server');
echo shell_exec("cd ../; npm run start --prefix $folderNameAngular-project").PHP_EOL;

echo PHP_EOL;
echo ' *********'.PHP_EOL;
echo ' ALL DONE!'.PHP_EOL;
echo ' *********'.PHP_EOL;
?>
```
### Checkup
1. Create an array, loop thru it and print the values to the browser with some extra text for each value
2. Create a form, trigger an action that sends the data to server and returns a modified value
3. Create a script witch when run clones your angular project, and then builds it
4. Create a script that writes the data you pass as arguments to a file