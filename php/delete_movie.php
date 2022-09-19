 <?php

# mysqli_report(MYSQLI_REPORT_OFF);

if(isset($_POST["delete_movie_yes"]))
{
	include("load_movie_data.php");
	
	mysqli_query($link, "delete from movies
					where	
					movieID = $movieID");
					
	echo "<h3 class='green'>The movie has been removed from the list.</h3>";
	echo "<br />";
	echo '<h3><a href="?page=admin">Back to the movielist</a></h3>';	
	exit;
} 
else if(isset($_POST["delete_movie_no"]))
{
	include("load_movie_data.php");
	
	header("Location: ?page=admin");
}
else
{
	include("load_movie_data.php");
	include("delete_confirm.php");
}
?>
