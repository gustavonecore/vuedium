<?php namespace Leftaro\App\Controller;

use Leftaro\App\Controller\BaseController;
USE Leftaro\App\Exception\ApiException;
use ReflectionClass;
use Zend\Diactoros\{Response, ServerRequest};

/**
 * Error codes controller
 */
class ErrorController extends BaseController
{
	/**
	 * Get a list of the defined errors
	 *
	 * @param ServerRequest $request
	 * @param Response $response
	 * @return Response
	 */
	public function getCollectionAction(ServerRequest $request, Response $response) : Response
	{
		$reflector = new ReflectionClass(ApiException::class);

		return $this->json([
			'success' => true,
			'data' => [
				'erros' => $reflector->getConstants(),
			],
		]);
	}
}