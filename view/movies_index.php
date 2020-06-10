<?php require_once __DIR__ . '/_header.php'; ?>
<?php require_once __DIR__ . '/izbornik.php'; ?>

<ul> 
<?php

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