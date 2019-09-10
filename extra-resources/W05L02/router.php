<?php

// router.php
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