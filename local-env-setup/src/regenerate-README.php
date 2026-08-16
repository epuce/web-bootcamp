<?php

// Regenerates the root README.md course index from the lesson Markdown files.
// Run from the repository root:  php local-env-setup/src/regenerate-README.php
// (the CI workflow does exactly this on every push).

// Human-friendly theme per week; weeks without an entry fall back to "Week N".
$weekThemes = [
    '01' => 'Foundations & setup',
    '02' => 'CSS',
    '03' => 'JavaScript',
    '04' => 'SQL & PHP',
    '05' => 'PHP application patterns',
    '06' => 'Back-end, APIs & deployment',
    '07' => 'Front-end frameworks',
    '08' => 'Wrap-up',
];

$files = scandir('./');
sort($files);

$weeks = [];   // week => list of [lesson label, topic, file]
$extras = [];  // list of [topic, file]

foreach ($files as $file) {
    if (preg_match('/\.md$/', $file) !== 1 || $file === 'README.md') {
        continue;
    }

    $title = basename($file, '.md');

    if (preg_match('/^W(\d+)L(\d+) - (.*)$/', $title, $m) !== 1) {
        continue;
    }

    [, $week, $lesson, $topic] = $m;

    // "(extra topic) X" / "(... task) X" lessons are grouped on their own.
    if (preg_match('/^\(.*?\)\s*(.*)$/', $topic, $t) === 1) {
        $extras[] = [$t[1], $file];
    } else {
        $weeks[$week][] = ['L' . $lesson, $topic, $file];
    }
}

ksort($weeks);

$readme = fopen('./README.md', 'w');

fwrite($readme, '# 🎓 Web Bootcamp' . PHP_EOL . PHP_EOL);
fwrite($readme, 'A full-stack web development course — from the first line of HTML to a deployed app, week by week.' . PHP_EOL . PHP_EOL);
fwrite($readme, '## 📚 Course structure' . PHP_EOL . PHP_EOL);

foreach ($weeks as $week => $lessons) {
    $theme = $weekThemes[$week] ?? '';
    $heading = 'Week ' . (int) $week . ($theme !== '' ? ' — ' . $theme : '');

    fwrite($readme, '### ' . $heading . PHP_EOL . PHP_EOL);
    fwrite($readme, '| # | Lesson |' . PHP_EOL);
    fwrite($readme, '| --- | --- |' . PHP_EOL);

    foreach ($lessons as [$lesson, $topic, $file]) {
        // rawurlencode keeps the link valid for filenames containing spaces,
        // "&" and parentheses, which a bare space replacement would break.
        fwrite($readme, '| ' . $lesson . ' | [' . $topic . '](' . rawurlencode($file) . ') |' . PHP_EOL);
    }

    fwrite($readme, PHP_EOL);
}

if (!empty($extras)) {
    fwrite($readme, '### ✨ Extra topics' . PHP_EOL . PHP_EOL);
    fwrite($readme, '| Lesson |' . PHP_EOL);
    fwrite($readme, '| --- |' . PHP_EOL);

    foreach ($extras as [$topic, $file]) {
        fwrite($readme, '| [' . $topic . '](' . rawurlencode($file) . ') |' . PHP_EOL);
    }

    fwrite($readme, PHP_EOL);
}

fclose($readme);
