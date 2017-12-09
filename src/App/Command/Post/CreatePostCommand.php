<?php namespace Leftaro\App\Command\Post;

use Leftaro\App\Command\CommandInterface;

/**
 * Command to handle the creste posts process
 */
class CreatePostCommand implements CommandInterface
{
	/**
	 * @var string  User id
	 */
	protected $userId;

	/**
	 * @var string  Title
	 */
	protected $title;

	/**
	 * @var string  Description
	 */
	protected $description;

	/**
	 * @var bool  Published flag
	 */
	protected $isPublished;

	/**
	 * Constructs the command
	 *
	 * @param string $userId
	 * @param string $title
	 * @param string $description
	 * @param string $isPublished
	 */
	public function __construct(string $userId, string $title, string $description, bool $isPublished = false)
	{
		$this->userId = $userId;
		$this->title = $title;
		$this->description = $description;
		$this->isPublished = $isPublished;
	}

	/**
	 * Get filters
	 *
	 * @return string
	 */
	public function getUserId() : string
	{
		return $this->userId;
	}

	/**
	 * Get title
	 *
	 * @return string
	 */
	public function getTitle() : string
	{
		return $this->title;
	}

	/**
	 * Get description
	 *
	 * @return string
	 */
	public function getDescription() : string
	{
		return $this->description;
	}

	/**
	 * Get published flag
	 *
	 * @return bool
	 */
	public function isPublished() : bool
	{
		return $this->isPublished;
	}
}