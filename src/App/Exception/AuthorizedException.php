<?php namespace Leftaro\App\Exception;

use Leftaro\App\Exception\ApiException;

/**
 * Class for not authorized errors
 */
class AuthorizedException extends ApiException
{
	/**
	 * Constructs the exception
	 *
	 * @param string $param  Name of the parameter
	 */
	public function __construct()
	{
		parent::__construct('Not authorized', ApiException::NOT_AUTHORIZED);
	}

	/**
	 * {@inheritDoc}
	 */
	public function getHttpCode() : int
	{
		return 403;
	}
}