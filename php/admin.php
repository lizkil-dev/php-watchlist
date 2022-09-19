
<?php

#Unterseiten zur Bearbeitung der Termine steuern

if(isset($_GET["unterseite"]))
{
	switch($_GET["unterseite"])
	{
		case "new_movie":		include("new_movie.php");		break;
		case "update_movie";	include("update_movie.php");	break;
		case "delete_movie": 	include("delete_movie.php"); 	break;
		
	}
}
else
{
	include("movielist.php");
}


