<?php

$files = scandir('./');

$readme = fopen('./README.md', 'w');


fwrite($readme, '# Course structure' . PHP_EOL . PHP_EOL);
foreach ($files as $file) {
    if (preg_match('/[\.md]d+$/', $file) && $file !== 'README.md') {
        $title = trim($file, '.md');

        fwrite($readme, '* [' . $title . '](' . str_replace(' ', '&#32;', $file) . ')' . PHP_EOL);
    }
}
fclose($readme);
