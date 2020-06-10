<?php require_once __DIR__ . '/_header.php'; ?>
<?php require_once __DIR__ . '/menu.php'; ?>


<?php
//prikaz svih opcija koje admin ima
?>

<p>
Add a new movie
<br>
<form action="get" action="teka.php?rt=movies/newmovie"></form>
Title:
<input type="text" id="newtitle">
<br>
Year: 
<input type="text" id="newyear">
<br>
Genre: 
<input type="text" id="newgenre">
<br>
Director:
<input type="text" id="newdirector">
<br>
Cast: 
<input type="text" id="newcast">
<br>
<button type="submit" id="newmovie">Add!</button>
</form>
</p>
<p>
Erase users
<input type="text" value="search users">
<button id="eraseuser">Erase!</button>
</p>
<p>
Erase comments
<input type="text" value="search comments">
<button id="eraseuser">Erase!</button>
</p>


<?php require_once __DIR__ . '/_footer.php'; ?>