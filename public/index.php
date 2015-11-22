<?php

// Ignore requests for static files through cli-server sapi
if (php_sapi_name() === 'cli-server'
    && is_file(realpath(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)))
) {
    return false;
}

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

use Zend\Expressive\AppFactory;
use Zend\ServiceManager\Config;
use Zend\ServiceManager\ServiceManager;

$config = require 'config/config.php';
$container = new ServiceManager(new Config($config['dependencies']));
$container->setService('config', $config);

$app = $container->get('Zend\Expressive\Application');
$app->run();

