<?php

//require __DIR__ . '/model/tekaservice.class.php';

require __DIR__ . '/app/database/db.class.php';
/*

$q = $_GET[ "q" ];

$x = new TekaService;

$movieList = $x->getAllMovies();

foreach( $movieList as $movie )
    if( strpos( $movie, $q ) !== false )
        echo '<option value="' . $movie->title . '" ></option>';


*/
// Protrči kroz sva imena i vrati HTML kod <option> za samo ona 
// koja sadrže string q kao podstring.


function sendJSONandExit( $message )
{
    // Kao izlaz skripte pošalji $message u JSON formatu i prekini izvođenje.
    header( 'Content-type:application/json;charset=utf-8' );
    echo json_encode( $message );
    flush();
    exit( 0 );
}

function sendErrorAndExit( $messageText )
{
	$message = [];
	$message[ 'error' ] = $messageText;
	sendJSONandExit( $message );
}

if( !isset( $_GET['q'] ) )
	sendErrorAndExit( "Nije poslan korisnikov unos." );


$q = $_GET[ "q" ];
$lowerq = strtolower($q);

/*
$x = new TekaService;
$movieList = $x->getAllMovies();

$message = [];


foreach( $movieList as $movie )
    if( strpos( $movie->title, $q ) !== false )
    {
        $message[] = $movie;
        
    }

sendJSONandExit( $message );



*/

    $db = DB::getConnection();

	
    // Dohvati sve dionice
    $st = $db->prepare( "SELECT * FROM dz4_movies ORDER BY title" );
    $st->execute();

    $message = [];
    //$message[ 'vrijemeZadnjegPristupa' ] = $timestamp;
    $message[ 'directors' ] = [];

    while( $row = $st->fetch() )
    {
        //echo $q;
        //echo $row['title'];
        $director = strtolower( $row['director'] );
        if( strpos( $director, $q ) !== false )
          $message[ 'directors' ][] = array( 'id_movie' => $row['id_movie'], 'title' => $row['title'], 'director' => $row['director'], 'release_year' => $row['release_year'], 'genre' => $row['genre'], 'cast' => $row['cast'], 'average_rating' => $row['average_rating']);			
    }
                                                                                                                            

    sendJSONandExit( $message );
	
?>