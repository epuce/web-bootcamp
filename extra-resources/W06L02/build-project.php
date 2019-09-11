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
echo shell_exec("cd ../; npm install --prefix $folderName/extra-resources/W05L02/web").PHP_EOL;
// title('npm start ng server');
// echo shell_exec("cd ../; npm run start --prefix $folderName/extra-resources/W05L02/web").PHP_EOL;
title('ng build');
echo shell_exec("cd ../; npm run dev --prefix $folderName/extra-resources/W05L02/web").PHP_EOL;

echo PHP_EOL;
echo ' *********'.PHP_EOL;
echo ' ALL DONE!'.PHP_EOL;
echo ' *********'.PHP_EOL;