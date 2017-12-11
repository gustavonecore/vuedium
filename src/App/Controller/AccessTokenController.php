<?php namespace Leftaro\App\Controller;

use Leftaro\App\Controller\BaseController;
USE Leftaro\App\Exception\AuthorizedException;
use Leftaro\App\Exception\ResourceNotFoundException;
use Leftaro\App\Exception\EntityAlreadyDeletedException;
use Leftaro\App\Hex\CommandBus;
use Zend\Diactoros\{Response, ServerRequest};

/**
 * Access Token controller
 */
class AccessTokenController extends BaseController
{
	/**
	 * Exchange a valid access token using different credential types
	 *
	 * @param ServerRequest $request
	 * @param Response $response
	 * @return Response
	 */
	public function postCollectionAction(ServerRequest $request, Response $response) : Response
	{
		$sanitizer = $this->getSanitizer([
			'username' => 'string',
			'password' => 'string',
		]);

		$input = $sanitizer->sanitize($request->getParsedBody());

		$this->requireFields(['username', 'password']);

		$data = $this->bus->authenticate($input['username'], $input['password']);

		return $this->json([
			'success' => true,
			'data' => [
				'user' => $data['user'],
				'access_token' => $data['token']['id'],
			],
		]);
	}
}