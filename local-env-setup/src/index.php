<?php

// Minimal front router for the PHP examples served by the Apache container.
// Real projects use a framework router (Slim, Laravel, Symfony); this stays tiny
// on purpose so the examples are reachable at http://localhost:8000/.

$uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);

switch (true) {
    case $uri === '/' || $uri === '':
        echo '<h1>web-bootcamp examples</h1>';
        echo '<p>Try <a href="/CRUD">/CRUD</a>.</p>';
        break;

    case $uri === '/CRUD' || $uri === '/CRUD/':
        require __DIR__ . '/examples/CRUD/controllers/index.php';
        break;

    case $uri === '/CRUD/add' || $uri === '/CRUD/add/':
        require __DIR__ . '/examples/CRUD/controllers/add.php';
        break;

    default:
        http_response_code(404);
        echo "<h1 style='text-align: center'>404: " . htmlspecialchars($uri) . " not found</h1>";
        break;
}
