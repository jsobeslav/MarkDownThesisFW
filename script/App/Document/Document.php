<?php declare(strict_types = 1);

namespace App\Document;

use App\Helpers\UriResolver;
use App\Template\Template;

class Document
{

	/** @var array $acceptedFilenames */
	protected $acceptedFilenames = ['md'];

	/** @var string $directory Full path to document root directory. */
	protected $directory;

	/** @var Template $template */
	protected $template;

	/** @var array $chapters */
	protected $chapters;

	/**
	 * Document constructor.
	 *
	 * @param string   $documentRoot
	 * @param Template $template
	 */
	public function __construct(string $documentRoot, Template $template)
	{
		$this->directory = $documentRoot;
		$this->template  = $template;

		$this->precompile();
	}

	/**
	 * Precompile chapters. Precompile each file and append filepath to the final pandoc call arguments.
	 *
	 * @return void
	 */
	public function precompile(): void
	{
		$chaptersDir = UriResolver::chaptersDirectory($this->directory);
		foreach (scandir($chaptersDir) as $file) {
			if (! in_array(pathinfo($file, PATHINFO_EXTENSION), $this->acceptedFilenames)) {
				continue;
			};

			$this->chapters[] = new Chapter(
				$chaptersDir . DIRECTORY_SEPARATOR . $file,
				$this
			);
		}
	}

	/**
	 * @return array
	 */
	public function getAcceptedFilenames(): array
	{
		return $this->acceptedFilenames;
	}

	/**
	 * @return string
	 */
	public function getDirectory(): string
	{
		return $this->directory;
	}

	/**
	 * @return string
	 */
	public function getDirectoryName()
	{
		return basename($this->directory);
	}

	/**
	 * @return string
	 */
	public function getContentMetadata()
	{
		return UriResolver::contentMetadata($this->directory);
	}

	/**
	 * @return Template
	 */
	public function getTemplate(): Template
	{
		return $this->template;
	}

	/**
	 * @return Chapter[]
	 */
	public function getChapters(): array
	{
		return $this->chapters;
	}

}
