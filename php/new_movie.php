<?php

mysqli_report(MYSQLI_REPORT_OFF);

if(isset($_POST["save_new_movie"]))
{
	#Auswertung
	// echo "<pre>";
	// print_r($_POST);
	// echo "</pre>";
	
		
	$title 			= $_POST["title"];
	$year 			= $_POST["year"]; 
	$directedBy 	= $_POST["directedBy"];
	$cast			= $_POST["cast"];	
	$language		= $_POST["language"];
	$genre			= $_POST["genres"];
	$tag			= $_POST["tags"];
	
	
	#############Datenbank#################
	
	#######Titel und Jahr speichern#######
	mysqli_query($link, "insert into movies 
				(title, year)
				values
				('$title', '$year')
				");
				
	#check if entry already exists		
	if($link->affected_rows === -1)
	{
		echo "<h1 style='color:blue;'>Title already exists</h1>";		
	}
	else
	{
		$movieID = $link->insert_id; # primärschlüssel;
	}
	
	
	########Director & directed by##########
	
	#If entry has multiple names
	
	#Split names into array
	$director_string = implode(", ", $directedBy);
	$directors = explode(", ", $director_string);
	
	#store each name seperately with own id
	if(count($directors) > 1)
	{	
		foreach($directors as $directorname)
		{
			mysqli_query($link, "insert into directors
				(directorname)
				values
				('$directorname')
				");	
			$directorID = $link->insert_id; # primärschlüssel
			
			#if one name already exists
			if($link->affected_rows === -1)
			{
				#directorID abfragen
				$responseDir = mysqli_query($link, 
				"select directorID from directors
				where '$directorname' = directorname");
				#und in Variable speichern
				$rowDir = mysqli_fetch_array($responseDir);
				$directorID = $rowDir['directorID'];
		
			
				#directorID zusammen mit movieID abspeichern
				mysqli_query($link, 
				"insert into moviedirectedby
				(directorFK, movieFK)
				values
				('$directorID', '$movieID')
				");	
			}
			#if names don't exist in database
			else
			{	
				mysqli_query($link, "insert into moviedirectedby
					(directorFK, movieFK)
					values
					('$directorID', '$movieID')
					");			
			}
		}
	}
				
	#if entry has only one name
	else 
	{
		mysqli_query($link, "insert into directors
				(directorname)
				values
				('$directedBy[0]')
				");	
		
		$directorID = $link->insert_id; # primärschlüssel;		
		
		#check if entry already exists	
		if($link->affected_rows === -1)
		{
			#directorID abfragen
			$responseDir = mysqli_query($link, 
			"select directorID from directors
			where '$directedBy[0]' = directorname");
			#und in Variable speichern
			$rowDir = mysqli_fetch_array($responseDir);
			$directorID = $rowDir['directorID'];
		
			
			#directorID zusammen mit movieID abspeichern
			mysqli_query($link, 
			"insert into moviedirectedby
			(directorFK, movieFK)
			values
			('$directorID', '$movieID')
			");		
		}	
		#if entry doesn't exist already
		else
		{
			mysqli_query($link, "insert into moviedirectedby
				(directorFK, movieFK)
				values
				('$directorID', '$movieID')
				");
		}
	}
		
	##########Actors & Cast###############
	
	#If entry has multiple names
	
	#Split names into array
	$actor_string = implode(", ", $cast);
	$actors = explode(", ", $actor_string);
	
	#store each name seperately with own id
	if(count($actors) > 1)
	{	
		foreach($actors as $actorname)
		{
			mysqli_query($link, "insert into actors
				(actorname)
				values
				('$actorname')
				");
			$actorID = $link->insert_id; # primärschlüssel
			
			#if one name already exists
			if($link->affected_rows === -1)
			{
				#actorID abfragen
				$responseAct = mysqli_query($link, 
				"select actorID from actors
				where '$actorname' = actorname");
				#und in Variable speichern
				$rowAct = mysqli_fetch_array($responseAct);
				$actorID = $rowAct['actorID'];
	
		
				#actorID zusammen mit movieID abspeichern
				mysqli_query($link, 
				"insert into cast
				(actorFK, movieFK)
				values
				('$actorID', '$movieID')
				");	
			}
			#if entrys don't exist in database
			else
			{	
				mysqli_query($link, "insert into cast
					(actorFK, movieFK)
					values
					('$actorID', '$movieID')
					");					
			}
		}
	}		
	#if entry has only one name
	else
	{		
		mysqli_query($link, "insert into actors
				(actorname)
				values
				('$cast[0]')
				");
		
		$actorID = $link->insert_id; # primärschlüssel
				
		#check if entry already exists	
		if($link->affected_rows === -1)
		{
			#actorID abfragen
			$responseAct = mysqli_query($link, 
			"select actorID from actors
			where '$cast[0]' = actorname");
			#und in Variable speichern
			$rowAct = mysqli_fetch_array($responseAct);
			$actorID = $rowAct['actorID'];
					
			#actorID zusammen mit movieID abspeichern
			mysqli_query($link, 
			"insert into cast
			(actorFK, movieFK)
			values
			('$actorID', '$movieID')
			");	
		}	
		#if entry doesn't exist in database
		else
		{	
			mysqli_query($link, "insert into cast
				(actorFK, movieFK)
				values
				('$actorID', '$movieID')
				");					
		}	
	}
	 
 
	########### Language ########### 
	#(entrys will only have one name)
	
	mysqli_query($link, "insert into language
			(languagename)
			values
			('$language')
			");
		
	$languageID = $link->insert_id; # primärschlüssel
				
	#check if entry already exists	
	if($link->affected_rows === -1)
	{
		#languageID abfragen
		$responseLan = mysqli_query($link, 
		"select languageID from language
		where '$language' = languagename");
		#und in Variable speichern
		$rowLan = mysqli_fetch_array($responseLan);
		$languageID = $rowLan['languageID'];
				
		#languageID zusammen mit movieID abspeichern
		mysqli_query($link, 
		"insert into movielanguages
		(languageFK, movieFK)
		values
		('$languageID', '$movieID')
		");	
	}	
	#if entry doesn't exist in database
	else
	{	
		mysqli_query($link, "insert into cast
			(languageFK, movieFK)
			values
			('$languageID', '$movieID')
			");					
	}
			

	#############Genres##############
	
	#If entry has multiple names
	
	#Split entries into array
	$genre_string = implode(", ", $genre);
	$genres = explode(", ", $genre_string);
	
	#store each entry seperately with own id
	if(count($genres) > 1)
	{	
		foreach($genres as $genrename)
		{
			mysqli_query($link, "insert into genres
				 (genrename)
				 values
				 ('$genrename')
				 ");	
			$genreID = $link->insert_id; # primärschlüssel
			
			#if one name already exists
			if($link->affected_rows === -1)
			{
				#genreID abfragen
				$responseGen = mysqli_query($link, 
				"select genreID from genres
				where '$genrename' = genrename");
				#und in Variable speichern
				$rowGen = mysqli_fetch_array($responseGen);
				$genreID = $rowGen['genreID'];
		
			
				#genreID zusammen mit movieID abspeichern
				mysqli_query($link, 
				"insert into moviegenres
				(genreFK, movieFK)
				values
				('$genreID', '$movieID')
				");	
			}
			#if names don't exist in database
			else
			{	
				mysqli_query($link, "insert into moviegenres
					(genreFK, movieFK)
					values
					('$genreID', '$movieID')
					");			
			}
		}
	}				
	#if entry has only one name
	else 
	{
		mysqli_query($link, "insert into genres
				(genrename)
				values
				('$genres[0]')
				");	
		
		$genreID = $link->insert_id; # primärschlüssel;		
		
		#check if entry already exists	
		if($link->affected_rows === -1)
		{
			#ID abfragen
			$responseGen = mysqli_query($link, 
			"select genreID from genres
			where '$genres[0]' = genrename");
			#und in Variable speichern
			$rowGen = mysqli_fetch_array($responseGen);
			$genreID = $rowGen['genreID'];
		
			
			#ID zusammen mit movieID abspeichern
			mysqli_query($link, 
			"insert into moviegenres
			(genreFK, movieFK)
			values
			('$genreID', '$movieID')
			");		
		}	
		#if entry doesn't exist already
		else
		{
			mysqli_query($link, "insert into moviegenres
				(genreFK, movieFK)
				values
				('$genreID', '$movieID')
				");
		}
	}
	
	
	#############Tags##############
	
	#If entry has multiple names
	
	#Split entries into array
	$tag_string = implode(", ", $tag);
	$tags = explode(", ", $tag_string);
	
	// print_r($tag_string);
	// echo "</br>";
	// print_r($tags);
	
	#store each entry seperately with own id
	if(count($tags) > 1)
	{	
		foreach($tags as $tagname)
		{
			mysqli_query($link, "insert into tags
				 (tagname)
				 values
				 ('$tagname')
				 ");	
			$tagID = $link->insert_id; # primärschlüssel
			
			#if one name already exists
			if($link->affected_rows === -1)
			{
				#tagID abfragen
				$responseTag = mysqli_query($link, 
				"select tagID from tags
				where '$tagname' = tagname");
				#und in Variable speichern
				$rowTag = mysqli_fetch_array($responseTag);
				$tagID = $rowTag['tagID'];
				#tagID zusammen mit movieID abspeichern
				mysqli_query($link, 
				"insert into movietags
				(tagFK, movieFK)
				values
				('$tagID', '$movieID')
				");	
			}
			#if names don't exist in database
			else
			{	
				mysqli_query($link, "insert into movietags
					(tagFK, movieFK)
					values
					('$tagID', '$movieID')
					");			
			}
		}
	}				
	#if entry has only one name
	else 
	{
		mysqli_query($link, "insert into tags
				(tagname)
				values
				('$tags[0]')
				");	
		
		$tagID = $link->insert_id; # primärschlüssel;		
		
		#check if entry already exists	
		if($link->affected_rows === -1)
		{
			#ID abfragen
			$responseTag = mysqli_query($link, 
			"select tagID from tags
			where '$tags[0]' = tagname");
			#und in Variable speichern
			$rowTag = mysqli_fetch_array($responseTag);
			$tagID = $rowTag['tagID'];
		
			
			#ID zusammen mit movieID abspeichern
			mysqli_query($link, 
			"insert into movietags
			(tagFK, movieFK)
			values
			('$tagID', '$movieID')
			");		
		}	
		#if entry doesn't exist already
		else
		{
			mysqli_query($link, "insert into movietags
				(tagFK, movieFK)
				values
				('$tagID', '$movieID')
				");
		}
	}
	
echo "<h3 class='green'>The movie has been succesfully added.</h3>";
echo "<br />";
echo '<h3><a href="?page=admin">Back to the movielist</a></h3>';	
exit;
}


else
{
	# Formular
	include("movie_form.php");
}

?>

