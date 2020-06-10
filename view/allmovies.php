<?php require_once __DIR__ . '/_header.php'; ?>
<?php require_once __DIR__ . '/menu.php'; ?>

<ul> 
<?php
//ispis svih filmova iz baze
//koje sve podatke o filmu prikazujemo?
//abecednim redom?
   foreach( $movieList as $movie ){
    echo
    '<ul>' . 
    '<li>' .
    $movie->title .
    '</li>' .
    '<li>' .
    $movie->rating .
    '</li>' .
    '</ul>';
    
}
    ?>
        
</ul>

<?php require_once __DIR__ . '/_footer.php'; ?>