<?php

require __DIR__ . '/model/tekaservice.class.php';



$q = $_GET[ "q" ];

$x = new TekaService;

$movieList = $x->getAllMovies();

foreach( $movieList as $movie )
    if( strpos( $movie, $q ) !== false )
        echo '<option value="' . $movie->title . '" ></option>';



// Protrči kroz sva imena i vrati HTML kod <option> za samo ona 
// koja sadrže string q kao podstring.

