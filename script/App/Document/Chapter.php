<?php declare(strict_types = 1);

namespace App\Document;

use App\Helpers\UriResolver;
use App\Pandoc\Command;
use App\Pandoc\Pandoc;

class Chapter
{

	/** @var string $filename */
	protected $filename;

	/** @var string $compiledFile */
	protected $compiledFile; // @todo Is it useless?

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
		$this->compiledFile = $this->filename;

		$this->copy();
		$this->applyMethods();
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
		copy($this->compiledFile, $tempName);

		// New filename.
		$this->compiledFile = $tempName;
	}

	/**
	 * Apply custom methods.
	 */
	private function applyMethods(): void
	{
		// Load file content.
		$file        = fopen($this->compiledFile, "r");
		$fileContent = fread($file, filesize($this->compiledFile));
		fclose($file);

		// Select methods
		$regex = '/!\[[\w-]+\](?:\(\w+\))*/';
		preg_match_all($regex, $fileContent, $matches);
		/**
		 * @var array $matches
		 *
		 * <pre>
		 * [
		 *     0 => [
		 *                0 => `![vertical-space](20mm)`
		 *          ]
		 * ]
		 * </pre>
		 */

		// Foreach found method, process it.
		foreach ($matches[0] ?? [] as $index => $match) {
			/** @var string $match E.g.: `![vertical-space](20mm)`. */

			// Pluck method and parameters.
			$detailedRegex = '/!\[([\w-]+)\](?:\((\w+)\))?(?:\((\w+)\))?(?:\((\w+)\))?/';
			preg_match($detailedRegex, $match, $parts);
			/**
			 * @var array $parts
			 *
			 * <pre>
			 * [
			 *    0 => ![vertical-space](20mm)
			 *    1 => vertical-space
			 *    2 => 20mm
			 * ]
			 * </pre>
			 */

			// If there is suspiciously little parameters, skip it.
			if (count($parts) < 2) {
				continue;
			}

			// Prepare method name and parameters.
			$parameters = $parts;
			unset($parameters[0]);
			unset($parameters[1]);

			// Run the filter.
			$return = $this->applyMethod($parts[1], $parameters);

			// If signature did not match any method, skip it.
			if (empty($return)) {
				continue;
			}

			// Else replace the match in current file.
			$fileContent = str_replace_first($match, $return, $fileContent);
		}

		// Save file content.
		$file = fopen($this->compiledFile, "w");
		fwrite($file, $fileContent);
		fclose($file);
	}

	/**
	 * @param string $methodName
	 * @param array  $parameters
	 *
	 * @return string
	 */
	private function applyMethod(string $methodName, array $parameters): string
	{
		switch ($methodName) {
			default:
				return '<a method!>';
		}
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
		$command->parameter($this->getCompiledFile());
		$command->parameter('--template=' . $this->getCompiledFile());
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
		$this->compiledFile = $tempName;
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
		$command->parameter($this->getCompiledFile());
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
		$this->compiledFile = $tempName;
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

	/**
	 * @return string
	 */
	public function getCompiledFile(): string
	{
		return $this->compiledFile;
	}
}
