<?php namespace Leftaro\App;

use Exception;
use Leftaro\Core\Application as LeftaroApplication;
use Leftaro\Core\Exception\NotFoundException;
use Propel\Runtime\Propel;
use Propel\Runtime\Connection\ConnectionManagerSingle;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use RuntimeException;
use Zend\Diactoros\Response\{
	JsonResponse,
	TextResponse,
	HtmlResponse,
	RedirectResponse
};

class Application extends LeftaroApplication
{
	/**
	 * @var bool  Flag to determine if the main application was properly loaded
	 */
	protected $autoLoad;

	/**
	 * {@inheritDoc}
	 */
	public function __construct(ContainerInterface $container)
	{
		parent::__construct($container);

		$this->autoLoad = true;
	}


	/**
	 * Override error handling method
	 *
     * {@inheritDoc}
     */
    protected function handleException(Exception $e, RequestInterface $request) : ResponseInterface
    {
		if ($e instanceof NotFoundException)
		{
			if ($e->getRequest()->getAttribute('is_ajax') === true)
			{
				return new JsonResponse([
					'error' => 'Resource not found',
					'description' => 'The requested resource ' . $e->getRequest()->getUri()->getPAth() . ' was not found',
				], 404);
			}

			return new HtmlResponse($this->container->get('twig')->render('error/404.twig', [
				'title' => 'Page not found',
				'description' => 'The requested page "' . $e->getRequest()->getUri()->getPAth() . '" was not found',
			]), 404);
		}

        return parent::handleException($e, $request);
    }

	/**
	 * Load the orm classes using the configuration values
	 * This should run after the main application was loaded
	 *
	 * @return void
	 */
	public function loadOrm()
	{
		if ($this->autoLoad !== true)
		{
			throw new RuntimeException('Application it\'s not loaded yet!');
		}

		$config = $this->container->get('config');

		$serviceContainer = Propel::getServiceContainer();
		$serviceContainer->checkVersion('2.0.0-dev');
		$serviceContainer->setAdapterClass('default', 'mysql');
		$manager = new ConnectionManagerSingle();
		$manager->setConfiguration(
			[
				'dsn' => 'mysql:host=localhost;port=3306;dbname=' . $config->get('database.dbname'),
				'user' => $config->get('database.user'),
				'password' => $config->get('database.password'),
				'settings' =>
				[
					[
						'charset' => 'utf8',
						'queries' => [],
					],
					'classname' => '\\Propel\\Runtime\\Connection\\ConnectionWrapper',
					'model_paths' =>
					[
						0 => 'src',
						1 => 'vendor',
					],
				]
			]
		);

		$manager->setName('default');
		$serviceContainer->setConnectionManager('default', $manager);
		$serviceContainer->setDefaultDatasource('default');
	}
}