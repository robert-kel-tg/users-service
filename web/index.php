<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../app/app.php';

$app->run();


//
//$app->get('/hello/{name}', function ($name) use ($app) {
//	    return 'Hello '.$app->escape($name);
//});
//
//$app->run();

