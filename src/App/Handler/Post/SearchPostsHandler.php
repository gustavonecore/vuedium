<?php namespace Leftaro\App\Handler\Post;

use Exception;
use Leftaro\App\Handler\HandlerInterface;
use Leftaro\App\Command\Post\SearchPostsCommand;
use Leftaro\App\Model\PostQuery;

/**
 * Handle the SearchPosts command
 */
class SearchPostsHandler implements HandlerInterface
{
	public function handle(SearchPostsCommand $command)
	{
		$postQuery = PostQuery::create();

		$filters = $command->getFilters();

		if (isset($filters['slug']))
		{
			$postQuery = $postQuery->filterBySlug($filters['slug']);
		}
		else
		{
			if (isset($filters['user_id']))
			{
				$postQuery = $postQuery->filterByUserId($filters['user_id']);
			}


			if (isset($filters['title']))
			{
				$postQuery = $postQuery->filterByTitle($filters['title']);
			}

			if (isset($filters['description']))
			{
				$postQuery = $postQuery->filterByTitle($filters['description']);
			}

		}

		$posts = [];

		foreach ($postQuery->find() as $post)
		{
			$posts[] = $post->map();
		}

		return [
			'posts' => $posts,
		];
	}
}