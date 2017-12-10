<?php namespace Leftaro\App\Handler\Post;

use Cocur\Slugify\Slugify;
use Exception;
use Leftaro\App\Handler\HandlerInterface;
use Leftaro\App\Command\Post\CreatePostCommand;
use Leftaro\App\Exception\SlugAlreadyExistsException;
use Leftaro\App\Model\Post;
use Leftaro\App\Model\PostQuery;

/**
 * Handle the CreatePost command
 */
class CreatePostHandler implements HandlerInterface
{
	/**
	 * Handle the command
	 *
	 * @param CreatePostCommand $command
	 * @return void
	 */
	public function handle(CreatePostCommand $command)
	{
		$slug = (new Slugify())->slugify($command->getTitle());

		$existingSlug = PostQuery::create()->findOneBySlug($slug);

		if ($existingSlug)
		{
			throw new SlugAlreadyExistsException($command->getTitle());
		}

		$publishedDt = $command->isPublished() ? gmdate('Y-m-d H:i:s') : null;

		$post = new Post();

		$rows = $post->
			setUserId($command->getUserId())->
			setTitle($command->getTitle())->
			setDescription($command->getDescription())->
			setSlug($slug)->
			setPublishedDt($publishedDt)->
			setCreatedDt(gmdate('Y-m-d H:i:s'))->
			save();

		if ($rows <= 0)
		{
			throw new \Exception('not valid data');
		}

		return [
			'post' => $post->map(),
		];
	}
}