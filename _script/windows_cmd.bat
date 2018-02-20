:: Windows stuff required for the cycle
setlocal ENABLEDELAYEDEXPANSION

:: CONFIGURE SCRIPT VARIABLES
SET extension=pdf
SET result_filename=result
SET template=template.tex

:: metadata
SET METADATA=../metadata/metadata.yaml
SET BIBLIOGRAPHY=../metadata/bibliography.bib

:: template
SET TEMPLATE_LATEX=../template/%template%
SET METADATA=%METADATA% ../template/style_metadata.yaml
:: SET STYLE=../template/style_epub_css.css

SET OUTPUT=../_output/%result_filename%.%extension%


:: CREATE LISTS OF FILES
:: Read list of all chapters and save it to temporary file
:: Will result in a file with one filename per line
:: TODO: conditional loading: if the file exists, read it and do not delete it, so that user can declare order of the chapters
SET FILENAMES=../_temp/filenames.txt
(dir "../chapters/*.md" /B) > %FILENAMES%

:: Iterate over list of chapters to form a string containing relative filepaths
:: Will result in a string containing paths to all files, separated by spaces
SET CHAPTERS=
for /f %%i in (%FILENAMES%) do (
    SET CHAPTERS=!CHAPTERS! ../chapters/%%i
)

:: Output used filenames
echo filenames are %CHAPTERS%

:: PREPARE LATEX TEMPLATE
:: TODO: compile markdown template to latex
:: SET TEMPLATE_MD=../template/template.md
:: pandoc %METADATA% %TEMPLATE_MD% -o %TEMPLATE_LATEX% -s


:: COMPILE OUTPUT
:: Pass all the files to pandoc, alongside with additional parameters
pandoc %METADATA% %CHAPTERS% --template=%TEMPLATE_LATEX% -o %OUTPUT% -s

:: TODO: --filter pandoc-citeproc  (https://www.soimort.org/notes/161117/ ; http://pandoc.org/demo/example19/Extension-citations.html)

:: REMOVE TEMPORARY FILES
for /d %%G in ("./tex*") do rd /s /q "%%~G"
del "../_temp/*"
endlocal