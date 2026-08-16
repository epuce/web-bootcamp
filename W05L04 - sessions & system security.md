# 🔐 sessions & system security

## PHP session and other security methods

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
* Password hashing
    * Never store passwords in plain text, and never "encrypt" them (encryption is reversible). Store a
      one-way **hash**.
    * Use PHP's built-in `password_hash()` / `password_verify()`. They pick a strong algorithm (bcrypt by
      default, Argon2id available) and **generate and store a unique random salt for you**, so you never
      manage salts by hand.
    ```PHP
    <?php
    // On registration: hash and store the result (a 60+ char string that already includes the salt)
    $hash = password_hash($plainPassword, PASSWORD_DEFAULT);      // or PASSWORD_ARGON2ID
    // INSERT INTO users (username, password) VALUES (?, ?)   with [$username, $hash]

    // On login: fetch the stored hash for that user, then verify
    if (password_verify($plainPassword, $storedHash)) {
        echo 'Password is valid!';
        // Optionally upgrade the stored hash if the default cost/algorithm has since changed
        if (password_needs_rehash($storedHash, PASSWORD_DEFAULT)) {
            // re-hash $plainPassword and update the row
        }
    } else {
        echo 'Invalid password.';
    }
    ```
    * **Do NOT** roll your own scheme: MD5/SHA-1 are broken for passwords, and hand-made "static salts"
      (`$password . 'S-@/l*tt'`) are exactly what `password_hash()` was built to replace. Finding them in
      old code is a bug to fix, not a pattern to copy.
* CSRF token
    * Cross-site request forgery: another site tricks the logged-in user's browser into POSTing to your
      app. A secret token that only your page knows, checked on every state-changing request, stops it.
    * Generate it from a **cryptographically secure** source (`random_bytes`, not `rand`), and compare
      with **`hash_equals`** (constant-time, so it does not leak the answer through timing).

```PHP
<?php
session_start();

// Generate once per session (or per form)
if (empty($_SESSION['csrf'])) {
    $_SESSION['csrf'] = bin2hex(random_bytes(32));
}
$token = $_SESSION['csrf'];
?>
<form action="action.php" method="post">
    <input type="password" name="new_password">
    <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
    <button type="submit">Reset Password</button>
</form>
```

```PHP
// action.php
session_start();
if (isset($_POST['token']) && hash_equals($_SESSION['csrf'], $_POST['token'])) {
    // Valid token: execute the action, then rotate the token
} else {
    http_response_code(403); // reject the request
}
```

## Task (Done together)

1. Create user table that stores username and password and a third field (or edit existing one, to match the structure)
2. Add a form that saves a new user, hashing the password with password_hash() (it salts automatically)
3. Add a login form, that checks the username and password match
4. If User password match
    * start a new session
    * set up a flag that can be used for user tracking (like user ID)
    * create a page that can be accessed only if a user is logged in, show the third field associated with the user in this page
    * add a possibility to logout (end the session)
5. Create a page that is accessible only if a valid token has been passed