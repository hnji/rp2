<?php require_once __DIR__ . '/_header.php'; ?>
<?php require_once __DIR__ . '/menu.php'; ?>

<ul> 
<?php
//ispis 5 najbolje ocijenjenih filmova

echo '<h3>' . $title . '</h3>';

echo '<ol>';
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
    'Average rating: ' .
    $movie->average_rating .
    '<br>' .
    '<br>' .
    '</li>';
}
echo '</ol>';

    ?>
        
</ul>

<?php require_once __DIR__ . '/_footer.php'; ?>
