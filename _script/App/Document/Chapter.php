<?php declare(strict_types = 1);

namespace App\Document;

class Chapter
{

	/** @var string $filename */
	public $filename;

	/** @var string $chapterTemplate */
	public $chapterTemplate;

	/** @var string $compiledFilename */
	public $compiledFilename;

	/**
	 * Chapter constructor.
	 *
	 * @param string $filename
	 * @param string $chapterTemplate
	 */
	public function __construct(string $filename, string $chapterTemplate)
	{
		$this->filename        = $filename;
		$this->chapterTemplate = $chapterTemplate;

		return;
		// @TODO precompile the chapter to replace own variables and then to format it according to chapter template
		$this->precompile();
	}

	/**
	 * Precompile the chapter file.
	 *
	 * @return void
	 */
	public function precompile(): void
	{
		// First alpha-precompile the metadata using the chapter as both source and template to replace variables within itself.
		// then beta-precompile the alpha-precompiled file with template_chapter template to format it.
	}

	/**
	 * @return string
	 */
	public function getFilename(): string
	{
		return $this->filename;
	}
}
