<?php

$app = new Silex\Application();
$app->register(new Silex\Provider\ServiceControllerServiceProvider());
$app->register(new Robertke\User\Infrastructure\ControllerServiceProvider());
//$app->register(new Silex\Provider\DoctrineServiceProvider(), [
////    'db.options' => [
////        'driver' => 'pdo_pgsql',
////        'host' => '172.17.0.2',
////        'port' => '5432',
////        'dbname' => 'dbname',
////        'user' => 'dbuser',
////        'password' => 'dbuserpass'
////    ],
//    'db.options' => [
//        'driver' => 'pdo_mysql',
//        'host' => 'mysql',
//        'port' => '3306',
//        'dbname' => 'demoDb',
//        'user' => 'demoUser',
//        'password' => 'demoPass'
//    ]
//]);

$app->register(new Robertke\User\Infrastructure\Persistence\Doctrine\DoctrineServiceProvider(), [
    'driver' => 'pdo_mysql',
    'host' => 'mysql',
    'port' => '3306',
    'dbname' => 'demoDb',
    'user' => 'demoUser',
    'password' => 'demoPass'
]);
$app->register(new Robertke\User\Infrastructure\HandlerServiceProvider());
$app->register(new Robertke\User\Infrastructure\CommandBusServiceProvider());

//$app->before(function (Symfony\Component\HttpFoundation\Request $request) {
//    if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
//        $data = json_decode($request->getContent(), true);
//        $request->request->replace(is_array($data) ? $data : []);
//    }
//});

$app->register(new JDesrosiers\Silex\Provider\JmsSerializerServiceProvider(), [
    "serializer.srcDir" => __DIR__ . "/vendor/jms/serializer/src",
]);

//$app->register(new EasyBib\Service\Elastica\ElasticSearchServiceProvider(), [
//    'elastic.client_options' => [
//        'host' => 'localhost',
//        'port' => 9200,
//    ],
//]);

require_once __DIR__ . '/../config/routes.php';

return $app;