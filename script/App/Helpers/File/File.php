<?php declare(strict_types = 1);

namespace App\Helpers\File;

use App\Config;

class File
{

	/**
	 * Reads content of text file.
	 *
	 * @param string $filename
	 *
	 * @return string
	 *
	 * @throws FileNotAccessibleException If unable to find, or read file.
	 */
	public static function read(string $filename): string
	{
		$filename = self::scope($filename);

		$file = fopen($filename, "r");
		if (! is_file($filename) || filesize($filename) === 0 || ! $file) {
			throw new FileNotAccessibleException('Unable to open file for read');
		}
		$content = fread($file, filesize($filename));
		fclose($file);

		return $content;
	}

	/**
	 * Writes text file.
	 *
	 * @param string $filename
	 * @param string $content
	 *
	 * @return void
	 *
	 * @throws FileNotAccessibleException If unable to write to file.
	 */
	public static function write(string $filename, string $content): void
	{
		$filename = self::scope($filename);

		$dirname = dirname($filename);
		if (! is_dir($dirname)) {
			mkdir($dirname, 0755, true);
		}

		$file = fopen($filename, "w");
		if (! $file) {
			throw new FileNotAccessibleException('Unable to open file for writing');
		}
		fwrite($file, $content);
		fclose($file);
	}

	/**
	 * @param string $sourceFilename
	 * @param string $outputFilename
	 *
	 * @return void
	 *
	 * @throws FileNotAccessibleException Either from self::read() or self::write().
	 */
	public static function copy(string $sourceFilename, string $outputFilename): void
	{
		static::write(
			$outputFilename,
			static::read($sourceFilename)
		);
	}

	/**
	 * Prepends script root path to the file path.
	 *
	 * @param string $filename
	 *
	 * @return string
	 */
	private static function scope(string $filename): string
	{
		if (strpos($filename, Config::scriptRoot()) !== false) {
			return $filename;
		}

		return (Config::scriptRoot() . DIRECTORY_SEPARATOR . $filename);
	}
}
