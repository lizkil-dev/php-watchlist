<form class="form" method='post' enctype="multipart/form-data">

<h2>New Movie</h2>

<div class="form-input">
<span>Title</span></br>
<input type="text" name="title" />
</div>

<div class="form-input">
<span>Year</span></br>
<input type="text" name="year" />
</div>

<div class="form-input">
<span>Directed By</span></br>
<input type="text" name="directedBy[]" />
</div>

<div class="form-input">
<span>Cast</span></br>
<input type="text" name="cast[]" />
</div>

<div class="form-input">
<span>Language</span></br>
<input type="text" name="language" />
</div>

<div class="form-input">
<span>Genres</span></br>
<select name="genres[]" id="genre-select" multiple size="14">
    <option value="">--Please choose at least one option--</option>
    <option value="action">Action</option>
    <option value="drama">Drama</option>
    <option value="comedy">Comedy</option>
    <option value="sciFi">SciFi</option>
    <option value="romance">Romance</option>
    <option value="thriller">Thriller</option>
	<option value="adventure">Adventure</option>
    <option value="satire">Satire</option>
    <option value="Fantasy">Fantasy</option>
    <option value="Horror">Horror</option>
    <option value="Historical">Historical</option>
    <option value="Biopic">Biopic</option>
	<option value="Animation">Animation</option>
    <option value="Documentary">Documentary</option>
</select><br />
</div>

<div class="form-input">
<span>Tags</span></br>
<input type="text" name="tags[]" />
</div>

<br />
<input class="btn" type="submit" name="save_new_movie" value="Add to Database" />


</form>