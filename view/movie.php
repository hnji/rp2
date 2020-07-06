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

//lista svih komentara za pojedini film

    foreach ( $commentList as $comment )
    {
        
        echo 
            '<p>' . 
            $users[$i++] . ' ' .
            $comment->date .
            '<br>' .
            $comment->content .
            '<br>' .
            '</p>';
    }
?>
<br>
<label for="newreview">
Write a comment:
<br>
<form method="post" action="teka.php?rt=movies/newcomment">
<textarea name="content" cols="10" rows="10"></textarea>
</label>
<br>
<button type="submit" name="comment">Send your comment!</button>
</form>



<?php require_once __DIR__ . '/_footer.php'; ?>