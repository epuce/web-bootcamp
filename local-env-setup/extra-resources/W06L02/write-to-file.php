<?php

$file = fopen("file.txt", 'w+');

fwrite($file, $argv[1]);

fclose($file);
