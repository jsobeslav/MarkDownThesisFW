<?php declare(strict_types = 1);

namespace App\Helpers\File;

use App\Helpers\UriResolver;

class SpaceFile
{

	/** @var string $filename Full path to temp file. */
	public $filename;

	/**
	 * SpaceFile constructor.  Makes a MD file containing only a newline.
	 * It is necessary to append a newline between chapter file and metadata block so that it gets formatted properly
	 *
	 * @throws \Exception
	 */
	public function __construct()
	{
		$this->filename = UriResolver::tempSpaceFile();
		File::write($this->filename, PHP_EOL);
	}

	/**
	 * @return string
	 */
	public function __toString(): string
	{
		return $this->filename;
	}
}
