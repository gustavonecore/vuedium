<?php namespace Leftaro\App\Handler\Auth;

use Exception;
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
			throw new Exception('User not found for email ' . $command->getUsername());
		}

		if (!password_verify($command->getPassword(), $user->getPassword()))
		{
			throw new Exception('Invalid credentials');
		}

		return [
			'user' => $user->toArray(),
		];
	}
}