<?php namespace Leftaro\App\Controller;

use Gcore\Sanitizer\Template\TemplateSanitizer;
use Gcore\Sanitizer\Template\TemplateInterface;
use Leftaro\App\Controller\BaseController;
USE Leftaro\App\Exception\AuthorizedException;
use Leftaro\App\Hex\CommandBus;
use Zend\Diactoros\{Response, ServerRequest};

/**
 * Post controller
 */
class PostController extends BaseController
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
		$posts = $this->bus->searchPosts()['posts'];

		return $this->json([
			'success' => true,
			'data' => [
				'posts' => $posts,
			],
		]);
	}

	/**
	 * Create a new post
	 *
	 * @param ServerRequest $request
	 * @param Response $response
	 * @return Response
	 */
	public function postCollectionAction(ServerRequest $request, Response $response) : Response
	{
		if ($this->authenticatedUser === [])
		{
			throw new AuthorizedException;
		}

		$sanitizer = $this->getSanitizer([
			'title' => 'string',
			'description' => 'string',
			'is_published' => 'bool',
		]);

		$input = $sanitizer->sanitize($request->getParsedBody());

		$this->requireFields(['title', 'description']);

		$post = $this->bus->createPost($this->authenticatedUser['id'], $input['title'], $input['description'], (bool)$input['is_published'])['post'];

		return $this->json([
			'success' => true,
			'data' => [
				'post' => $post,
			],
		]);
	}
}