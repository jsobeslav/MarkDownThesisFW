<?php declare(strict_types = 1);

namespace App;

/**
 * Class Config
 *
 * @package App
 *
 * @method static scriptRoot($value = null)
 * @method static documentRoot($value = null)
 * @method static tempDirectory($value = null)
 */
class Config
{

	/**
	 * @var array All setting applied to app.
	 */
	protected static $settings = [
		// Append default settings here.
	];

	/**
	 * Returns current setting for given $key. Returns null if setting is not found.
	 *
	 * @param string $key
	 *
	 * @return mixed|null
	 */
	protected static function getSetting(string $key)
	{
		return static::$settings[$key] ?? null;
	}

	/**
	 * Overwrites current setting for given $key with new $value. Returns the $value.
	 *
	 * @param string $key
	 * @param mixed  $value
	 *
	 * @return mixed
	 */
	protected static function setSetting(string $key, $value)
	{
		static::$settings[$key] = $value;

		return $value;
	}

	/**
	 * @param string $name
	 * @param array  $arguments
	 *
	 * @return mixed|null
	 */
	public static function __callStatic(string $name, array $arguments)
	{
		if (count($arguments) == 0) {
			return static::getSetting($name);
		}

		return static::setSetting($name, $arguments[0]);
	}
}
