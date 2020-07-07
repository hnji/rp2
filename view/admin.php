<?php require_once __DIR__ . '/_header.php'; ?>
<?php require_once __DIR__ . '/menu.php'; ?>


<?php
//prikaz svih opcija koje admin ima
?>
<h3> <?php echo $title; ?> </h3>
<p>username: <?php echo $username; ?>
<br>
[admin]
<!-- admin? -->
</p>

<h4>Watchlist:</h2>
<ul> 
<?php

   foreach( $movieList as $movie ){
    echo
    '<ol>' . 
    '<li>' .
    $movie->title .
    '<br>' .
    $movie->rating .
    '</li>' .
    '</ol>';
    
}
    ?>
        
</ul>


<p>
<h4>Add a new movie</h4>
<br>
<form method="post" action="teka.php?rt=admin/newmovie">
Title:
<input type="text" name="newtitle">
<br>
Year: 
<input type="text" name="newyear">
<br>
Genre: 
<input type="text" name="newgenre">
<br>
Director:
<input type="text" name="newdirector">
<br>
Cast: 
<input type="text" name="newcast">
<br>
<button type="submit" name="newmovie">Add!</button>
</form>
</p>

<p>
<h4>Erase users</h4>
<form method="post" action="teka.php?rt=admin/eraseuser">
<input type="text" name="search_users">
<button type="submit" name="eraseuser">Erase!</button>
</form>
</p>

<p>
<h4>Erase comments</h4>
<form method="post" action="teka.php?rt=admin/erasecomment">
<input type="text" name="search_comments">
<button type="submit" name="erasecomment">Erase!</button>
</form>
</p>

<form method="post" action="teka.php?rt=admin/logout">
<button type="submit" name="logout">Log out</button>
</form>

<?php require_once __DIR__ . '/_footer.php'; ?>