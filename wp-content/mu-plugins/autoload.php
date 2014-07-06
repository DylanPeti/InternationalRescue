<?php

require_once __DIR__.'/UniversalClassLoader.php';

use Symfony\Component\ClassLoader\UniversalClassLoader;

$loader = new UniversalClassLoader();
$loader->registerNamespace('Models', __DIR__);
$loader->register();
