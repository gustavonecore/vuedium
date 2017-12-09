<?php namespace Leftaro\App\Controller;

use Gcore\Sanitizer\Template\TemplateSanitizer;
use Gcore\Sanitizer\Template\TemplateInterface;
use Leftaro\Core\Controller\AbstractController;
use Zend\Diactoros\{Response, ServerRequest};

/**
 * Post controller
 */
class PostController extends AbstractController
{
	/**
	 * Get a list of posts
	 *
	 * @param ServerRequest $request
	 * @param Response $response
	 * @return Response
	 */
	public function getCollectionAction(ServerRequest $request, Response $response) : Response
	{
		return $this->json([
			'success' => true,
			'posts' => [],
		]);
	}
}