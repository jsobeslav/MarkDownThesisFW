<?php declare(strict_types = 1);

namespace App\Document;

use App\Helpers\UriResolver;
use App\Pandoc\Command;
use App\Pandoc\Pandoc;

class Chapter
{

	/** @var string $filename */
	protected $filename;

	/** @var string $compiledFilename */
	protected $compiledFilename; // @todo Is it useless?

	/** @var Document $document */
	protected $document;

	/** @var string $chapterTemplate */
	protected $chapterTemplate;

	/**
	 * Chapter constructor.
	 *
	 * @param string   $filename
	 * @param Document $document
	 */
	public function __construct(string $filename, Document $document)
	{
		$this->filename        = $filename;
		$this->document        = $document;
		$this->chapterTemplate = $document->getTemplate()->getCompiledChapterTemplate();

		$this->precompile();
	}

	/**
	 * Precompile the chapter file.
	 *
	 * @return void
	 */
	public function precompile(): void
	{
		$this->copy();
		$this->replaceVariables();
		$this->applyTemplate();
	}

	/**
	 * Copy the file to new location
	 */
	private function copy(): void
	{
		// Copy the file to temp.
		$tempName = UriResolver::tempChapter('cha');
		copy($this->filename, $tempName);

		// New filename.
		$this->filename = $tempName;
	}

	/**
	 *  First alpha-precompile the metadata using the chapter as both source and template
	 *    to replace variables within itself.
	 */
	private function replaceVariables(): void
	{
		$tempName = UriResolver::tempChapter('chab');

		// Initialize command.
		$command = new Command();

		$command->parameter($this->document->getContentMetadata());
		$command->parameter($this->document->getTemplate()->getStyleMetadata());
		$command->parameter($this->getFilename());
		$command->parameter('--template=' . $this->getFilename());
		$command->parameter(
			sprintf(
				'-o %s',                                   // Output format.
				$tempName
			)
		);

		// Run command.
		$pandoc = new Pandoc();
		$pandoc->run($command);

		// New filename.
		$this->filename = $tempName;
	}

	/**
	 * then beta-precompile the alpha-precompiled file with template_chapter template
	 *    to format it properly.
	 */
	private function applyTemplate(): void
	{
		$tempName = UriResolver::tempChapter('chac');

		// Initialize command.
		$command = new Command();

		$command->parameter($this->document->getContentMetadata());
		$command->parameter($this->document->getTemplate()->getStyleMetadata());
		$command->parameter($this->getFilename());
		$command->parameter('--template=' . $this->chapterTemplate);
		$command->parameter(
			sprintf(
				'-o %s',                                   // Output format.
				$tempName
			)
		);

		// Run command.
		$pandoc = new Pandoc();
		$pandoc->run($command);

		// New filename.
		$this->filename = $tempName;
	}


	/**
	 * @return Document
	 */
	public function getDocument(): Document
	{
		return $this->document;
	}

	/**
	 * @return string
	 */
	public function getFilename(): string
	{
		return $this->filename;
	}
}
