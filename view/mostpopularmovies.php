<?php require_once __DIR__ . '/_header.php'; ?>
<?php require_once __DIR__ . '/menu.php'; ?>

<ul> 
<?php
//ispis prvih koliko filmova, po kriteriju rating?
//koje sve podatke o filmu prikazujemo?
   foreach( $movieList as $movie ){
    echo
    '<ol>' . 
    '<li>' .
    $movie->title .
    '</li>' .
    '<li>' .
    $movie->rating .
    '</li>' .
    '</ol>';
    
}
    ?>
        
</ul>

<?php require_once __DIR__ . '/_footer.php'; ?>