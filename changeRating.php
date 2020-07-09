<?php

require __DIR__ . '/model/tekaservice.class.php';



$ocjena = $_GET[ "ocjena" ];
$user_id = $_GET[ "user_id" ];
$movie_id = $_GET[ "movie_id" ];

$x = new TekaService;

$x->changeRating($ocjena, $user_id, $movie_id);





// Protrči kroz sva imena i vrati HTML kod <option> za samo ona 
// koja sadrže string q kao podstring.

?>