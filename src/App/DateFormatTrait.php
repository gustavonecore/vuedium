<?php namespace Leftaro\App;

use DateTimeInterface;

/**
 * Trait to ensure date format
 */
trait DateFormatTrait
{
	/**
	 * Format a given date string
	 *
	 * @param mixed $dt  Datetime
	 * @return void
	 */
	protected function toW3cDate($dt)
	{
		if ($dt instanceof DateTimeInterface)
		{
			$dt = $dt->format('Y-m-d H:i:s');
		}

		return $dt === null ? null : substr($dt, 0, 10) . 'T' . substr($dt, 11) . 'Z';
	}
}