<?php namespace Leftaro\App\Handler\Post;

use Cocur\Slugify\Slugify;
use Leftaro\App\Handler\HandlerInterface;
use Leftaro\App\Command\Post\UpdatePostCommand;
use Leftaro\App\Exception\SlugAlreadyExistsException;
use Leftaro\App\Exception\ResourceNotFoundException;
use Leftaro\App\Model\PostQuery;

/**
 * Handle the UpdatePost command
 */
class UpdatePostHandler implements HandlerInterface
{
	/**
	 * Handle the command
	 *
	 * @param UpdatePostCommand $command
	 * @return void
	 */
	public function handle(UpdatePostCommand $command)
	{
		$slug = (new Slugify())->slugify($command->getTitle());

		$post = PostQuery::create()->findOneById($command->getPostId());

		if (!$post)
		{
			throw new ResourceNotFoundException('Post with id ' . $command->getPostId());
		}

		$existingSlug = PostQuery::create()->findOneBySlug($slug);

		if ($existingSlug && $existingSlug->getId() !== $command->getPostId())
		{
			throw new SlugAlreadyExistsException($command->getTitle());
		}

		if ($command->isPublished() && $post->getPublishedDt() === null)
		{
			$post->setPublishedDt(gmdate('Y-m-d H:i:s'));
		}

		if ($command->isDeleted() && $post->getDeletedDt() === null)
		{
			$post->setDeletedDt(gmdate('Y-m-d H:i:s'));
		}

		$post->setTitle($command->getTitle());
		$post->setSlug($slug);
		$post->setDescription($command->getDescription());
		$post->setUpdatedDt(gmdate('Y-m-d H:i:s'));
		$post->save();

		return [
			'post' => $post->map(),
		];
	}
}