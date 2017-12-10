<?php namespace Leftaro\App\Exception;

use Exception;

/**
 * Class for handling api exceptions
 */
class ApiException extends Exception
{
	const UNKNOWN_ERROR = 1;
	const INVALID_PARAMETER = 2;
	const NOT_AUTHORIZED = 3;
	const INVALID_TOKEN = 4;
	const RESOURCE_NOT_FOUND = 5;
	const SLUG_ALREADY_EXISTS = 6;
	const ENTITY_ALREADY_DELETED = 7;

	/**
	 * Get the proper HTTP status code
	 *
	 * @return int
	 */
	public function getHttpCode() : int
	{
		return 500;
	}
}