# MarkDownThesisFW
## Overview
This framework is a tool that utilizes [Pandoc](https://pandoc.org) to create beautiful standalone ebooks and documents from multiple [MarkDown](https://daringfireball.net/projects/markdown/) markup files. The text contents are written in plain text, and can therefore be tracked by version control system, like Git, and before exporting to pdf or epub, the MD code is translated to, and interpreted as [LaTeX](https://www.latex-project.org).

The main reasons, why I decided to try this approach, instead of continuing to use any office document processing tool, were following:

- Modular nature: I wanted to divide the lengthy document into more managable set of files. That way, I can see two chapters side by side and modify them parallelly without scrolling all the time
- Version control: I thought it would be useful to see different versions of the document, and changes made between them. Moreover, VCS makes perfect backups, and even makes collaboration easier
- Clearer style: Since MD markup is quite limited, I thought of it as of a benefit: I hope it will give the document more unified, more readable look

### News

> I have just finished the framework, and will test it on a real example soon. When that happens, I will probably update the tool with some fixes, or additional options.
> I am quite happy with the results so far, with the only exception being the template format. I wanted the template to be written in MD as well and to be translated to LaTeX during the compillation, but there were errors, and that's why I left the template in LaTeX. I will try to look into it later.
> - February 2018

## Docs
### Dependencies

The framework requires [Pandoc](https://pandoc.org) tool installed. If You need to export to PDF, you will also need [MiKTeX](https://miktex.org), as Pandoc docs recommend.

I also had an issue with following error: `pdfTeX error (font expansion): auto expansion is only possible with scalable fonts`. I found solution in this [latextemplates issue thread](https://github.com/latextemplates/scientific-thesis-template/issues/28), where user koppor recommended installing `cm-super`, which has worked for me.

### MarkDown processing

I use [Haroopad](http://pad.haroopress.com/user.html) to process MD files, since I like the two-pane interface more, than any WYSIWIG, like what [Typora](https://typora.io) offers. 
Unfortunatelly, Haroopad has not been updated for a long time, and might have some issues, especially in the future. Nevertheless it still works for me, which is why I am leaving it here as a recommendation. 

A decent list of other recommendations is available in this [SitePoint article](https://www.sitepoint.com/best-markdown-editors-windows/).

Moreover: You can use any IDE with MD highlight support: NetBeans, for example, offer optional MarkDown plugin (with live preview functionality), and enables user to split the window area, so that only issue I have had with it, was that the IDE does not break lines, which could be fixed in a few ways (with `Toggle line wrap` plugin, for example).

### Directory structure:

- `_script`: Operating system batch command files that compile chapters and template into an output in requested format
    - `windows_cmd.bat`: Windows batch file; tested on Windows 10. Check the script variables section bellow
    - Other OS batch command files are missing; If you are writing one on your own, please see the `windows_cmd.bat` comments, and, please, contribute to the project with your solution
- `_temp`: Temporary files required for compillation process
- `_output`: Folder, where the output file will be saved
- `metadata`: The document meta information declarations, containing data like author name, or list of sources
	- `bibliography.bib`: Bibliography, a list of references in [BibTeX](http://www.bibtex.org) format
	- `metadata.yaml`: Book meta data, a list of data like author name, in [YAML](http://yaml.org) format
- `template`: The general output document markup, style and meta data
    - `template.tex`: A template file, containing intro, tables of contents, figures, and tables, and other document parts, in Pandoc LaTeX template format
    	You can replace it with any [user contributed templates](https://github.com/jgm/pandoc/wiki/User-contributed-templates)
    - `style_metadata.yaml`: Style-related meta data, containing data like paper size, or page margins
    - `epub_style.css`: A stylesheet declaration for epub format
- `_script`: Operating system batch command files that compile chapters and template into an output in requested format
    - `windows_cmd.bat`: Windows batch file; tested on Windows 10. Check the script variables section bellow
    - Other OS batch command files are missing; If you are writing one on your own, please see the `windows_cmd.bat` comments, and, please, contribute to the project with your solution
- `_temp`: Temporary files required for compillation process
- `_output`: Folder, where the output file will be saved

### Use
First of all modify all the content files, and the meta data as well. Once You want to compile the results, enter command line, navigate to the `_script` folder and run whichever You need.

You might want to look into the script, and modify following variables:

- `extension` (default: `pdf`): Result output format; I will test the results for `pdf` and `epub` only, but other values are possible, as seen in Pandoc docs
- `result` (default: `result`): Result output filename in `_output`
- `template` (default: `template.tex`): A chosen LaTeX template file

Again, the script is built on [Pandoc](https://pandoc.org). You should check their docs as well.
