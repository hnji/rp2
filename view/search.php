<?php require_once __DIR__ . '/_header.php'; ?>
<?php require_once __DIR__ . '/menu.php'; ?>

<?php
//dodati koje su sve opcije za pojedinu kategoriju
?>

Genre: 
<select id="genre">
			<option value="1"></option>
			<option value="2"></option>
			<option value="3"></option>
			<option value="4"></option>
			<option value="5"></option>
			<option value="6"></option>
</select>
<br>
Year: 
<select id="year">
			<option value="1"></option>
			<option value="2"></option>
			<option value="3"></option>
			<option value="4"></option>
			<option value="5"></option>
			<option value="6"></option>
</select>
<br>
Director:
<select id="director">
			<option value="1"></option>
			<option value="2"></option>
			<option value="3"></option>
			<option value="4"></option>
			<option value="5"></option>
			<option value="6"></option>
</select>
<br>
<button type="submit">Search movies!</button>

<?php require_once __DIR__ . '/allmovies.php'; ?>
<?php require_once __DIR__ . '/_footer.php'; ?>