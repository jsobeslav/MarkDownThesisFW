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
		$process->run();

		if (! $process->isSuccessful()) {
			throw new ProcessFailedException($process);
		}

		return $process->getOutput();
	}

	public function test(): string
	{
		$command = new Command();
		$command->scriptFile(base_path() . static::SCRIPT_LAYER_PARSER);

		// Get first suitable OAuth client and make Phantom auth request in its name.
		$command->parameter(URL::to(static::AUTH_URL));
		$oauthClient = Client::whereRevoked(false)->first();
		$command->parameter((string) $oauthClient->id);
		$command->parameter($oauthClient->secret);

		$command->parameter($sourcePreviewUrl);
		chmod(dirname($outputFullPath), 0777);
		$command->parameter($outputFullPath);

		return $this->runCommand($command);
	}
}
