<?php

// router.php
if (preg_match('/^\/api/', $_SERVER["REQUEST_URI"])) {
	$path = $_SERVER["SCRIPT_NAME"];
    require(__DIR__."$path");
} else if (preg_match('/^[^\.]+$/', $_SERVER["REQUEST_URI"])) {
    include(__DIR__."/public/index.html");
} else {
    $path = $_SERVER["REQUEST_URI"];
    include(__DIR__."/public$path");
}


