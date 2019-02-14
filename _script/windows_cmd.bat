:: REFERENCES
:::: see [1] https://pandoc.org/MANUAL.html#description



:: CONFIGURE SCRIPT VARIABLES

:: Document subfolder in /documents
set DOCUMENT=StoryboardAppDocs

:: Template subfolder in /templates
set TEMPLATE=plain

:: Output extension; see [1] for possible output formats,
:: 	  but please note that the framework is currently only tested for pdf
set EXTENSION=pdf



:: DECLARE FILE LOCATIONS

:: Save references to all directories to make the script more readable
cd ..
set DIR_ROOT=%cd%
set DIR_SCRIPT=%DIR_ROOT%/_script
set DIR_TEMP=%DIR_ROOT%/_script/_temp
set DIR_DOCUMENTS=%DIR_ROOT%/documents
set DIR_CURRENT_DOCUMENT=%DIR_DOCUMENTS%/%DOCUMENT%
set DIR_TEMPLATES=%DIR_ROOT%/templates
set DIR_CURRENT_TEMPLATE=%DIR_TEMPLATES%/%TEMPLATE%
cd %DIR_SCRIPT%

:: Metadata files
:: current document metadata
set METADATA=%DIR_CURRENT_DOCUMENT%/metadata/metadata_content.yaml
:: bibliography path is declared in the yaml file

:: current template metadata
set METADATA=%METADATA% %DIR_CURRENT_TEMPLATE%/metadata_style.yaml
:: set STYLE=../templates/%TEMPLATE%/style_epub_css.css
:: epub_style is not neeeded at the moment, and citation_style path is declared in the yaml file

:: Original template files
set TEMPLATE_DOCUMENT_SRC=%DIR_CURRENT_TEMPLATE%/template_document.tex
set TEMPLATE_CHAPTER_SRC=%DIR_CURRENT_TEMPLATE%/template_chapter.tex

:: Set the output file location to the directory root, and its name after the root as well
set OUTPUT=%DIR_CURRENT_DOCUMENT%/%DOCUMENT%.%EXTENSION%



:: TEMP SETTINGS

:: Development
:: set to true if you don't want to actually produce the PDF
set DRY_RUN=false
:: set to true if you don't want to drop temp files
set KEEP_TEMP=true

:: Windows stuff required for accessing variables within for-cycle
setlocal ENABLEDELAYEDEXPANSION

:: Make temp folder, if neccessary
if not exist %DIR_TEMP% (
	cd %DIR_SCRIPT%
	mkdir _temp
)

:: Make a file containing only a newline for precompilation process
:: 	 it is necessary to append a newline between chapter file and metadata block,
::   so that it gets formatted properly
set SPACE_FILE=%DIR_TEMP%/space.md
echo. > %SPACE_FILE%



:: PRECOMPILE TEMPLATES

:: It is necessary to remove extra newlines, tabs, and comments from template files
set TEMPLATE_DOCUMENT=%DIR_TEMP%/template_document.tex
set TEMPLATE_CHAPTER=%DIR_TEMP%/template_chapter.tex

:: copy original files to temp
robocopy %DIR_CURRENT_TEMPLATE% %DIR_TEMP%

:: for both templates
:: cd %DIR_TEMP%


:: UGLY EXPERIMENTAL SHIT

:: remove comment lines
:: powershell -Command "(Get-Content template_document.tex) -replace('%%.*', '') | Set-Content template_document.tex"
:: powershell -Command "(Get-Content template_document.tex) -replace(' +',' ') | Set-Content template_document.tex"
:: powershell -Command "(Get-Content template_document.tex) -replace(\"`t\",'') | Set-Content template_document.tex"
:: powershell -Command "(Get-Content template_document.tex) -join '###' -replace('###\\', '&&&\') -split '&&&' -replace('###', '') | Set-Content template_document.tex"

:: powershell -Command "(Get-Content template_chapter.tex) -replace('%%.*', '') | Set-Content template_chapter.tex"
:: powershell -Command "(Get-Content template_chapter.tex) -replace(' +',' ') | Set-Content template_chapter.tex"
:: powershell -Command "(Get-Content template_chapter.tex) -replace(\"`t\",'') | Set-Content template_chapter.tex"
:: powershell -Command "(Get-Content template_chapter.tex) -join '###' -replace('###\\', '&&&\') -split '&&&' -replace('###', '') | Set-Content template_chapter.tex"


:: remove comments
::powershell -Command "(Get-Content template_chapter.tex) -replace('%%.*', '') | Set-Content template_chapter.tex"
:: remove all newlines and tabs
::powershell -Command "(Get-Content template_chapter.tex) -replace(\"[`n`t]\", '') -join '' | Set-Content template_chapter.tex"
:: append new newlines after backslash character = beginning of LaTeX command
::powershell -Command "(Get-Content template_chapter.tex) -replace('\\','###\') -split '###' | Set-Content template_chapter.tex"

::powershell -Command "(Get-Content template_document.tex) -replace('%%.*', '') | Set-Content template_document.tex"
::powershell -Command "(Get-Content template_document.tex) -replace(\"[`n`t]\", '') -join '' | Set-Content template_document.tex"
::powershell -Command "(Get-Content template_document.tex) -replace('\\','###\') -split '###' | Set-Content template_document.tex"





:: PRECOMPILE CHAPTERS

:: Read list of all chapters and save it to temporary file
:: Will result in a file with one filename per line
:: TODO: conditional loading: if there is filenames.txt file in /metadata folder, read it and do not delete it, so that user can declare order of the chapters manually
set FILENAMES=%DIR_TEMP%/filenames.txt
(dir "%DIR_CURRENT_DOCUMENT%/chapters"\*.md /B) > %FILENAMES%

:: Iterate over list of chapters
:: Precompile each file and append relative filepath to the final pandoc source files argument
:: Will result in a string containing paths to all precompiled files, separated by spaces
set CHAPTERS=
for /f %%i in (%FILENAMES%) do (
	set FILENAME=%%i
	:: first alpha-precompile the metadata using the chapter as both source and template to replace variables within itself
	:: ORIGINAL: pandoc %DIR_CURRENT_DOCUMENT%/chapters/!FILENAME! %SPACE_FILE% %METADATA% --template=%DIR_CURRENT_DOCUMENT%/chapters/!FILENAME! -o %DIR_TEMP%/alpha_!FILENAME!

	:: then beta-precompile the alpha-precompiled file with template_chapter template to format it
	:: ORIGINAL: pandoc %DIR_TEMP%/alpha_!FILENAME! %SPACE_FILE% %METADATA% --template=%TEMPLATE_CHAPTER% -o %DIR_TEMP%/beta_!FILENAME!
    :: save beta file reference
    :: ORIGINAL: set CHAPTERS=!CHAPTERS! %DIR_TEMP%/beta_!FILENAME!

	:: pandoc %DIR_CURRENT_DOCUMENT%/chapters/!FILENAME! %SPACE_FILE% %METADATA% --template=%TEMPLATE_CHAPTER% -o %DIR_TEMP%/beta_!FILENAME!
    set CHAPTERS=!CHAPTERS! %DIR_CURRENT_DOCUMENT%/chapters/!FILENAME!
)



:: COMPILE OUTPUT

:: Output used filenames
echo metadata files are %METADATA%
echo chapter files are %CHAPTERS%
echo template folder is set to %TEMPLATE%

if not %DRY_RUN%==true (
	:: Change directory to the document
	cd %DIR_CURRENT_DOCUMENT%/chapters

	:: Pass all the loaded files to pandoc, alongside with additional parameters
	pandoc %METADATA% %CHAPTERS% --filter pandoc-citeproc --template=%TEMPLATE_DOCUMENT_SRC% -o %OUTPUT% -s
)



:: REMOVE TEMPORARY FILES

if not %KEEP_TEMP%==true (
	:: if TeX compilation failed, remove MiKTeX temp files from /chapters
	cd %DIR_CURRENT_DOCUMENT%/chapters
	for /d %%G in ("./tex*") do rd /s /q "%%~G"

	:: Change directory back to script and remove temp folder
	cd %DIR_SCRIPT%
	del /q ".\_temp\"*
)

endlocal