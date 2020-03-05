<!-- TODO add a short questions/answer summary -->
### css animations 

### Project Structure
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

### Node.js + npm & composer setup
* [Node.js + npm](https://nodejs.org/en/download/)
  * run "npm init" inside project directory and walk thru the steps
  * add some dependencies (jQuery, lodash, request)
  * Set up webpack compiler, add different scripts
  
* [Composer](https://getcomposer.org/doc/00-intro.md)

### Compilers
* Webpack
```JavaScript
var path = require('path');
var webpack = require('webpack');
var merge = require('webpack-merge');

var PROD = process.env.NODE_ENV === 'production';

var common = {
    entry: {
        'node-modules.min': [
            './node_modules/jquery/dist/jquery.min.js',
            './node_modules/other/plugin-file-nr1.js',
            './node_modules/other/plugin-file-nr2.js',
        ],
        'main.min': [
            'path-to-js-file-nr1.js',
            'path-to-js-file-nr2.js',
            'path-to-js-file-nr3.js',
        ]
    },
    output: {
        path: path.resolve(__dirname, 'path/to/public/folder')
    },
    plugins: [
        new webpack.ProvidePlugin({
            $: "jquery",
            jQuery: "jquery",
            _: 'lodash'
        }),
    ],
    module: {
        rules: [
            {
                // HTML LOADER
                // Reference: https://github.com/webpack/raw-loader
                // Allow loading html through js
                test: /\.html$/,
                use: 'raw-loader'
            }
        ]
    }
};

if (process.env.NODE_ENV === 'production') {
    module.exports = merge(common, {
        mode: 'production',

        optimization: {
            minimize: true
        },

        stats: {
            warnings: false
        }
    });
} else if (process.env.NODE_ENV === 'watch') {
    module.exports = merge(common, {
        mode: 'development',

        watch: true
    });
} else {
    module.exports = merge(common, {
        mode: 'development'
    });
}
```

* Alternatives
  * Gulp
  * Grunt
  * etc.

### Good code style checkup
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

