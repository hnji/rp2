<?php require_once __DIR__ . '/_header.php'; ?>
<?php require_once __DIR__ . '/menu.php'; ?>

<?php
//prikaz jednog filma
//sta sve prikazujemo, kojim redom?
//title, year, genre, director, cast, rating, reviews?

echo '<h3>' . $title . '</h3>';

echo
    '<ul>' . 
    '<li>Average rating: ' .
    $movie->average_rating .
    '</li>' .
    '<li>Year: ' .
    $movie->release_year .
    '</li>' .
    '<li>Genre: ' .
    $movie->genre .
    '</li>' .
    '<li>Director: ' .
    $movie->director .
    '</li>' .
    '</ul>';

echo '<br>';

if( !$isOnWatchlist )
{
    echo 
    '<label for="newwatchlist">
    <form method="post" action="teka.php?rt=movies/watchlist">
    <button type="submit" name="watchlist">Add this movie to your Watchlist!</button>
    </label>
    </form>';
    echo '<br>';
}


echo '<h4>' . 'Cast' . '</h4>';
    foreach ( $castList as $cast )
    {
        
        echo 
            '<p>' . 
            $cast . ' ' .
            '<br>' .
            '</p>';
    }

echo '<br>';

echo '<h4>' . 'Comments' . '</h4>';
$i = 0;
    foreach ( $commentList as $comment )
    {        
        echo 
            '<p>' . 
            $usersList[$i++] . ' ' .
            $comment->date .
            '<br>' .
            $comment->content .
            '<br>' .
            '</p>';
    }
?>

<?php 
echo '<br>
<label for="newreview">
Write a comment:
<br>
<form method="post" action="teka.php?rt=movies/newcomment">
<textarea name="content" cols="100" rows="10"></textarea>
</label>
<br>
<button type="submit" name="comment">Send your comment!</button>
</form>';

?>

<?php require_once __DIR__ . '/_footer.php'; ?>

