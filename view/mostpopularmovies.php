<?php require_once __DIR__ . '/_header.php'; ?>
<?php require_once __DIR__ . '/menu.php'; ?>

<ul> 
<?php
//ispis 5 filmova koji su na najviše watchlisti - ispisat broj watchlisti?

echo '<h3>' . $title . '</h3>';

echo '<ol>';
$i = 0;
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
    'Number of people who put this on their Watchlist: ' .
    //$nwatchlistsList[$i++] . ' ' . //nešto ne radi baza hehe
    '<br>' .
    '</li>';
}
echo '</ol>';

    ?>
        
</ul>

<?php require_once __DIR__ . '/_footer.php'; ?>