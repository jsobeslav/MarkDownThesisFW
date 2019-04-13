<?php declare(strict_types = 1);

namespace App;

use App\Document\Document;
use App\Helpers\File\SpaceFile;
use App\Pandoc\Command;
use App\Pandoc\Pandoc;
use App\Template\Template;

class MdThesis
{

	/**
	 * Builds the results.
	 *
	 * @param string $documentRoot Root directory of processed document.
	 * @param string $outputFormat Output format: 'pdf', 'epub', or any other supported by Pandoc.
	 * @param string $templateName Name of template used to process document.
	 *
	 * @return void
	 *
	 * @throws \App\Helpers\File\FileNotAccessibleException
	 * @throws \App\Template\TemplateNotFoundException
	 * @throws \Exception
	 */
	public function create(
		string $documentRoot,
		string $outputFormat,
		string $templateName
	): void {
		// Prepare template, document and chapters.
		$template = new Template($templateName);
		$document = new Document($documentRoot, $template);
		$space    = new SpaceFile();

		// Compile output.
		// Pass all the loaded files to pandoc, alongside with additional parameters.
		$command = new Command();

		// Include packages.
		$command->parameter('-V header-includes="\usepackage{pdfpages}"'); // Include PDFs.
		//$command->parameter('-V header-includes="\usepackage{odsfile}"'); // Include ODS tables.
		$command->parameter('--filter pandoc-citeproc'); // Use citations.

		// Append metadata.
		$command->parameter($document->getContentMetadata());    // Content metadata.
		$command->parameter($template->getStyleMetadata());      // Style metadata.

		foreach ($document->getChapters() as $chapter) {
			$command->parameter((string) $space);            // Space file.
			$command->parameter($chapter->getCompiledFile());    // Chapter.
		}

		$command->parameter('--template=' . $template->getCompiledDocumentTemplate());    // Document template.
		$command->parameter('--from=markdown+escaped_line_breaks');                  // Input format.
		$command->parameter(sprintf('-o %s/%s.%s',                                   // Output format.
				$document->getDirectoryName(),
				$document->getDirectoryName(),
				$outputFormat)
		);
		$command->parameter('-s'); // Standalone file.

		$pandoc = new Pandoc();
		$pandoc->run($command);
		// @TODO Remove _temp files
	}
}
