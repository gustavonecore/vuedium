<?php

namespace Leftaro\App\Model;

use Leftaro\App\Model\Base\Post as BasePost;
use Leftaro\App\DateFormatTrait;

/**
 * Skeleton subclass for representing a row from the 'post' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class Post extends BasePost
{
	use DateFormatTrait;

	/**
	 * Map the data to the proper form
	 *
	 * @return array
	 */
	public function map() : array
	{
		return [
			'id' => $this->getId(),
			'title' => $this->getTitle(),
			'description' => $this->getDescription(),
			'slug' => $this->getSlug(),
			'created_dt' => $this->toW3cDate($this->getCreatedDt()),
			'updated_dt' => $this->toW3cDate($this->getUpdatedDt()),
			'published_dt' => $this->toW3cDate($this->getPublishedDt()),
			'deleted_dt' => $this->toW3cDate($this->getDeletedDt()),
			'user_id' => $this->getUserId(),
		];
	}
}
