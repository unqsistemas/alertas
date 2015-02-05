<?php

use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\RoutingServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\HttpFragmentServiceProvider;
use Silex\Provider\DoctrineServiceProvider;
use Symfony\Component\Yaml\Yaml;

$config = Yaml::parse(file_get_contents(__DIR__.'/../config/config.yml'));

$app = new Application();
$app->register(new RoutingServiceProvider());
$app->register(new ServiceControllerServiceProvider());
$app->register(new TwigServiceProvider());
$app->register(new HttpFragmentServiceProvider());
$app->register(new DoctrineServiceProvider(), array('db.options' => $config['database']));

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

$app->register(new Silex\Provider\SecurityServiceProvider(), array(
	'security.encoder.digest' => new Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder('sha512', false, 1),
	'security.firewalls' => array(
		'api' => array(
			'pattern' => '^/',
			'stateless' => true,
			'http' => true,
			'users' => $config['auth'],
		)
	)
));

$app['alerta_manager'] = function ($app) {
	return new Alerta\AlertaManager($app);
};

return $app;
