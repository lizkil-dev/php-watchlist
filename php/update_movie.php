<?php
mysqli_report(MYSQLI_REPORT_OFF);

if(isset($_POST["update_movie"]))
{
	// echo "<pre>";
	// print_r($_POST);
	// echo "</pre>";	
		
	include("load_movie_data.php");
	
	$movieID_old = $_GET['id'];
	// print_r($movieID);
	
	
	$title_old 			= $dataTitle["title"];
	$year_old 			= $dataTitle["year"]; 
	$directedBy_old 	= $dirname;
	$cast_old			= $cast;
	$language_old		= $lanname;
	$genres_old			= $genres;
	$tags_old			= $tags;
	

	# Updates
	$title 			= $_POST["title"];
	$year 			= $_POST["year"]; 
		$dirarr			= $_POST["directedBy"];
		$dirstr 		= implode(", ", $dirarr);
	$directedBy		= explode(", ", $dirstr);
		$castarr		= $_POST["cast"];	
		$caststr 		= implode(", ", $castarr);
	$cast			= explode(", ", $caststr);
	$language		= $_POST["language"];
		$genarr			= $_POST["genres"];
		$genstr 		= implode(", ", $genarr);
	$genres			= explode(", ", $genstr);
		$tagarr			= $_POST["tags"];
		$tagstr 		= implode(", ", $tagarr);
	$tags			= explode(", ", $tagstr);
	
	
	####### Update Title ################
	if($title_old !== $title || $year_old !== $year){
		mysqli_query($link, "update movies set 
					title = '$title',
					year = '$year'
					where movieID = $movieID");	
		}

	######## Update Directors ###########
	if($directedBy_old !== $directedBy)		
	{	
		#get old IDs 
		$dirIDsOld = [];
		
		foreach($directedBy_old as $directorname_old)
		{
			$responseDirOld = mysqli_query($link, 
				"select directorID from directors
				where '$directorname_old' = directorname");
			#und in Variable speichern
			$rowDirOld = mysqli_fetch_array($responseDirOld);
			$dirIDsOld[] = $rowDirOld['directorID'];
		}
		#delete old directors 
		foreach($dirIDsOld as $directorID_old)
		{
			mysqli_query($link, "delete from moviedirectedby
						where	
						directorFK = $directorID_old");
		}				
		
		#add new ones 	
		foreach($directedBy as $directorname)
		{	
			mysqli_query($link, "insert into directors
					(directorname)
					values
					('$directorname')
					");	
			$directorID = $link->insert_id; 
			
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
	
	
	#########  Update Cast  ############
	if($cast_old !== $cast)		
	{	
		#get old IDs 
		$castIDsOld = [];
		foreach($cast_old as $actorname_old)
		{
			$responseActOld = mysqli_query($link, 
					"select actorID from actors
					where '$actorname_old' = actorname");
			#und in Variable speichern
			$rowActOld = mysqli_fetch_array($responseActOld);
			$castIDsOld[] = $rowActOld['actorID'];
		}
		
		#delete old ids from cast
		foreach($castIDsOld as $castID_old)
		{
			mysqli_query($link, "delete from cast
						where	
						actorFK = $castID_old");
		}				
		
		#add new ones 		
		foreach($cast as $actorname)
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
				#ID abfragen
				$responseAct = mysqli_query($link, 
					"select actorID from actors
					where '$actorname' = actorname");
					#und in Variable speichern
					$rowAct = mysqli_fetch_array($responseAct);
					$actorID = $rowAct['actorID'];
		
			
				#directorID zusammen mit movieID abspeichern
				mysqli_query($link, "insert into cast
					(actorFK, movieFK)
					values
					('$actorID', '$movieID')
					");	
			}	
			#if names don't exist in database
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
	
	
	######### Update Language #############
	if($language_old !== $language)
	{
		#get old IDs 
		$responseLanOld = mysqli_query($link, 
				"select languageID from language
				where '$language_old' = languagename");
		print_r($responseLanOld);
		#und in Variable speichern
		$rowLanOld = mysqli_fetch_array($responseLanOld);
		$lanID_old = $rowLanOld['languageID'];
		
		#delete old ids from movielanguages
		mysqli_query($link, "delete from movielanguages
						where	
						languageFK = $lanID_old");
		
		#add new language
		
		mysqli_query($link, "insert into language
					(languagename)
					values
					('$language')
					");	
		$languageID = $link->insert_id; # primärschlüssel
		
		#if entry already exists
		if($link->affected_rows === -1)
		{
			#ID abfragen
			$responseLan = mysqli_query($link, 
					"select languageID from language
					where '$language' = languagename");
			#und in Variable speichern
			$rowLan = mysqli_fetch_array($responseLan);
			$lanID = $rowLan['languageID'];
			
			#directorID zusammen mit movieID abspeichern
			mysqli_query($link, "insert into movielanguages
					(languageFK, movieFK)
					values
					('$lanID', '$movieID')
					");				
		}
		#if entry doesn't exist in database
		else
		{	
			mysqli_query($link, "insert into movielanguages
				(languageFK, movieFK)
				values
				('$lanID', '$movieID')
				");			
		}
	}
	
	######## Update Genres #############
	if($genres_old !== $genres)		
	{	
		#get old IDs 
		$genresIDsOld = [];
		foreach($genres_old as $genrename_old)
		{
			$responseGenOld = mysqli_query($link, 
					"select genreID from genres
					where '$genrename_old' = genrename");
			#und in Variable speichern
			$rowGenOld = mysqli_fetch_array($responseGenOld);
			$genresIDsOld[] = $rowGenOld['genreID'];
		}
		
		#delete old ids from moviegenres
		foreach($genresIDsOld as $genreID_old)
		{
			mysqli_query($link, "delete from moviegenres
						where	
						genreFK = $genreID_old");
		}				
		
		#add new ones 		
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
				#get genreID 
				$responseGen = mysqli_query($link, 
						"select genreID from genres
						where '$genrename' = genrename");
				$rowGen = mysqli_fetch_array($responseGen);
				$genreID = $rowGen['genreID'];
		
			
				#save genreID with movieID 
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
	
	####### Update Tags ##########
	
	if($tags_old !== $tags)		
	{	
		#get old IDs 
		$tagsIDsOld = [];
		foreach($tags_old as $tagname_old)
		{
			$responseTagOld = mysqli_query($link, 
					"select tagID from tags
					where '$tagname_old' = tagname");
			$rowTagOld = mysqli_fetch_array($responseTagOld);
			$tagsIDsOld[] = $rowTagOld['tagID'];
		}
		
		#delete old ids 
		foreach($tagsIDsOld as $tagID_old)
		{
			mysqli_query($link, "delete from movietags
						where	
						tagFK = $tagID_old");
		}				
		
		#add new ones 		
		foreach($tags as $tagname)
		{
			mysqli_query($link, "insert into tags
				 (tagname)
				 values
				 ('$tagname')
				 ");	
			$tagID = $link->insert_id; 
			
			#if one name already exists
			if($link->affected_rows === -1)
			{
				#get tagID 
				$responseTag = mysqli_query($link, 
					"select tagID from tags
					where '$tagname' = tagname");
				$rowTag = mysqli_fetch_array($responseTag);
				$tagID = $rowTag['tagID'];
				
				#save tagID with movieID 
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

echo "<h3 class='green'>The movie has been succesfully updated.</h3>";
echo "<br />";
echo '<h3><a href="?page=admin">Back to the movielist</a></h3>';	
exit;
}
#************************************************************************
else 
{
	include("load_movie_data.php");
	include("update_movie_form.php");
}
 
?>
