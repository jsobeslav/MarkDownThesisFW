<?php declare(strict_types = 1);

namespace App\Pandoc;

use App\Helpers\UriResolver;

class Command
{

	/** string COMMAND Base tool name */
	private const COMMAND = 'pandoc';

	/** @var null|string $command Direct command */
	private $command;

	/** @var array $parameters */
	private $parameters;

	/**
	 * Command constructor.
	 *
	 * @param string|null $command
	 */
	public function __construct(string $command = null)
	{
		$this->command = $command;
	}

	/**
	 * Script parameters
	 *
	 * @param string $param
	 *
	 * @return void
	 */
	public function parameter(string $param): void
	{
		if ($param === null) {
			return;
		}

		$this->parameters[] = $param;
	}

	/**
	 * Shorthand for inserting space file
	 */
	public function spaceFile(): void
	{
		$this->parameter(UriResolver::tempSpaceFile());
	}

	/**
	 * Serialize
	 *
	 * @return string
	 */
	public function __toString(): string
	{
		// Simple command like '-v'.
		if ($this->command !== null) {
			return sprintf('%s %s', self::COMMAND, $this->command);
		}

		// Pandoc file processing request.
		$parts = array_merge(
			[
				self::COMMAND,
			],
			$this->parameters
		);

		return implode(' ', $parts);
	}
}
