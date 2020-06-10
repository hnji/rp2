<?php require_once __DIR__ . '/_header.php'; ?>
<?php require_once __DIR__ . '/menu.php'; ?>

<?php
//prikaz jednog filma
//sta sve prikazujemo, kojim redom?
//title, year, genre, director, cast, rating, reviews?

echo
    '<ul>' . 
    '<li>' .
    $movie->title .
    '</li>' .
    '<li>Rating: ' .
    $movie->rating .
    '</li>' .
    '<li>Year: ' .
    $movie->year .
    '</li>' .
    '<li>Genre: ' .
    $movie->genre .
    '</li>' .
    '<li>Director: ' .
    $movie->director .
    '</li>' .
    '</ul>';


//cast
    foreach ( $castList as $cast )
    {
        
        echo 
            '<p>' . 
            $cast[$i++] . ' ' .
            '<br>' .
            '</p>';
    }

//lista svih reviewova za pojedini film

    foreach ( $reviewList as $review )
    {
        
        echo 
            '<p>' . 
            $users[$i++] . ' ' .
            $review->date .
            '<br>' .
            $review->content .
            '<br>' .
            '</p>';
    }
?>
<br>
<label for="newreview">
Write a review:
<br>
<form method="post" action="teka.php?rt=movies/newreview">
<textarea name="content" cols="10" rows="10"></textarea>
</label>
<br>
<button type="submit" name="review">Send your review!</button>
</form>



<?php require_once __DIR__ . '/_footer.php'; ?>