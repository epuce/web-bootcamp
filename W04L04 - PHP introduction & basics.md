<!-- TODO setup/introduce to xdebug -->
### PHP basics
1. What do we need?
   1. Web server
   2. Back End language/technologies
   3. Data base

2. Check if PHP has been installed if not install it - globally on your machine (if not using docker)
3. Check if mysql has bene installed if not install it - globally on your machine (if not using docker)

4. Start a web server (if not using docker)
```PHP
// Run the command in terminal
// The localhost:8000 can be any link that is used to access the server
// The router.php is your created router file, using "-t path/to/folder" can be used to specify a folder where the servers starting point is set  
php -S localhost:8000 router.php
```
```PHP
// router.php - not mandatory, is needed to ask for hte correct file, based on requested URL
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

### Debugger - xdebug
* Listens to all the requests to the server and stops the scrip execution where the breaking point in the file was set
* vscode setup:
    * in project root folder, under .vscode create a file *launch.json* with this content
    ```JavaScript
    {
        // Use IntelliSense to learn about possible attributes.
        // Hover to view descriptions of existing attributes.
        // For more information, visit: https://go.microsoft.com/fwlink/?linkid=830387
        "version": "0.2.0",
        "configurations": [
            {
                "name": "Listen for XDebug",
                "type": "php",
                "request": "launch",
                "port": 9000,
                "pathMappings": {
                    "/var/www/html": "${workspaceFolder}/src"
                },
            },
            {
                "name": "Launch currently open script",
                "type": "php",
                "request": "launch",
                "program": "${file}",
                "cwd": "${fileDirname}",
                "port": 9000
            }
        ]
    }
    ```
    * get "PHP debug" extension for chrome
    * get the [Xdebug helper](https://chrome.google.com/webstore/detail/xdebug-helper/eadndfjplgieldjbigjakmdgkmoaaaoc) extension 
    * start the debugger by clicking F5 or under the debug extension section (if asked, select the "Listen for XDebug" option)
    * add a breaking point (red dot) in an php file to test if the debugger work

* Troubleshooting
    * Create a php file, like phpinfo.php that can be accessed by loclahost:8000/phpinfo.php, set the content to (open the link):
        ```PHP
        <?= phpinfo() >
        ```
        * find the xdebug header and look if the correct values are set
            * xdebug.remote_port = 9000
            * xdebug.remote_host = host.docker.internal
            * xdebug.remote_enable = on
            * xdebug.idekey = VSCODE
    * In chrome, open this [link](chrome://settings/cookies/detail?site=localhost&search=cookies), if there is a cookie name "XDEBUG_SESSION" then everything is fine, if not, then [Xdebug helper](https://chrome.google.com/webstore/detail/xdebug-helper/eadndfjplgieldjbigjakmdgkmoaaaoc) chrome plugin is not set up correctly or turned on
    * 


### PHP usage
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
    <?php if ($condition) { ?>
        <b>This is true</b>
    <?php } else { ?>
        <b>This is false</b>
    <?php } ?>
    ```
    * Concatenation
    ```PHP
    <?php
    $name = "Edmunds";
    $profession = "programmer";

    echo "Hi, my nam is " . $name . ", I'm a " . $profession;

    // Result: Hi, my nam is Edmunds, I'm a programmer;
    ?>
    ```
* Global arguments
    ```PHP
    $_GET // Data parameters sent via GET request
    $_POST // Data parameters sent via POST request
    $_SESSION // Session stored parameters
    $_SERVER // Server related parameters
    ```
* Passing parameters:
    * with GET (thru URL)
    ```PHP
    http://domain-name.com?param_1=value_1&params_2=value_2
    ```
    * with POST (as request body)
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

* Writing to a file
    ```PHP
    $pointer = fopen($file, "w");
    if(!empty($pointer)){
        fwrite($pointer, $data);
        fclose($pointer);
    } else {
        throw new Exception("Writing to ".$file." failed");
    }
    ```
### Checkup
1. Create an array, loop thru it and print the values to the browser with some extra text for each value
2. Create a form, trigger an action that sends the data to server and returns a modified value
3. Create a script that writes the data you pass as arguments to a file