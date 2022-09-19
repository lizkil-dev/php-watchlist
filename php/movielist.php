<?php
echo "<div class='container'>";
echo "<table class='table'>";
echo "<tr class='tablehead'>";	# neue zeile
echo "<th>Title</th>"; # neue spalte
echo "<th>Year</th>";
echo "<th>Directed By</th>"; # neue spalte
echo "<th>Cast</th>"; # neue spalte
echo "<th>Language</th>";
echo "<th>Genres</th>";
echo "<th>Tags</th>";		
echo "</tr>";


$responseTitle = mysqli_query($link, 
"select * from movies "
);

$cast = [];

// echo "<pre>";
// print_r($responseTitle);
// echo "</pre>";
// die();

// print_r($data);

// echo "<div>".$data["title"].", " .$data["year"]."</div>";

while($dataTitle = mysqli_fetch_array($responseTitle))
 { 
	#Titel und Jahr auslesen
	echo "<tr>";
	// echo "<td name=".$dataTitle["title"]."><a href='?seite=update_movie&id=".$dataTitle['movieID']."'>".$dataTitle["title"]."</a></td>";
	echo "<td class='title' name=".$dataTitle["title"].">".$dataTitle["title"]."</td>";
	echo "<td>".$dataTitle["year"]."</td>";
	
	
	#Director(s) auslesen
	$responseDir = mysqli_query($link, 
	"select * from moviedirectedby JOIN directors
	ON
	moviedirectedby.movieFK =". $dataTitle["movieID"]."
	AND
	moviedirectedby.directorFK = directors.directorID");
	
	$dirname = [];
	while($dataDir = mysqli_fetch_array($responseDir))
	{
		// $dirname[] = "<a href='?'>".$dataDir["directorname"]."</a>";	
		$dirname[] = "<span>".$dataDir["directorname"]."</span>";	
	}
	echo "<td>".implode(", ", $dirname)." "."</td>";
	
		#Actors auslesen
	$responseAct = mysqli_query($link, 
	"select * from cast JOIN actors
	ON
	cast.movieFK =". $dataTitle["movieID"]."
	AND
	cast.actorFK = actors.actorID");
	
	$cast = [];	
	while($dataAct = mysqli_fetch_array($responseAct))
	{
		// $cast[] = "<a href='?'>".$dataAct["actorname"]."</a>";			
		$cast[] = "<span>".$dataAct["actorname"]."</span>";	
	}	
	echo "<td>".implode(", ", $cast)." "."</td>";
	
	#Language auslesen
	$responseLan = mysqli_query($link, 
	"select * from movielanguages JOIN language
	ON
	movielanguages.movieFK = ". $dataTitle["movieID"]."
	AND
	movielanguages.languageFK = language.languageID");
		
	while($dataLan = mysqli_fetch_array($responseLan))
	{	
		echo "<td>".$dataLan["languagename"]." "."</td>";
	}
	
	#Genre auslesen
	$responseGen = mysqli_query($link, 
	"select * from moviegenres JOIN genres
	ON
	moviegenres.movieFK = ". $dataTitle["movieID"]."
	AND
	moviegenres.genreFK = genres.genreID");
		
	$genres = [];
	while($dataGen = mysqli_fetch_array($responseGen))
	{	
		// $genres [] = "<a href='?'>".$dataGen["genrename"]."</a>";
		$genres [] = "<span>".$dataGen["genrename"]."</span>";
	}
	echo "<td>".implode(", ", $genres)." "."</td>";
	
	#Tags auslesen
	$responseTag = mysqli_query($link, 
	"select * from movietags JOIN tags
	ON
	movietags.movieFK = ". $dataTitle["movieID"]."
	AND
	movietags.tagFK = tags.tagID");
	
	$tags = [];
	while($dataTag = mysqli_fetch_array($responseTag))
	{	
		// $tags [] = "<a href='?'>".$dataTag["tagname"]."</a>";
		$tags [] = "<span>".$dataTag["tagname"]."</span>";
	}
	echo "<td>".implode(", ", $tags)." "."</td>";
	
	
	echo "<td class='link'><a href='?seite=admin&unterseite=update_movie&id=".$dataTitle['movieID']."'>Update Movie</a></td>";
	echo "<td class='link'><a href='?seite=admin&unterseite=delete_movie&id=".$dataTitle['movieID']."'>Delete Movie</a></td>";
	
	
 }
echo "</table>"; 
echo '<div class="nav2"><a href="?seite=admin&unterseite=new_movie">Add Movie</a></div>';
echo "</div>";
?>
