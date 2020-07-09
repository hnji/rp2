<?php require_once __DIR__ . '/_header.php'; ?>
<?php require_once __DIR__ . '/menu.php'; ?>



<h3> <?php echo $title; ?> </h3>
<p>username: <?php echo $username; ?></p>

<br>

<h4>Watchlist:</h4>
<?php
if( $emptylist === 'Your Watchlist is empty!')
    echo $emptylist;
else
{
    echo '<ul>'; 

   foreach( $movieList as $movie )
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
        '</li>';
    }

    echo '</ul>';    
}

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
<br>       
<br>

<form method="post" action="teka.php?rt=admin/logout">
<button type="submit" name="logout">Log out</button>
</form>

<?php require_once __DIR__ . '/_footer.php'; ?>

