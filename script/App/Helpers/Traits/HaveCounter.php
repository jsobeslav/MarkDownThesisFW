<?php declare(strict_types = 1);

namespace App\Helpers\Traits;

trait HaveCounter
{

	/** @var int $increment Current status */
	protected static $increment = 0;

	/**
	 * Increase inner counter and return new value
	 *
	 * @return int
	 */
	protected static function counter()
	{
		static::$increment++;

		return static::$increment;
	}
}