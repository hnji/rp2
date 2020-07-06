<?php require_once __DIR__ . '/_header.php'; ?>
<?php require_once __DIR__ . '/menu.php'; ?>

<ul> 
<?php
//ispis prvih 5 filmova po kriteriju - na najvise su watchlista
//koje sve podatke o filmu prikazujemo?

    echo '<ol>';
   foreach( $movieList as $movie ){
    echo
    '<li>' .
    $movie->title .
    '   ' .
    $movie->rating .
    '</li>';
}
    echo '</ol>';
    ?>
        
</ul>

<?php require_once __DIR__ . '/_footer.php'; ?>