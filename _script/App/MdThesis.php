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

		// Append metadata.
		$command->parameter($document->getContentMetadata());
		$command->parameter($template->getStyleMetadata());

		foreach($document->getChapters() as $chapter){
			$command->parameter($chapter->getFilename());
		}

		//$command->parameter('--filter pandoc-citeproc'); @todo fix citation standard link
		$command->parameter('--template='.$template->compiledDocumentTemplate);
		$command->parameter('-o output.'.$outputFormat);
		$command->parameter('-s');

		$pandoc = new Pandoc();
		$pandoc->run($command);

		// @TODO Remove temp files
	}
}
