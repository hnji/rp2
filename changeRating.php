<?php

require __DIR__ . '/model/tekaservice.class.php';

function sendJSONandExit( $message )
{
    // Kao izlaz skripte pošalji $message u JSON formatu i prekini izvođenje.
    header( 'Content-type:application/json;charset=utf-8' );
    echo json_encode( $message );
    flush();
    exit( 0 );
}

$ocjena = $_GET[ "ocjena" ];
$user_id = $_GET[ "user_id" ];
$movie_id = $_GET[ "movie_id" ];

$x = new TekaService;

$x->changeRating($ocjena, $user_id, $movie_id);

$message = [];
$message[ 'average' ] = $x->getAverageRating( $movie_id );
$message[ 'your' ] = $x->getRatingOfUser( $movie_id, $user_id ); // ne vidi session, triba mi nova fja 

sendJSONandExit( $message );


// Protrči kroz sva imena i vrati HTML kod <option> za samo ona 
// koja sadrže string q kao podstring.

?>