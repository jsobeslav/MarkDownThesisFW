<?php
// Register autoloaders
include_once 'vendor/autoload.php';

// Load CLI script parameters
if (count($argv) < 2) {
	die('Not enough parameters supplied');
}

$documentRoot = $argv[1];
$outputFormat = $argv[2] ?? 'pdf';
$templateName = $argv[3] ?? 'default';

// config
\App\Config::scriptRoot(__DIR__);
\App\Config::tempDirectory(__DIR__ . '/_temp');
\App\Config::documentRoot($documentRoot);

// Run the processing
try {
	$mdThesis = new \App\MdThesis();
	$mdThesis->create(
		$documentRoot,
		$outputFormat,
		$templateName
	);
} catch (\Exception $exception) {
	die(sprintf(
		'Processing failed. %s: %s',
		get_class($exception),
		$exception->getMessage()
	));
}

echo 'Processing finished successfully';