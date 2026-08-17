<?
use CRUD\entity\User;
session_start();

if ($_SESSION['user_id']) {
    header("Location: /CRUD/"); // Will return to index page if logged in (nothing else will be executed in this file)
}

if (isset($_POST['submit'])) {
    if ($_SESSION['csftToken'] !== $_POST['csftToken']) {
        echo "What a hacker";
        return;
    }

    require_once "./helpers/database-wrapper.php";    
    require_once "./entity/User.php";    
    $name = $_POST["name"];
    $response = DB::run("SELECT * FROM users WHERE name='$name'");

    if (!$response->num_rows) {
        echo "User does not exist";
    } else {
        /** $user User */
        while ($row = mysqli_fetch_assoc($response)) {
            $user = new User($row);
        }
    
        $saltedPassword = $_POST["password"] . $user::SALT;
        $validPassword = password_verify($saltedPassword, $user->getPassword());
    
        if ($validPassword) {
            $_SESSION['user_id'] = $user->getId();
            $_SESSION['user_name'] = $_POST["name"];
            header("Location: /CRUD/");
        } else {
            // echo "Invalid password";
        }
    }
} else {
    $token = getToken(10);
    $_SESSION['csftToken'] = $token;
}

function getToken($length) { 
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
    $randomString = ''; 
  
    for ($i = 0; $i < $length; $i++) { 
        $index = rand(0, strlen($characters) - 1); 
        $randomString .= $characters[$index]; 
    } 
  
    return $randomString; 
};
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — web-bootcamp CRUD</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
          crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/bootcamp-theme.css">
</head>
<body>
    <main class="bc-shell" style="max-width:420px;min-height:100vh;display:flex;flex-direction:column;justify-content:center">
        <div class="bc-brand" style="justify-content:center;margin-bottom:20px">
            <span class="mark">&lt;/&gt;</span>
            <span>web-bootcamp<small>CRUD login</small></span>
        </div>
        <div class="bc-card">
            <h1 style="font-size:1.5rem;margin:0 0 4px">Welcome back</h1>
            <p class="bc-muted" style="margin:0 0 22px;font-size:.95rem">Sign in to edit the users list.</p>
            <form action="/CRUD/login.php" method="post">
                <label class="bc-field">
                    <span>Name</span>
                    <input class="form-control" name="name" autocomplete="username">
                </label>
                <label class="bc-field">
                    <span>Password</span>
                    <input class="form-control" type="password" name="password" autocomplete="current-password">
                </label>

                <!-- Add hidden token field -->
                <input name="csftToken" value="<?= $token ?>" hidden>
                <!-- ---- -->

                <button class="btn btn-primary" type="submit" name="submit" style="width:100%;justify-content:center;margin-top:6px">Login (PHP)</button>
            </form>
        </div>
        <p style="text-align:center;margin-top:20px"><a href="/CRUD">← Back to users</a></p>
    </main>
</body>
</html>