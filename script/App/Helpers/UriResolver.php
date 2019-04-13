<?php declare(strict_types = 1);

namespace App\Helpers;

use App\Config;
use App\Helpers\Traits\HaveCounter;

class UriResolver
{

	use HaveCounter;

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
			'%s/spf.md',
			Config::tempDirectory()
		);
	}

	/**
	 * @param string $prefix
	 *
	 * @return string
	 */
	public static function tempChapter(string $prefix = ''): string
	{
		return sprintf(
			'%s/%s%s.md',
			Config::tempDirectory(),
			$prefix,
			static::counter()
		);
	}

	/**
	 * @param string $documentDirectory
	 *
	 * @return string
	 */
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
		return sprintf('%s/content/chapters', $documentDirectory);
	}
}
