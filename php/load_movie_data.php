<?php

$movieID = $_GET['id'];
# echo $movieID;

# get Data from Database

###Title
$responseTitle = mysqli_query($link, "select * from movies
					where movieID = $movieID	
					");

$dataTitle = mysqli_fetch_array($responseTitle);
// print_r($dataTitle);	
// echo "</br>";

###Director(s)
$responseDir = mysqli_query($link, 
					"select * from moviedirectedby JOIN directors
					ON
					moviedirectedby.movieFK = $movieID
					AND
					moviedirectedby.directorFK = directors.directorID");
	
$dirname = [];
while($dataDir = mysqli_fetch_array($responseDir))
{
	$dirname[] = $dataDir["directorname"];
}
// print_r($dirname);
// echo "</br>";

###Actor(s)
$responseAct = mysqli_query($link, 
					"select * from cast JOIN actors
					ON
					cast.movieFK = $movieID
					AND
					cast.actorFK = actors.actorID");
	
$cast = [];	
while($dataAct = mysqli_fetch_array($responseAct))
{
	$cast[] = $dataAct["actorname"];			
}	
// print_r($cast);
// echo "</br>";

#####Language 
$responseLan = mysqli_query($link, 
					"select * from movielanguages JOIN language
					ON
					movielanguages.movieFK = $movieID
					AND
					movielanguages.languageFK = language.languageID");
		
$dataLan = mysqli_fetch_array($responseLan);
$lanname = $dataLan["languagename"];
// print_r($lanname);	
// echo "</br>";
	

#####Genre 
$responseGen = mysqli_query($link, 
					"select * from moviegenres JOIN genres
					ON
					moviegenres.movieFK = $movieID
					AND
					moviegenres.genreFK = genres.genreID");
		
$genres = [];
while($dataGen = mysqli_fetch_array($responseGen))
{	
	$genres [] = $dataGen["genrename"];
}
// print_r($genres);	
// echo "</br>";
	
#####Tags 
$responseTag = mysqli_query($link, 
					"select * from movietags JOIN tags
					ON
					movietags.movieFK = $movieID
					AND
					movietags.tagFK = tags.tagID");
	
$tags = [];
while($dataTag = mysqli_fetch_array($responseTag))
{	
	$tags[] = $dataTag["tagname"];
}
	
// print_r($tags);	
// echo "</br>";

?>
