# Overview and philoshophy
As stated in the readme, this framework is a tool that utilizes [Pandoc](https://pandoc.org) to create beautiful standalone ebooks and documents from multiple [MarkDown](https://daringfireball.net/projects/markdown/) markup files. The text contents are written in plain text, and can therefore be tracked by version control system, like Git, and before exporting to pdf or epub, the MD code is translated to, and interpreted as [LaTeX](https://www.latex-project.org).

The main reasons, why I decided to try this approach, instead of continuing to use any office document processing tool, were following:

- Modular nature: I wanted to divide a lengthy document into more managable set of files - chapters. That way, I can see two chapters side by side and modify them parallelly without scrolling all the time (I figured out, that such feature would be invaluable, only after writing a 13k words bachelor thesis)
- Version control: I thought it would be useful to see different versions of the document, and changes made between them. Moreover, remote VCS makes perfect backups, and even makes possible collaboration way easier
- Clearer style: Since MD markup is quite limited, I like to think of it as of a benefit: I hope it will give the document more unified, more readable look

## Features checklist
There are certain features this framework in general, and other tools I use, must provide for me. Some features must be satisfied by recommended text processing program, other by the MD-to-PDF compilation tool. It's important to note, that theese points are my personal requirements, and I present them only to give an idea on the philosophy behind the project, and what could it give you.

As noted further in the docs, the framework relies on [Pandoc](https://pandoc.org) tool, and I personally chosed [Haroopad](http://pad.haroopress.com/user.html) as text processor, which suits me the most.

My text processor requirements:

- [x] Live compilation result preview
	- I need to see the result of MD processing as I write. I prefer two-pane layout, instead of WYSIWIG, and this requirement is satisfied by Haroopad
- [x] Ability to view multiple files simoutanously
	- Haroopad works in windowed mode, and therefore it is possible to arrange the files for convenience
- [x] Multiple monitor support
	- Again, windowed mode enables spreading the work on multiple monitors. This is feature, which might not be able to accomplish with a single-window IDE (which could, however, at least support viewing multiple files at the same time)
- [ ] Tabbed interface of opened documents
	- Haroopad does not have this feature. Instead, it works in windowed mode, which is not perfect to me personally, but it is satisfactory enough
- [x] Diacritics support (UTF8)
	- Haroopad works well with UTF-8

Framework requirements and goals:

- [x] Git support
	- MD files are basically plain-text and therefore perfectly compatible with any VCS
- [x] Export: Export to PDF (EPUB), merge of multiple files
	- Pandoc does this, and much more
- [x] Content: images, code preview
	- Works like a charm, as seen in example chapter
- [x] Content: tables
	- It's difficult to maintain the tables in plain text, but it's possible, as seen in example chapter
- [x] Organization: Table of contents, list of tables, list of figures, bibliography (References)
	- Another few of nice features Pandoc provides
- [ ] Organization: pagebreaks, heading numbering
	- Hasn't been tested yet
- [x] Style: Template support
	- It's not perfect enough in current version of the framework, as described in first News entry, but Pandoc does have the template support
- [ ] Custom formatting / style
	- Hasn't been tested properly
- [ ] Formalized FW
	- In the end, I want to present a publishable version of the project, with accurate docs and all features working and tested

\pagebreak
