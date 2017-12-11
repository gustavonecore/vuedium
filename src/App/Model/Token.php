<?php

namespace Leftaro\App\Model;

use Leftaro\App\Model\Base\Token as BaseToken;
use Leftaro\App\DateFormatTrait;

/**
 * Skeleton subclass for representing a row from the 'token' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class Token extends BaseToken
{
	use DateFormatTrait;

	/**
	 * Map the data to the proper form
	 * @param array $inflators  List of inflators
	 * @return array
	 */
	public function map(array $inflators = []) : array
	{
		$post = [
			'id' => $this->getId(),
			'type' => $this->getType(),
			'details' => $this->getDetails(),
			'created_dt' => $this->toW3cDate($this->getCreatedDt()),
			'expire_dt' => $this->toW3cDate($this->getExpireDt()),
			'updated_dt' => $this->toW3cDate($this->getUpdatedDt()),
			'user_id' => $this->getUserId(),
		];

		if (isset($inflators['user']))
		{
			$post['user'] = $this->getUser()->map();

			unset($post['user_id']);
		}

		return $post;
	}
}
