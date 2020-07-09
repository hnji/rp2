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
<ol> 
<?php

   foreach( $movieList as $movie ){
    echo
    '<li>' .
    '<form method="post" action="teka.php?rt=movies/movie">' .
    '<input type="submit" name="movie_title" value="' .
    $movie->title .
    '" />' .
    '<input type="hidden" name="movie_id" value="' .
    $movie->id_movie .
    '" />' .
    '</form>' .
    '</li>';
    
}
    ?>
        
</ol>

<?php
echo '<h4>Your ratings:</h4>';

if( $emptyratings === "You haven't rated any movies!" )
    echo $emptyratings;
else
{
    echo '<ul>'; 
$i = 0;
   foreach( $ratedMoviesList as $movie )
   {
        echo
        '<li>' .
        '<form method="post" action="teka.php?rt=movies/movie">' .
        '<input type="submit" name="movie_title" value="' .
        $movie->title .
        '" />' .
        '<input type="hidden" name="movie_id" value="' .
        $movie->id_movie .
        '" />' .
        '</form>' .
        'Your rating: ' .
        $ratingsList[$i++] .
        '</li>';
    }

    echo '</ul>';    
}
?>


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

<p>
<h4>Make another user admin to help you take care of Teka</h4>
<form method="post" action="teka.php?rt=admin/addadmin">
<input type="text" name="new_admin">
<button type="submit" name="addadmin">Add admin!</button>
</form>
</p>
<span> <?php echo $info; ?> </span>
<br>


<form method="post" action="teka.php?rt=admin/logout">
<button type="submit" name="logout">Log out</button>

</form>

<?php require_once __DIR__ . '/_footer.php'; ?>