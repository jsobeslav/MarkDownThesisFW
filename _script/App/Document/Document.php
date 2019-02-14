<?php declare(strict_types = 1);

namespace App\Document;

use App\Helpers\UriResolver;
use App\Template\Template;

class Document
{

	/** @var string $directory Full path to document root directory. */
	public $directory;

	/** @var Template $template */
	public $template;

	/** @var array $chapters */
	public $chapters;

	/**
	 * Document constructor.
	 *
	 * @param string   $documentRoot
	 * @param Template $template
	 */
	public function __construct(string $documentRoot, Template $template)
	{
		$this->directory     = $documentRoot;
		$this->template = $template;

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
			if (pathinfo($file, PATHINFO_EXTENSION) != 'md') {
				continue;
			};

			$this->chapters[] = new Chapter(
				$chaptersDir . DIRECTORY_SEPARATOR . $file,
				$this->template->compiledChapterTemplate
			);
		}
	}

	/**
	 * @return Chapter[]
	 */
	public function getChapters(): array
	{
		return $this->chapters;
	}

	/**
	 * @return string
	 */
	public function getContentMetadata(){
		return UriResolver::contentMetadata($this->directory);
	}
}
