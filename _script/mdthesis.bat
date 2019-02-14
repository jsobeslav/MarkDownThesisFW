IF NOT "%1"=="" (
	SET DOCUMENT=%1
) ELSE ( SET DOCUMENT=.)

cls

php %~p0mdthesis.php %CD%/%DOCUMENT% %2 %3 %4 %5 %6 %7 %8 %9