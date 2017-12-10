<?php namespace Leftaro\App\Command\Post;

use Leftaro\App\Command\CommandInterface;

/**
 * Command to handle the creste posts process
 */
class UpdatePostCommand extends CreatePostCommand
{
	/**
	 * @var string  Post id
	 */
	protected $postId;

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
	 * @var bool  Deleted flag
	 */
	protected $isDeleted;

	/**
	 * Constructs the command
	 *
	 * @param int $postId
	 * @param string $title
	 * @param string $description
	 * @param string $isPublished
	 * @param string $isDeleted
	 */
	public function __construct(int $postId, string $title, string $description, bool $isPublished = false, bool $isDeleted = false)
	{
		$this->postId = $postId;
		$this->title = $title;
		$this->description = $description;
		$this->isPublished = $isPublished;
		$this->isDeleted = $isDeleted;
	}

	/**
	 * Get filters
	 *
	 * @return string
	 */
	public function getPostId() : int
	{
		return $this->postId;
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

	/**
	 * Get deleted flag
	 *
	 * @return bool
	 */
	public function isDeleted() : bool
	{
		return $this->isDeleted;
	}
}