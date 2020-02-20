### PHP session and other security methods
* PHP session
    * Is set up on the system level
    * Can be manipulated (restarted, paused, data destroyed, etc.)
```PHP
<?php
session_start(); // Start PHP session (introduce the $_SESSION variable)
$_SESSION; // PHP session variable (object)

$_SESSION['user_id'] = 12;
// Any data can bes stored under $_SESSION variable

session_abort(); // Remove all variables set up for the session, finish the session
```
```PHP
// Creating PHP session timeout, if user has not been active for 10min, on next request the session will be terminated
<?php
$start_time = $_SERVER['REQUEST_TIME'];

if (isset($_SESSION['LAST_ACTIVE']) && ($start_time - $_SESSION['LAST_ACTIVE']) > 600) {
    session_abort();
}

// Update (or set) LAST_ACTIVE session variable on action
$_SESSION['LAST_ACTIVE'] = $start_time;
```
[Full list of session functions](https://www.php.net/manual/en/ref.session.php)
* tokens
    * Some kind of identifier that is not tied to the PHP session, if a valid token is passed to the request, access to data is granted
    * This token is created on login or by the system owner and it's stored in the database. As long as the token in valid (exists in database, has an access granted field active)
    * Tokens can be not user specific
    ```PHP
    // localhost:8000/users/edit/1?accessToken=df07c6fb-7d0d-493f-b87f-efc4319b5ab6 // UUID token
    ```
* roles
    * Database field that holds the roles
    ```javascript
    ['ROLE_USER_EDIT', 'ROLE_USER_VIEW', 'ROLE_USER_DELETE']
    ```
* Hashing 
    * Used for hidden data, that has to be understandable when referred to a string
    
    * PHP built in
    ```PHP
    <?php
    echo password_hash('root_password', PASSWORD_DEFAULT);
    
    // Save the hash to database
    // When user inputs the string, get the hash and compare with string
    $hash = $db->execute('SELECT password FROM users WHERE id=1');
    
    if (password_verify('root_password', $hash)) {
        echo 'Password is valid!';
    } else {
        echo 'Invalid password.';
    }
    ```
    * Bcrypt
    ```PHP
    <?php
    $bcrypt = new Bcrypt(10);
      
    $bcrypt->hash('root_password'); // Save to database
    $hash = ''; // Get from database
    $bcrypt->verify('root_password', $hash); // Compare when logging in
    ```
    * MD5 - usually used for multiple field hashing
    ```PHP
    <?php
    // Binary compare
    $name = 'Ed';
    $surname = 'Puce';
    $birthDay = '11.11.2011';
  
    $hash = md5($name . $surname . $birthDay);
    ```
    * Others
        * PHPASS
        * PasswordLib
        * Zend
        * Crypt
        * etc.
* Salt
    * Used to manipulate readable data to be harder to crack
    * Static salt - always the same
    * Dynamic salt - can changed on conditions, the salted data has to be regenerated if salt changes
    ```PHP
    <?php
    $password = "root_password";
    $salt = 'S-@/l*tt';
  
    $saltedPassword = $password . $salt;
    ```
* CSRF token
    * Cross-site request forgery
    * As it is possible to trigger cross site requests, this is the way we secure our self from actions like these.
```PHP
// helper function to generate the token
<?php
function getToken($length) { 
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
    $randomString = ''; 
  
    for ($i = 0; $i < $length; $i++) { 
        $index = rand(0, strlen($characters) - 1); 
        $randomString .= $characters[$index]; 
    } 
  
    return $randomString; 
};
  
session_start();
$_SESSION['token'] = getToken(16);
$token = $_SESSION['token'];

echo "<form action=\"action.php\">";
echo "<input type=\"text\" name=\"new_password\"";
echo "<input type=\"text\" name=\"token\" value=\"<?=$token?>\"/>";
echo "<button type=\"submit\">Reset Password</button>";
echo "</form>";


// action.php
if ($_SESSION['token'] == $_POST['token']) {
    // Valid token, execute the function
    // Delete or reset the token
} else {
    // Don't allow the action
    // If needed, investigate the attack
}
``` 
### Task (Done together)
1. Create user table that stores username and password and a third field (or edit existing one, to match the structure)
2. Add a from that saves a new user, salt the password and save it hashed
3. Add a login form, that checks the username and password match
4. If User password match
    * start a new session
    * set up a flag that can be used for user tracking (like user ID)
    * create a page that can be accessed only if a user is logged in, show the third field associated with the user in this page
    * add a possibility to logout (end the session)
5. Create a page that is accessible only if a valid token has been passed