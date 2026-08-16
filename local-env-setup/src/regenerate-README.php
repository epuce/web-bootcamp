<?php

// Regenerates the root README.md course index from the lesson Markdown files.
// Run from the repository root:  php local-env-setup/src/regenerate-README.php
// (the CI workflow does exactly this on every push).

$files = scandir('./');
sort($files);

$readme = fopen('./README.md', 'w');

fwrite($readme, '# Course structure' . PHP_EOL . PHP_EOL);
foreach ($files as $file) {
    if (preg_match('/\.md$/', $file) === 1 && $file !== 'README.md') {
        $title = basename($file, '.md');

        // rawurlencode keeps the link valid for filenames containing spaces,
        // "&" and parentheses (e.g. the "(extra topic)" lessons), which a
        // bare space replacement would leave broken on GitHub.
        fwrite($readme, '* [' . $title . '](' . rawurlencode($file) . ')' . PHP_EOL);
    }
}
fclose($readme);
