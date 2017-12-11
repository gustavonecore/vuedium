<?php namespace Leftaro\App\Handler\Auth;

use Exception;
use Leftaro\App\Exception\ResourceNotFoundException;
use Leftaro\App\Exception\AuthenticationException;
use Leftaro\App\Handler\HandlerInterface;
use Leftaro\App\Command\Auth\AuthenticateCommand;
use Leftaro\App\Model\UserQuery;

/**
 * Handle the authenticate command
 */
class AuthenticateHandler implements HandlerInterface
{
	public function handle(AuthenticateCommand $command)
	{
		$user = UserQuery::create()->findOneByEmail($command->getUsername());

		if (!$user)
		{
			throw new ResourceNotFoundException('user for ' . $command->getUsername());
		}

		if (!password_verify($command->getPassword(), $user->getPassword()))
		{
			throw new AuthenticationException;
		}

		return [
			'user' => $user->map(),
			'token' => $user->getToken()->map(),
		];
	}
}