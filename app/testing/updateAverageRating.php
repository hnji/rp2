<?php

require __DIR__ . '/../../model/tekaservice.class.php';

$ls = new TekaService;

//echo $ls->getAverageRating(5);

for( $i = 1; $i <= 8; $i++ )
    if( $i !== 3)
        $ls->updateAverageRating($i, $ls->getAverageRating($i));


?>