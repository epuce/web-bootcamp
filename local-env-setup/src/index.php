<?php

// Minimal front router for the PHP examples served by the Apache container.
// Real projects use a framework router (Slim, Laravel, Symfony); this stays tiny
// on purpose so the examples are reachable at http://localhost:8000/.

$uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);

switch (true) {
    case $uri === '/' || $uri === '':
        renderHome();
        break;

    case $uri === '/CRUD' || $uri === '/CRUD/':
        require __DIR__ . '/examples/CRUD/controllers/index.php';
        break;

    case $uri === '/CRUD/add' || $uri === '/CRUD/add/':
        require __DIR__ . '/examples/CRUD/controllers/add.php';
        break;

    default:
        http_response_code(404);
        renderNotFound($uri);
        break;
}

/**
 * The landing page — an on-brand index of the runnable examples.
 * Kept in one function so the router above stays a thin dispatch table.
 */
function renderHome()
{
    $examples = [
        [
            'href'  => '/CRUD',
            'icon'  => '🗂️',
            'accent' => 'var(--accent)',
            'title' => 'CRUD app',
            'desc'  => 'PHP + MySQL: create, read, update and delete users, with a login and a jQuery-powered delete.',
            'tags'  => ['PHP', 'MySQL', 'jQuery'],
        ],
        [
            'href'  => '/grid.html',
            'icon'  => '🧩',
            'accent' => 'var(--cyan)',
            'title' => 'CSS grid checkup',
            'desc'  => 'The target layout for the Week 2 grid exercise — seven items across five columns and four rows.',
            'tags'  => ['CSS', 'Grid'],
        ],
        [
            'href'  => '/examples/localStorage/index.html',
            'icon'  => '💾',
            'accent' => 'var(--emerald)',
            'title' => 'localStorage users',
            'desc'  => 'A form and table that persist to the browser — validation, edit and delete without a server.',
            'tags'  => ['JavaScript', 'DOM', 'localStorage'],
        ],
    ];

    renderShellStart('web-bootcamp examples');
    ?>
    <header class="bc-header">
        <div class="bc-brand">
            <span class="mark">&lt;/&gt;</span>
            <span>web-bootcamp<small>local examples</small></span>
        </div>
        <a class="bc-btn bc-btn--ghost" href="https://github.com/epuce/web-bootcamp" target="_blank" rel="noopener">Course on GitHub →</a>
    </header>

    <p class="bc-eyebrow">Full-stack web development</p>
    <h1 style="font-size:clamp(2rem,5vw,3rem);margin:6px 0 10px">Runnable examples</h1>
    <p class="bc-muted" style="max-width:44rem;margin:0 0 30px;font-size:1.05rem">
        Live demos that go with the lessons. Everything here runs inside the Docker container from
        <code>local-env-setup</code> — open one to poke at the code behind it.
    </p>

    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:18px">
        <?php foreach ($examples as $ex) { ?>
            <a class="bc-card ex-card" href="<?= htmlspecialchars($ex['href']) ?>" style="--card-accent:<?= $ex['accent'] ?>">
                <span class="ex-card__icon"><?= $ex['icon'] ?></span>
                <h3 class="ex-card__title"><?= htmlspecialchars($ex['title']) ?></h3>
                <p class="bc-muted" style="margin:0 0 14px;font-size:.95rem;line-height:1.55"><?= htmlspecialchars($ex['desc']) ?></p>
                <span class="ex-card__tags">
                    <?php foreach ($ex['tags'] as $tag) { ?><em><?= htmlspecialchars($tag) ?></em><?php } ?>
                </span>
            </a>
        <?php } ?>
    </div>

    <p class="bc-foot">Built for the <b>web-bootcamp</b> course.</p>
    <?php
    renderShellEnd();
}

function renderNotFound($uri)
{
    renderShellStart('404 — not found');
    ?>
    <div style="min-height:60vh;display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center">
        <p class="bc-eyebrow" style="color:var(--danger)">Error 404</p>
        <h1 style="font-size:clamp(2.4rem,7vw,4rem);margin:8px 0"><?= htmlspecialchars($uri) ?></h1>
        <p class="bc-muted" style="max-width:30rem">That page isn't part of the examples. Head back to the index and pick one from there.</p>
        <a class="bc-btn bc-btn--primary" style="margin-top:18px" href="/">← Back to examples</a>
    </div>
    <?php
    renderShellEnd();
}

function renderShellStart($title)
{
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?> — web-bootcamp</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/bootcamp-theme.css">
    <style>
        .ex-card { display:block; text-decoration:none; color:inherit; position:relative;
                   transition:transform .18s ease, border-color .18s ease, box-shadow .18s ease; overflow:hidden; }
        .ex-card::before { content:""; position:absolute; inset:0 0 auto 0; height:3px; background:var(--card-accent); opacity:.9; }
        .ex-card:hover { transform:translateY(-4px); border-color:color-mix(in srgb, var(--card-accent) 55%, transparent);
                         box-shadow:0 16px 40px rgba(0,0,0,.4); }
        .ex-card__icon { font-size:1.9rem; display:block; margin-bottom:12px; }
        .ex-card__title { margin:0 0 8px; font-size:1.25rem; }
        .ex-card__tags { display:flex; flex-wrap:wrap; gap:7px; }
        .ex-card__tags em { font-style:normal; font-size:12px; font-weight:600; padding:4px 10px; border-radius:999px;
                            background:rgba(255,255,255,.05); border:1px solid var(--border); color:var(--muted); }
        code { font-family:var(--mono); font-size:.9em; background:rgba(255,255,255,.06); padding:2px 6px; border-radius:6px; color:var(--accent-text); }
    </style>
</head>
<body>
    <main class="bc-shell">
    <?php
}

function renderShellEnd()
{
    ?>
    </main>
</body>
</html>
    <?php
}
