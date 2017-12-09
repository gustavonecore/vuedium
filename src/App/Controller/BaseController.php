<?php namespace Leftaro\App\Controller;

use Gcore\Sanitizer\Template\TemplateSanitizer;
use Gcore\Sanitizer\Template\TemplateInterface;
use Leftaro\Core\Controller\AbstractController;
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
	 * {@inheritDoc}
	 */
	public function before(ServerRequest $request, Response $response) : Response
	{
		$accessToken = $request->getAttribute('access_token');

		if ($accessToken !== null)
		{
			// TDDO: query fro user by token
			//$this->authenticatedUser = [];
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
		return $this->getSanitizer($template)->sanitize($input);
	}

	/**
	 * Get a template sanitizer by the given template
	 *
	 * @param array $template
	 * @return TemplateInterface
	 */
	public function getSanitizer(array $template) : TemplateInterface
	{
		return new TemplateSanitizer($template);
	}
}