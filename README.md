# PHP VanillaJS Template

[![Build Status](https://travis-ci.org/svengerlach/php-vanillajs-template.svg?branch=master)](https://travis-ci.org/svengerlach/php-vanillajs-template)

A small port of [John Resig's JavaScript micro templating approach](http://ejohn.org/blog/javascript-micro-templating/) to PHP for server-side pre-compilation of simple JavaScript templates.

## Background

I've used John Resig's approach a lot in the passed. It's small, easy to use and comes with zero dependencies. I like it!

However, this method has one simple drawback: 

If your application has set the `Content-Security-Policy` HTTP header for `script-src` to e.g. `self`, you will run into problems. 

Google Chrome rejects the execution of the templating function with the following error message: 

> Uncaught EvalError: Refused to evaluate a string as JavaScript because 'unsafe-eval' is not an allowed source of script in the following Content Security Policy directive: "script-src 'self'"

**Workarounds?** 

1. Allow `unsafe-eval` as `script-src` within the Content-Security-Policy header
2. Implement a workaround that pre-compiles templates to executable JavaScript functions

The first is not an option because it forces us to lower the security barriers. 

I've opted for the second approach. Because most of my projects are PHP applications, I've decided to port John Resig's template conversion to PHP.

## Installation

Installation is recommended to be done via [composer](https://getcomposer.org/) by running: 

```sh
composer require svengerlach/php-vanillajs-template
```

## Usage

This library can be used either as a standalone component or as a [twig](http://twig.sensiolabs.org/) extension.

### Standalone usage

See [examples/standalone.php](examples/standalone.php).

```php
<?php

$compiler = new \Svengerlach\VanillaJSTemplate\Compiler();

$template = '<h1>Hello, <%= foo %>!</h1>';
$templateCompiled = $compiler->compile($template);
```

```html
<!DOCTYPE html>
<html>
    <body>
        <!-- will contain "Hello, World!" -->
        <div id="template_container">loading...</div>
        
        <script>
        var templateFunction = <?= $templateCompiled; ?>;
        document.getElementById('template_container').innerHTML = templateFunction({ foo: 'World' });
        </script>
    </body>
</html>
```