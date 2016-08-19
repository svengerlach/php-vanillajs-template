<?php

require_once __DIR__ . '/../vendor/autoload.php';

$loader = new \Twig_Loader_Filesystem([__DIR__]);
$twig = new \Twig_Environment($loader);

$compiler = new \Svengerlach\VanillaJSTemplate\Compiler();
$extension = new \Svengerlach\VanillaJSTemplate\TwigExtension($compiler);

$twig->addExtension($extension);

echo $twig->render('twigextension.html.twig');