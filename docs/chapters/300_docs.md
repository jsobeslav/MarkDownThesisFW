# Docs
## Dependencies

The framework requires [Pandoc](https://pandoc.org) tool installed. If You need to export to PDF, you will also need [MiKTeX](https://miktex.org), as Pandoc docs recommend.

It is written in [PHP](php.net), so you need the language interpreter as well (it is unnecessary to run entire web server, as it works in CLI).

I also had an issue with following error: `pdfTeX error (font expansion): auto expansion is only possible with scalable fonts`. I found solution in this [latextemplates issue thread](https://github.com/latextemplates/scientific-thesis-template/issues/28), where user by the name koppor recommended installing `cm-super` MiKTeX plugin, which has worked for me.

## MarkDown processing

I use [Haroopad](http://pad.haroopress.com/user.html) to process MD files, since I like the two-pane interface more, than any WYSIWIG, like what [Typora](https://typora.io) offers. 
Unfortunatelly, Haroopad has not been updated for a long time, and might have some issues, especially in the future. Nevertheless it still works for me, which is why I am leaving it here as a recommendation. 

A decent list of other recommendations is available in this [SitePoint article](https://www.sitepoint.com/best-markdown-editors-windows/).

Moreover: You can use any IDE with MD highlight support: PhpStorm, or NetBeans, for example, offer optional MarkDown plugin (with live preview functionality), and enables user to split the window area, so that only issue I have had with it, was that the IDE does not break lines, which could be fixed in a few ways (with `Toggle line wrap` plugin, for example).

## Directory structure:

Script directory structure.

- `_script`: Operating system batch command files that compile chapters and template into an output in requested format
    - `windows_cmd.bat`: Windows batch file; tested on Windows 10. Check the script variables section bellow
    - Other OS batch command files are missing; If you are writing one on your own, please see the `windows_cmd.bat` comments, and, please, contribute to the project with your solution
	- `_temp`: Temporary files required for compillation process
	- `resources`
	    - `templates`: Default available templates. Can be overloaded by custom document template with same name.
            - `template.tex`: A template file, containing intro, tables of contents, figures, and tables, and other document parts, in Pandoc LaTeX template format
                You can replace it with any of [user contributed templates](https://github.com/jgm/pandoc/wiki/User-contributed-templates). If you do so, many metadata entries won't probably be working and other might have to be added. In other words: the meteadata files, and template file, are closely related.
            - `style_metadata.yaml`: Style-related metadata, containing data like paper size, or page margins
            - `citation_style.csl`: A citation style declaration. Default file is IEEE standard, but feel free to replace it with any other. You can find thousands of CSL files on [Zotero Style Repository](https://www.zotero.org/styles)
            - `epub_style.css`: A stylesheet declaration for epub format

This is file structure of every document.

- `chapters`: The document content itself. Contains MD files ordered by filename. I recommend prefixing three-digit number.
- `images`: Optional folder for images.
- `tables`: Optional folder for tables.
- `metadata`: The document meta information declarations, containing data like author name, or list of sources
	- `metadata.yaml`: Content-related metadata; a set of data like author name, in [YAML](http://yaml.org) format
	- `bibliography.bib`: Bibliography, a list of references in [BibTeX](http://www.bibtex.org) format
- `templates`: The general output document markups, style and meta data
    - `<templateName>`: If there are templates with same name in both script and document folder, the latter is used. You can, therefore, overload default templates.

## Use
First of all modify all the content files, and the metadata as well. Once You want to compile the results, navigate to the `_script` folder and run whatever script your OS need. You can run it ither from CLI, or GUI, if your OS allows to run the script from there, but if the script fails, it's better to go to CLI as you will be able to see the errors.

You might want to look into the script, and modify following variables:

- `extension` (default: `pdf`): Result output format; I will test the results for `pdf` and `epub` only, but other values are possible, as seen in Pandoc docs
- `template` (default: `template.tex`): A chosen LaTeX template file from `template` folder

Again: the script is built on [Pandoc](https://pandoc.org), so you should check their docs as well.
