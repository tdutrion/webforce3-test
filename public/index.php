<?php

// define the current working directory to the current folder
chdir(__DIR__);

// decline static file requests back to the PHP built-in webserver
if (php_sapi_name() === 'cli-server') {
    $path = realpath(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    if (__FILE__ !== $path && is_file($path)) {
        return false;
    }
    unset($path);
}

// autoload classes and functions using composer
require '../vendor/autoload.php';

// configuration
$wConfig = require('../config/config.php');
if (is_file('../config/config.local.php')) {
    $localConf = require('../config/config.local.php');
    if (is_array($localConf)) {
        $wConfig = array_merge($wConfig, $localConf);
    }
}
$wRoutes = require('../config/routes.php');

// create the application based on the given configuration
$app = new W\App($wRoutes, $wConfig);

// run the application
$app->run();
