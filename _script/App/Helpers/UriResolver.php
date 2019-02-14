<?php declare(strict_types = 1);

namespace App\Helpers;

use App\Config;

class UriResolver
{

	/**
	 * @param string $rootDirectory
	 * @param string $templateName
	 *
	 * @return string
	 */
	public static function templateDirectory(string $rootDirectory, string $templateName): string
	{
		return sprintf(
			'%s/templates/%s',
			$rootDirectory,
			$templateName
		);
	}

	/**
	 * @param string $templateDirectory
	 *
	 * @return string
	 */
	public static function citationStyle(string $templateDirectory): string
	{
		return sprintf(
			'%s/citation_style.csl',
			$templateDirectory
		);
	}

	/**
	 * @param string $templateDirectory
	 *
	 * @return string
	 */
	public static function epubStyle(string $templateDirectory): string
	{
		return sprintf(
			'%s/epub_style.css',
			$templateDirectory
		);
	}

	/**
	 * @param string $templateDirectory
	 *
	 * @return string
	 */
	public static function styleMetadata(string $templateDirectory): string
	{
		return sprintf(
			'%s/metadata_style.yaml',
			$templateDirectory
		);
	}

	/**
	 * Template subfile.
	 *
	 * @param string $templateDirectory
	 *
	 * @return string
	 */
	public static function documentTemplate(string $templateDirectory): string
	{
		return sprintf(
			'%s/template_document.tex',
			$templateDirectory
		);
	}

	/**
	 * Template subfile.
	 *
	 * @param string $templateDirectory
	 *
	 * @return string
	 */
	public static function chapterTemplate(string $templateDirectory): string
	{
		return sprintf(
			'%s/template_chapter.tex',
			$templateDirectory
		);
	}

	/**
	 * @return string
	 */
	public static function tempSpaceFile(): string
	{
		return sprintf(
			'%s/space_file.md',
			Config::tempDirectory()
		);
	}

	public static function contentMetadata(string $documentDirectory): string
	{
		return sprintf(
			'%s/metadata/metadata_content.yaml',
			$documentDirectory
		);
	}

	/**
	 * @param string $documentDirectory
	 *
	 * @return string
	 */
	public static function chaptersDirectory(string $documentDirectory): string
	{
		return sprintf('%s/chapters', $documentDirectory);
	}
}
