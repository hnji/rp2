<?php require_once __DIR__ . '/_header.php'; ?>
<?php require_once __DIR__ . '/menu.php'; ?>

<?php
//prikaz jednog filma
//sta sve prikazujemo, kojim redom?
//title, year, genre, director, cast, rating, reviews?

echo '<h3>' . $title . '</h3>';

echo
    '<ul>' . 
    '<li>Average rating: ';
    if( (int) $movie->average_rating === -1)
        echo 'No one has rated this movie yet!';
    else 
        echo '<span id="js_averagerating">' .$movie->average_rating . '</span>';
echo
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

if( $rating !== -2 )
    if( $rating !== -1)
    {
        echo 'Your rating: ' . '<span id="js_yourrating">' . $rating . '</span>';
        echo '
        <h4>Rate this movie:</h4>
        <input type="radio" id="0" name="rating" value="0" class="rating">
        <label for="0">0</label>
        <input type="radio" id="1" name="rating" value="1" class="rating">
        <label for="1">1</label>
        <input type="radio" id="2" name="rating" value="2" class="rating">
        <label for="2">2</label>
        <input type="radio" id="3" name="rating" value="3" class="rating">
        <label for="3">3</label>
        <input type="radio" id="4" name="rating" value="4" class="rating">
        <label for="4">4</label>
        <input type="radio" id="5" name="rating" value="5" class="rating">
        <label for="5">5</label>
        <input type="radio" id="6" name="rating" value="6" class="rating">
        <label for="6">6</label>
        <input type="radio" id="7" name="rating" value="7" class="rating">
        <label for="7">7</label>
        <input type="radio" id="8" name="rating" value="8" class="rating">
        <label for="8">8</label>
        <input type="radio" id="9" name="rating" value="9" class="rating">
        <label for="9">9</label>
        <input type="radio" id="10" name="rating" value="10" class="rating">
        <label for="10">10</label>
        <button type="submit" name="rate" id="rate">Rate!</button>';
    }
    else
    {
        echo 'Your rating: ' . '<span id="js_yourrating">' . "You haven't rated this movie!". '</span>';
        echo '
        <h4>Rate this movie:</h4>
        <input type="radio" id="0" name="rating" value="0" class="rating">
        <label for="0">0</label>
        <input type="radio" id="1" name="rating" value="1" class="rating">
        <label for="1">1</label>
        <input type="radio" id="2" name="rating" value="2" class="rating">
        <label for="2">2</label>
        <input type="radio" id="3" name="rating" value="3" class="rating">
        <label for="3">3</label>
        <input type="radio" id="4" name="rating" value="4" class="rating">
        <label for="4">4</label>
        <input type="radio" id="5" name="rating" value="5" class="rating">
        <label for="5">5</label>
        <input type="radio" id="6" name="rating" value="6" class="rating">
        <label for="6">6</label>
        <input type="radio" id="7" name="rating" value="7" class="rating">
        <label for="7">7</label>
        <input type="radio" id="8" name="rating" value="8" class="rating">
        <label for="8">8</label>
        <input type="radio" id="9" name="rating" value="9" class="rating">
        <label for="9">9</label>
        <input type="radio" id="10" name="rating" value="10" class="rating">
        <label for="10">10</label>
        <button type="submit" name="rate" id="rate">Rate!</button>';
    }

echo '<br><br>';

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

if( $id_u !== -1 ) // user je log in-an
echo
    '<input type="hidden" id="js_user_id" value="' .
    $id_u .
    '" />' .
    '<input type="hidden" id="js_movie_id" value="' .
    $id_m_js .
    '" />';
?>

<script src="changeRating.js"></script>

<?php require_once __DIR__ . '/_footer.php'; ?>