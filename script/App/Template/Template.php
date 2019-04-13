<?php declare(strict_types = 1);

namespace App\Template;

use App\Config;
use App\Helpers\File\File;
use App\Helpers\UriResolver;

class Template
{

	/** @var string $name Template name. */
	protected $name;

	/** @var string $directory Directory containing all necessary template files. */
	protected $directory;

	/** @var string $compiledDocumentTemplate Full path to compiled document subtemplate. */
	protected $compiledDocumentTemplate;

	/** @var string $compiledChapterTemplate Full path to compiled chapter subtemplate. */
	protected $compiledChapterTemplate;

	/**
	 * Template constructor.
	 *
	 * @param string $templateName
	 *
	 * @throws TemplateNotFoundException From self::locateTemplate().
	 * @throws \App\Helpers\File\FileNotAccessibleException From self::precompile().
	 */
	public function __construct(string $templateName)
	{
		$this->name      = $templateName;
		$this->directory = $this->locateTemplate($templateName);

		$this->compiledDocumentTemplate = UriResolver::documentTemplate($this->directory);
		$this->compiledChapterTemplate  = UriResolver::chapterTemplate($this->directory);

		return;
		// @TODO Precompile the templates so that they can be written in more user friendly manner
		// They should contain comments, extra newlines, indentation and extra spaces
		$this->precompile();
	}

	/**
	 * Look where is required template located.
	 *
	 * @param string $templateName Template name, e.g. 'default'.
	 *
	 * @return string Full directory path.
	 *
	 * @throws TemplateNotFoundException When the template exists neither in document, nor amongst default templates.
	 */
	protected function locateTemplate(string $templateName): string
	{
		$directories = [
			Config::documentRoot() . '/template/',                            // Current working document template.
			Config::scriptRoot() . '/resources/templates/' . $templateName,   // Script default templates.
		];

		// Find first location that contains valid template going by the name.
		foreach ($directories as $templateDirectory) {
			if ($this->isValidTemplate($templateDirectory)) {
				return $templateDirectory;
			}
		}

		throw new TemplateNotFoundException;
	}

	/**
	 * Return true, if the directory contains all files necessary for a template.
	 *
	 * @param string $templateDirectory Full directory path.
	 *
	 * @return boolean
	 */
	protected function isValidTemplate(string $templateDirectory): bool
	{
		if (is_dir($templateDirectory)
			&& is_file(UriResolver::citationStyle($templateDirectory))
			&& is_file(UriResolver::epubStyle($templateDirectory))
			&& is_file(UriResolver::styleMetadata($templateDirectory))
			&& is_file(UriResolver::chapterTemplate($templateDirectory))
			&& is_file(UriResolver::documentTemplate($templateDirectory))
		) {
			return true;
		}

		return false;
	}

	/**
	 * Trigger precompilation of all necessary files.
	 * It is necessary to remove extra newlines, tabs, and comments from template files
	 *
	 * @return void
	 *
	 * @throws \App\Helpers\File\FileNotAccessibleException
	 */
	public function precompile(): void
	{
		$this->compiledDocumentTemplate = $this->precompileFile(
			UriResolver::documentTemplate($this->directory),
			UriResolver::documentTemplate(Config::tempDirectory())
		);

		$this->compiledChapterTemplate = $this->precompileFile(
			UriResolver::chapterTemplate($this->directory),
			UriResolver::chapterTemplate(Config::tempDirectory())
		);
	}

	/**
	 * Copy the file to designated location and run it trough parsers.
	 *
	 * @param string $sourceFilename Location of original file. It remains untouched at the original location.
	 * @param string $outputFilename Location of processed copy.
	 *
	 * @return string Full path to new _temp file (same as $outputFilename)
	 *
	 * @throws \App\Helpers\File\FileNotAccessibleException
	 */
	protected function precompileFile(string $sourceFilename, string $outputFilename): string
	{
		// Copy original file to _temp.
		$content = File::read($sourceFilename);

		// Remove comments - anything beginning with % character (optionally preceded by white spaces) and ending with end of line.
		$content = preg_replace('/(\s?)(\%+)(.*)$/m', PHP_EOL, $content);

		// Remove unnecessary white spaces and all tabs.
		$content = preg_replace('/ +/m', ' ', $content);
		$content = preg_replace('/\t/', '', $content);

		// Remove unnecessary newlines and following whitespaces.
		$content = preg_replace('/(\n\s?)+/m', '', $content);

		// Return newlines just before, and after LaTeX commands.
		// $content = preg_replace('/\\\\/m', PHP_EOL . '\\', $content);.
		File::write($outputFilename, $content);

		return $outputFilename;
	}

	/**
	 * @return string
	 */
	public function getName(): string
	{
		return $this->name;
	}

	/**
	 * @return string
	 */
	public function getDirectory(): string
	{
		return normalized_path($this->directory);
	}

	/**
	 * @return string
	 */
	public function getStyleMetadata()
	{
		return UriResolver::styleMetadata($this->directory);
	}

	/**
	 * @return string
	 */
	public function getCompiledDocumentTemplate(): string
	{
		return normalized_path($this->compiledDocumentTemplate);
	}

	/**
	 * @return string
	 */
	public function getCompiledChapterTemplate(): string
	{
		return normalized_path($this->compiledChapterTemplate);
	}

}
