# 📦 Modern project setup

## Project Structure

* Front-end source folder
  * Usually named as web, front-end, any other self explaining choice
  * If npm is used then there is a node_modules folder, package.json and package-lock.json files
  * The actual front-end source folder, named as components, src, or any other logical naming
    * If using component approach, each has it's own folder that includes html, css, and JS files
  * front-end global assets (helper functions)
  * Compiler files (if needed)

* Back-end source folder
  * Usually named as src
  * All logical parts are split, like controller, models, views, helpers...

* Vendor - if composer package manager is used

* Assets
  * global images
  * global styles
  * global scripts

* Public - the part that is loaded to the browser
  * index file
  * all actively loaded scripts
  * main css file

* Extra-resources
  * Cron jobs
  * Docs

* Build Scripts

* README.md

* .gitignore

* local.config.php or .env files

## Node.js + npm & composer setup

* [Node.js + npm](https://nodejs.org/en/download/) - install the current LTS
  * run `npm init` inside the project directory and walk through the steps (or scaffold a whole
    project directly, e.g. `npm create vite@latest`)
  * add dependencies with `npm install <pkg>`. Most of what jQuery and lodash were used for is now
    native (`fetch`, `map`/`filter`/`reduce`, optional chaining `?.`, spread `...`), so you rarely
    need them.
  * `npm install` reads `package.json`; commit the `package-lock.json` and git-ignore `node_modules/`.

* [Composer](https://getcomposer.org/doc/00-intro.md) - the same idea for PHP dependencies.

## Build tools (bundlers)

Browsers can load ES modules directly, but real apps still bundle: to compile TS/JSX/SCSS, split
code, hash filenames for caching, and tree-shake dead code out.

* **Vite** is the modern default: a dev server with instant hot-module-reload, using `esbuild` and
  `Rollup` under the hood. A minimal setup:

```JavaScript
// vite.config.js
import { defineConfig } from 'vite';

export default defineConfig({
    build: { outDir: 'dist' },
});
```

```JSON
// package.json scripts
{
    "scripts": {
        "dev": "vite",
        "build": "vite build",
        "preview": "vite preview"
    }
}
```

* You will still meet **Webpack** in older projects (a big hand-written `webpack.config.js` with a
  `ProvidePlugin` for jQuery/lodash was the previous standard). Other tools: **esbuild** and
  **Rollup** (great for libraries), **Turbopack** (Next.js). The **Gulp**/**Grunt** task runners are
  legacy.

## Good code style checkup

```CSS
.menu{
 background:grey;
 border-bottom:
 4px solid #fff;   
} .footer .menu:hover{
    display:block;}

    .footer {
position: fixed;
  text-align:right;
left:0; bottom:0;
    }
```

```JavaScript
var az = {
  a       : 0,
  b  : 1,
  lengthyName: 2
};

var zy = [1, 2, 3, 4
,9, 10,
11];

zy.map(function(abc) {
    return 
    abc * 3;
})

Object.keys(az).map((aza) {
    return aza * 3;
})
```

```HTML
<div>
            <center>My heading!</center>
<ul class="ul">
    One<br/>
Two<br>
Three<br>
    <li>Four</li>
    <li>
        Five
    </li>
</ul>
</div>
```
