<?php namespace Leftaro\App\Controller;

use Gcore\Sanitizer\Template\TemplateSanitizer;
use Gcore\Sanitizer\Template\TemplateInterface;
use Leftaro\App\Controller\BaseController;
USE Leftaro\App\Exception\AuthorizedException;
use Leftaro\App\Exception\ResourceNotFoundException;
use Leftaro\App\Exception\EntityAlreadyDeletedException;
use Leftaro\App\Hex\CommandBus;
use Zend\Diactoros\{Response, ServerRequest};

/**
 * Post controller
 */
class PostController extends BaseController
{
	/**
	 * @var array Post data
	 */
	protected $post;

	/**
	 * {@inheritDoc}
	 */
	public function before(ServerRequest $request, Response $response) : Response
	{
		$postId = $request->getAttribute('post_id');

		if ($postId !== null)
		{
			$identifier = 'id';

			$input = $this->getSanitizer(['id' => 'int'])->sanitize(['id' => $postId]);

			if ($input['id'] === null)
			{
				if (preg_match('/^[a-z0-9-]+$/', $postId))
				{
					$identifier = 'slug';
				}
			}

			$posts = $this->bus->searchPosts(
				[$identifier => $postId],
				['inflators' => $request->getAttribute('inflators')]
			)['posts'];

			if ($posts === [])
			{
				throw new ResourceNotFoundException('Post with ' . $identifier . ' ' . $postId);
			}

			$this->post = $posts[0];
		}

		return parent::before($request, $response);
	}

	/**
	 * Get a list of posts
	 *
	 * @param ServerRequest $request
	 * @param Response $response
	 * @return Response
	 */
	public function getCollectionAction(ServerRequest $request, Response $response) : Response
	{
		$posts = $this->bus->searchPosts(
			[],
			['inflators' => $request->getAttribute('inflators')]
		)['posts'];

		return $this->json([
			'success' => true,
			'data' => [
				'posts' => $posts,
			],
		]);
	}

	/**
	 * Get an specific post by slug
	 *
	 * @param ServerRequest $request
	 * @param Response $response
	 * @return Response
	 */
	public function getResourceAction(ServerRequest $request, Response $response) : Response
	{
		return $this->json([
			'success' => true,
			'data' => [
				'post' => $this->post,
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

	/**
	 * Update an specific post by slug
	 *
	 * @param ServerRequest $request
	 * @param Response $response
	 * @return Response
	 */
	public function patchResourceAction(ServerRequest $request, Response $response) : Response
	{
		if ($this->authenticatedUser === [] || $this->post['user_id'] !== $this->authenticatedUser['id'])
		{
			throw new AuthorizedException;
		}

		$sanitizer = $this->getSanitizer([
			'title' => 'string',
			'description' => 'string',
			'is_published' => 'bool',
		]);

		$input = $sanitizer->sanitize($request->getParsedBody());

		if ($input['title'] === null)
		{
			$input['title'] = $this->post['title'];
		}

		if ($input['description'] === null)
		{
			$input['description'] = $this->post['description'];
		}

		if ($input['is_published'] === null)
		{
			$input['is_published'] = ($this->post['published_dt'] !== null) ? true : false;
		}

		$post = $this->bus->updatePost($this->post['id'], $input['title'], $input['description'], (bool)$input['is_published'])['post'];

		return $this->json([
			'success' => true,
			'data' => [
				'post' => $post,
			],
		]);
	}

	/**
	 * Delete an specific post
	 *
	 * @param ServerRequest $request
	 * @param Response $response
	 * @return Response
	 */
	public function deleteResourceAction(ServerRequest $request, Response $response) : Response
	{
		if ($this->authenticatedUser === [] || $this->post['user_id'] !== $this->authenticatedUser['id'])
		{
			throw new AuthorizedException;
		}

		if ($this->post['deleted_dt'] !== null)
		{
			throw new EntityAlreadyDeletedException('Post with id ' . $this->post['id']);
		}

		$deleted = true;

		$this->bus->updatePost(
			$this->post['id'],
			$this->post['title'],
			$this->post['description'],
			($this->post['published_dt'] !== null) ? true : false,
			$deleted
		);

		return $this->json([
			'success' => true,
			'data' => new \stdClass(),
		]);
	}
}