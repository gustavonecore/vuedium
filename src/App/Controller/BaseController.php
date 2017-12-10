<?php namespace Leftaro\App\Controller;

use DI\Container;
use Gcore\Sanitizer\Template\TemplateSanitizer;
use Gcore\Sanitizer\Template\TemplateInterface;
use Leftaro\Core\Controller\AbstractController;
use Leftaro\App\Exception\MissingParameterException;
use Leftaro\App\Exception\InvalidTokenException;
use Leftaro\App\Model\TokenQuery;
use Propel\Runtime\Exception\EntityNotFoundException;
use RuntimeException;
use Zend\Diactoros\{Response, ServerRequest};

/**
 * Base controller
 */
class BaseController extends AbstractController
{
	/**
	 * @var array  Authenticated user
	 */
	protected $authenticatedUser;

	/**
	 * @var Leftaro\App\Hex\CommandBus
	 */
	protected $bus;

	/**
	 * @var Gcore\Sanitizer\Template\TemplateSanitizer
	 */
	protected $sanitizer;

	/**
	 * {@inheritDoc}
	 */
	public function __construct(Container $container)
	{
		$this->container = $container;

		$this->authenticatedUser = [];

		$this->bus = $container->get('bus');
	}

	/**
	 * {@inheritDoc}
	 */
	public function before(ServerRequest $request, Response $response) : Response
	{
		$accessToken = $request->getAttribute('access_token');

		if ($accessToken !== null)
		{
			try
			{
				$token = TokenQuery::create()->requireOneById($accessToken);

				$this->authenticatedUser = $token->getUser()->map();

				$expireDt = clone $token->getExpireDt();

				$token->setExpireDt($expireDt->modify('+2 weeks'));

				$token->save();
			}
			catch (EntityNotFoundException $e)
			{
				throw new InvalidTokenException($accessToken);
			}
		}

		return $response;
	}

	/**
	 * Sanitize the request input
	 *
	 * @param array $template  Template for sanitize engine
	 * @return array
	 */
	public function sanitizeRequest(array $template, array $input) : array
	{
		$this->sanitizer = $this->getSanitizer($template)->sanitize($input);

		return $this->sanitizer;
	}

	/**
	 * Get a template sanitizer by the given template
	 *
	 * @param array $template
	 * @return TemplateInterface
	 */
	public function getSanitizer(array $template) : TemplateInterface
	{
		$this->sanitizer =  new TemplateSanitizer($template);

		return $this->sanitizer;
	}

	/**
	 * Wraps the sanitizer require function to throw the proper API exception
	 *
	 * @param array $fields
	 * @return void
	 */
	public function requireFields(array $fields)
	{
		try
		{
			$this->sanitizer->requireFields($fields);
		}
		catch (RuntimeException $e)
		{
			throw new MissingParameterException($e->getMessage());
		}
	}
}