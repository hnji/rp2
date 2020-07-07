<?php require_once __DIR__ . '/_header.php'; ?>
<?php require_once __DIR__ . '/menu.php'; ?>

<ul> 
<?php
//svi filmovi - kad klikneš odeš na stranicu filma, al možemo napravit i da na hover se prikažu ostale info

echo '<h3>' . $title . '</h3>';

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
    'Average rating: ' .
    $movie->average_rating .
    '<br>' .
    '</li>';
}
echo '</ul>';

    ?>
        
</ul>

<?php require_once __DIR__ . '/_footer.php'; ?>