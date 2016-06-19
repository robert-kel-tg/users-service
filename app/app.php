<?php

$app = new Silex\Application();

$app->register(new Silex\Provider\ServiceControllerServiceProvider());
$app->register(new Robertke\User\Infrastructure\ControllerServiceProvider());

require_once __DIR__ . '/../config/routes.php';

return $app;