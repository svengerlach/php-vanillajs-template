<?php

require_once __DIR__ . '/../vendor/autoload.php';

$compiler = new \Svengerlach\VanillaJSTemplate\Compiler();

$template = '<h1>Hello, <%= foo %>!</h1>';
$templateCompiled = $compiler->compile($template);

?>
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
