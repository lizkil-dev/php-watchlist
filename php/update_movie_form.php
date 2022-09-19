<?php
 $genrelist = ["Action", "Drama", "Comedy", "SciFi", "Romance", "Thriller", "Adventure",
			  "Satire", "Fantasy", "Horror", "Historical", "Biopic", "Animation", "Documentary"];
			  
 $diffgenres = array_diff($genrelist, $genres);
?>

<form class="form" method='post' enctype="multipart/form-data">

<h2>Update Movie</h2>
<div class="form-input">
<span>Title</span></br>
<input type="text" name="title" value="<?= $dataTitle['title'];?>" /><br />
</div>

<div class="form-input">
<span>Year</span></br>
<input type="text" name="year" value="<?= $dataTitle['year'];?>" /><br />
</div>

<div class="form-input">
<span>Directed By</span></br>
<input type="text" name="directedBy[]" value="<?= implode(", ", $dirname);?>"/><br />
</div>

<div class="form-input">
<span>Cast</span></br>
<input type="text" name="cast[]" value="<?= implode(", ", $cast);?>"/><br />
</div>

<div class="form-input">
<span>Language</span></br>
<input type="text" name="language" value="<?= $lanname;?>"/><br />
</div>

<div class="form-input">
<span>Genres</span></br>
<select name="genres[]" id="genre-select" multiple size="15">
    <?php
	foreach($genres as $selectedgenre)
	{
		echo '<option selected value="'.$selectedgenre.'">'.$selectedgenre.'</option>';
	}
	foreach($diffgenres as $diffgenre)
	{
		echo '<option value="'.$diffgenre.'">'.$diffgenre;
	}
	?>
</select><br /> 
</div>

<div class="form-input">
<span>Tags</span></br>
<input type="text" name="tags[]" value="<?= implode(", ", $tags);?>" /><br />
</div>

<br />
<input type="submit" name="update_movie" value="Update Movie" />


</form>