## News


> The script has been generalized so it can be used with multiple documents.
>
> I have successfully used the solution for compiling my 101 pages long thesis, and I was very satisfied with the process and the results. I am happy to see that the effort has actually paid off, as I am certain this approach saved me much time in revisions and visual formatting.
>
> I will now try to finish the features I designed while working on it (namely shorthands for certain useful LaTeX commands, which do not have MarkDown counterpart). Furthermore, there are still other features pending (namely direct spreadsheet import and better looking LaTeX templates).
>
> Lastly, I am uncertain, how would I make the solution user friendly, and available to others. GUI app is way beyond scope of this project, but I was thinking about the posibilities of packing the code with PHP interpreter into single executable file. Nevertheless, this does not have any priority in the development.
>
> - v0.0.6.0 April 2019

---


> As I returned to the project after a while, I realized that I need to rewrite it, in order to be able to continue with more complex features.
>
> Since I don't have strong knowledge of scripting languages like bash or Windows CMD, I decided to go on with the one language I am most familiar with, PHP.
>
> - v0.0.5.0, October 2018

---

> I made it possible to declare a variable within chapter file itself, which overwrites global declarations, and can be used in that very file (as can global variables be used, naturally). I will update the docs with next commit.
> 
> I need that functionality because of the new `template_chapter` file, a template that wrapps every chapter to get more control over the result formating. I want to use variables in this template as I do in `template_document`.
>
> Once this feature has been done, I may move some variables (notably the ones related to table of contents, and bibliography) to separate chapters, so that `metadata_content` and `metadata_style` would only contain variables, that affects the whole document, regardless of its content. I also want to remove the `header-includes` variables, since they contain TeX declarations that may be incorporated into the document template, having only its control variables present in the YAML (I would be user friendly, having variables like `break-lines-after-chapter: true` instead `after-includes: \pagebreak`).
> 
> Finally, another feature, that I have in mind, is using CSV or XLS tables as resource included in the file much like an image. That's important, since noone wants to write table in plain text, does someone?
> 
> Another minor change that had been done is rewritting the `templates` folder structure in a way, that makes it possible to store multiple custom templates for different document types. Another step in that direction will be generalizing the script for use with multiple documents (it is possible to simply copy the framework for each document, but that does not seem right).
> 
> - v0.0.4.0, March 2018

---

> I realized, that compiling the MD template to LaTeX may not be optimal, and I will probably try to tweak the LaTeX tamplate instead. My goal is to make all the settings done by YAML variable declarations, so that I wouldn't have to touch LaTeX every time.
> 
> Moreover, when writing the example section, I realized, that writing tables in MD isn't user friendly at all, and I would like to seek another solution.
> 
> - v0.0.3.0, February 2018

---

> I have just finished the first working verion of the framework, and will test it on a real example soon. When that happens, I will probably update the tool with some fixes, or additional options.
> 
> I am quite happy with the results so far, with the only exception being the template format. I wanted the template to be written in MD as well and to be translated to LaTeX during the compillation, but there were errors, and that's why I left the template in LaTeX. I will try to look into it later.
> 
> - v0.0.1.0, February 2018

\pagebreak