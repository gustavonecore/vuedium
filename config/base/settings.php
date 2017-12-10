<?php
return [
	'host' => 'http://0.0.0.0:8000/',
	'database' => [
		'dbname' => 'vuedium',
		'user' => 'root',
		'password' => 'root',
		'host' => 'localhost',
		'driver' => 'pdo_mysql',
	],
	'paths' => [
		'logfile' => __DIR__ . '/../../log/leftaro.log',
		'views' => __DIR__ . '/../../resource/views/',
		'views_cache' => __DIR__ . '/../../resource/cache/',
	],
	'middlewares' => [
		'before' => [
			\Leftaro\Core\Middleware\RouteMiddleware::class,
			\Leftaro\App\Middleware\BodyParserMiddleware::class,
			\Leftaro\App\Middleware\InflatorsMiddleware::class,
			\Leftaro\App\Middleware\AuthMiddleware::class,
		],
		'after' => [
			\Leftaro\App\Middleware\LoggerMiddleware::class,
		],
	],
	'command_namespaces' => [
		'Leftaro\\App\\Command\\',
		'Leftaro\\App\\Command\\Post\\',
	]
];