<?php namespace Leftaro\App\Command\Auth;

use Leftaro\App\Command\CommandInterface;

/**
 * Command to handle the authentication process
 */
class AuthenticateCommand implements CommandInterface
{
	/**
	 * @var string  User name
	 */
	protected $username;


	/**
	 * @var string  User password
	 */
	protected $password;

	/**
	 * Constructs the command
	 *
	 * @param string $username
	 * @param string $password
	 */
	public function __construct(string $username, string $password)
	{
		$this->username = $username;
		$this->password = $password;
	}

	/**
	 * Get username
	 *
	 * @return string
	 */
	public function getUsername() : string
	{
		return $this->username;
	}

	/**
	 * Get password
	 *
	 * @return string
	 */
	public function getPassword() : string
	{
		return $this->password;
	}
}