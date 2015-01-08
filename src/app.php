<?php

use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\RoutingServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\HttpFragmentServiceProvider;
use Silex\Provider\DoctrineServiceProvider;

$app = new Application();
$app->register(new RoutingServiceProvider());
$app->register(new ServiceControllerServiceProvider());
$app->register(new TwigServiceProvider());
$app->register(new HttpFragmentServiceProvider());

$app->register(new DoctrineServiceProvider(), array(
    'db.options' => array(
        'driver'        => 'pdo_mysql',
        'host'          => 'localhost',
        'dbname'        => 'alertas',
        'user'          => 'root',
        'password'      => 'root',
    )
));

$app->register(new Dflydev\Provider\DoctrineOrm\DoctrineOrmServiceProvider, array(
    "orm.proxies_dir" => __DIR__.'/../var/cache/doctrine/',
    "orm.em.options" => array(
        "mappings" => array(
            array(
                "type" => "annotation",
                "namespace" => "Entity",
                "path" => __DIR__."/Entity"
            )
        )
    )
));

$app['alerta_manager'] = function ($app) {
    return new Alerta\AlertaManager($app);
};

return $app;
