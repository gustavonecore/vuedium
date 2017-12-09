<?php namespace Leftaro\App\Command\Post;

use Leftaro\App\Command\CommandInterface;

/**
 * Command to handle the search posts process
 */
class SearchPostsCommand implements CommandInterface
{
	/**
	 * @var array  User name
	 */
	protected $filters;


	/**
	 * @var array  User options
	 */
	protected $options;

	/**
	 * Constructs the command
	 *
	 * @param array $filters
	 * @param array $options
	 */
	public function __construct(array $filters = [], array $options = [])
	{
		$this->filters = $filters;
		$this->options = $options;
	}

	/**
	 * Get filters
	 *
	 * @return array
	 */
	public function getFilters() : array
	{
		return $this->filters;
	}

	/**
	 * Get options
	 *
	 * @return array
	 */
	public function getOptions() : array
	{
		return $this->options;
	}
}