:: REFERENCES
:: see [1] https://pandoc.org/MANUAL.html#description



:: CONFIGURE SCRIPT VARIABLES
:: Output extension; see [1] for possible output formats, but please note that the framework is currently only tested for pdf
set EXTENSION=pdf
:: Template subfolder in /templates
set TEMPLATE=default



:: TEMP SETTINGS
:: Windows stuff required for accessing variables within for-cycle
setlocal ENABLEDELAYEDEXPANSION

:: Make temp folder, if neccessary
set TEMP_FOLDER=_temp
if not exist ./%TEMP_FOLDER% mkdir $TEMP_FOLDER%

:: Make a file containing only a newline for precompilation process
:: it is necessary to append a newline between chapter file and metadata block,
::  so that it gets formatted properly
set SPACE_FILE=./%TEMP_FOLDER%/space.md
echo. > %SPACE_FILE%




:: DECLARE FILE LOCATIONS
:: Metadata files
set METADATA=../metadata/metadata_content.yaml
:: bibliography path is declared in the yaml file

:: Template and style files
set METADATA=%METADATA% ../templates/%TEMPLATE%/metadata_style.yaml
:: set STYLE=../templates/%TEMPLATE%/style_epub_css.css
:: epub_style is not neeeded at the moment, and citation_style path is declared in the yaml file
set TEMPLATE_DOCUMENT=../templates/%TEMPLATE%/template_document.tex
set TEMPLATE_CHAPTER=../templates/%TEMPLATE%/template_chapter.tex

:: Set the output file location to the directory root, and its name after the root as well
for %%* in (..) do set RESULT_FILENAME=%%~nx*
set OUTPUT=../%RESULT_FILENAME%.%EXTENSION%



:: PRECOMPILE CHAPTERS
:: Read list of all chapters and save it to temporary file
:: Will result in a file with one filename per line
:: TODO: conditional loading: if there is filenames.txt file in /metadata folder, read it and do not delete it, so that user can declare order of the chapters manually
set FILENAMES=../_script/%TEMP_FOLDER%/filenames.txt
(dir "../chapters/*.md" /B) > %FILENAMES%

:: Iterate over list of chapters
:: Precompile each file and append relative filepath to the final pandoc source files argument
:: Will result in a string containing paths to all precompiled files, separated by spaces
set CHAPTERS=
for /f %%i in (%FILENAMES%) do (
	set FILENAME=%%i
	:: first alpha-precompile the metadata using the chapter as both source and template to replace variables within itself
	pandoc ../chapters/!FILENAME! %SPACE_FILE% %METADATA% --template=../chapters/!FILENAME! -o ./%TEMP_FOLDER%/alpha_!FILENAME!
	:: then beta-precompile the alpha-precompiled file with template_chapter template to format it
	pandoc ./%TEMP_FOLDER%/alpha_!FILENAME! %SPACE_FILE% %METADATA% --template=%TEMPLATE_CHAPTER% -o ./%TEMP_FOLDER%/beta_!FILENAME!
    set CHAPTERS=!CHAPTERS! ./%TEMP_FOLDER%/beta_!FILENAME!
)



:: COMPILE OUTPUT
:: Output used filenames
echo metadata files are %METADATA%
echo chapter files are %CHAPTERS%
echo template folder is set to %TEMPLATE%

:: Pass all the loaded files to pandoc, alongside with additional parameters
pandoc %METADATA% %CHAPTERS% --filter pandoc-citeproc --template=%TEMPLATE_DOCUMENT% -o %OUTPUT% -s



:: REMOVE TEMPORARY FILES
for /d %%G in ("./tex*") do rd /s /q "%%~G"
del /q ".\_temp\"*
endlocal