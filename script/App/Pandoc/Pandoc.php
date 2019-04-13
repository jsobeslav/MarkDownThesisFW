<?php declare(strict_types = 1);

namespace App\Pandoc;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class Pandoc
{

	/**
	 * Securely runs a command
	 *
	 * @param Command $command
	 *
	 * @return string
	 *
	 * @throws ProcessFailedException When process ends with error code.
	 */
	public function run(Command $command): string
	{
		$process = new Process($command);
		$process->setTimeout(360);
		$process->mustRun();

		if (! $process->isSuccessful()) {
			throw new ProcessFailedException($process);
		}

		return $process->getOutput();
	}
}
