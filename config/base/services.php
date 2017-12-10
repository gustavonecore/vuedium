<?php

use DI\Container;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Configuration;
use FastRoute\Dispatcher;
use Interop\Container\ContainerInterface;
use Leftaro\App\Hex\ClassNameExtractor;
use Leftaro\App\Hex\CommandBus;
use League\Tactician\Handler\CommandHandlerMiddleware;
use League\Tactician\Handler\Locator\CallableLocator;
use League\Tactician\Handler\MethodNameInflector\HandleInflector;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Noodlehaus\Config;
use Psr\Log\LoggerInterface;

return [
	'config' => function ()
	{
        return new Config(__DIR__ . '/settings.php');
	},

	Config::class => function (ContainerInterface $container)
	{
		return $container->get('config');
	},

	Logger::class => function (ContainerInterface $container)
	{
		$log = new Logger('leftaro');
		$log->pushHandler(new StreamHandler($container->get('config')->get('paths.logfile'), Logger::DEBUG));
		return $log;
	},

	LoggerInterface::class => function (ContainerInterface $container)
	{
		return $container->get(Logger::class);
	},

	'logger' => function (ContainerInterface $container)
	{
		return $container->get(Logger::class);
	},

	Dispatcher::class => function (ContainerInterface $container)
	{
		return FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) use ($container)
		{
			foreach (require_once __DIR__ . '/routes.php' as $route)
			{
				list($method, $endpoint, $handlerClass, $handlerMethod) = $route;

				$r->addRoute(strtoupper($method), $endpoint, $handlerClass . '::' . $handlerMethod);
			}
		});
	},

	'twig' => function (ContainerInterface $container)
	{
		$loader = new Twig_Loader_Filesystem($container->get('config')->get('paths.views'));

		return new Twig_Environment($loader,
		[
			'cache' => $container->get('config')->get('paths.views_cache'),
		]);
	},

	Container::class => function(ContainerInterface $container)
	{
		return $container;
	},

	'database' => function(ContainerInterface $container)
	{
		return DriverManager::getConnection($container->get('config')->get('database'), new Configuration());
	},

	'dispatcher' => function(ContainerInterface $container)
	{
		return $container->get(Dispatcher::class);
	},

	'command_handler_middleware' => function($container)
	{
		return new CommandHandlerMiddleware(
			new ClassNameExtractor,
			new CallableLocator(function($className) use ($container)
			{
				$handler = $container->make(str_replace('Command', 'Handler', $className));

				if ($handler instanceof LoggerAwareInterface)
				{
					$handler->setLogger($container->get('logger'));
				}

				return $handler;
			}),
			new HandleInflector
		);
	},

	CommandBus::class => function(ContainerInterface $container)
	{
		return $container->get('bus');
	},

	'bus' => function(ContainerInterface $container)
	{
		return new CommandBus([$container->get('command_handler_middleware')], $container);
	},
];