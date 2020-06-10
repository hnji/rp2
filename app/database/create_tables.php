<?php

// Stvaramo tablice u bazi (ako veÄ‡ ne postoje od ranije).
require_once __DIR__ . '/db.class.php';

create_table_dz4_users();
create_table_dz4_movies();
create_table_dz4_comments();
create_table_dz4_ratings();
create_table_watchlist();

exit( 0 );

// --------------------------
function has_table( $tblname )
{
	$db = DB::getConnection();
	
	try
	{
		$st = $db->prepare( 
			'SHOW TABLES LIKE :tblname'
		);

		$st->execute( array( 'tblname' => $tblname ) );
		if( $st->rowCount() > 0 )
			return true;
	}
	catch( PDOException $e ) { exit( "PDO error [show tables]: " . $e->getMessage() ); }

	return false;
}


function create_table_dz4_users()
{
	$db = DB::getConnection();

	if( has_table( 'dz4_users' ) )
		exit( 'Tablica dz4_users vec postoji. Obrisite ju pa probajte ponovno.' );


	try
	{
		$st = $db->prepare( 
			'CREATE TABLE IF NOT EXISTS dz4_users (' .
			'id int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
			'username varchar(50) NOT NULL,' .
			'password_hash varchar(255) NOT NULL,'.
			'email varchar(50) NOT NULL,' .
			'registration_sequence varchar(20) NOT NULL,' .
            'has_registered int, ' .
            'admin int)'
		);

		$st->execute();
	}
	catch( PDOException $e ) { exit( "PDO error [create dz4_users]: " . $e->getMessage() ); }

	echo "Napravio tablicu dz4_users.<br />";
}


function create_table_dz4_movies()
{
	$db = DB::getConnection();

	if( has_table( 'dz4_movies' ) )
		exit( 'Tablica dz4_movies vec postoji. Obrisite ju pa probajte ponovno.' );

	try
	{
		$st = $db->prepare( 
			'CREATE TABLE IF NOT EXISTS dz4_movies (' .
            'id_movie int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
            'title varchar(50) NOT NULL,' .
            'director varchar(50) NOT NULL,' .
            'release_year year(4) NOT NULL,' .
            'genre varchar(30) NOT NULL,' .
            'cast varchar(50) NOT NULL,' .
            'average_rating DECIMAL NOT NULL)'
		);

		$st->execute();
	}
	catch( PDOException $e ) { exit( "PDO error [create dz4_movies]: " . $e->getMessage() ); }

	echo "Napravio tablicu dz4_movies.<br />";
}


function create_table_dz4_comments()
{
	$db = DB::getConnection();

	if( has_table( 'dz4_comments' ) )
		exit( 'Tablica dz4_comments vec postoji. Obrisite ju pa probajte ponovno.' );

	try
	{
		$st = $db->prepare( 
			'CREATE TABLE IF NOT EXISTS dz4_comments (' .
			'id int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
			'id_user INT NOT NULL,' .
			'id_movie INT NOT NULL,' .
			'content varchar(1000) NOT NULL,' .
			'date DATETIME NOT NULL)'
		);

		$st->execute();
	}
	catch( PDOException $e ) { exit( "PDO error [create dz4_comments]: " . $e->getMessage() ); }

	echo "Napravio tablicu dz4_comments.<br />";
}

function create_table_dz4_ratings()
{
	$db = DB::getConnection();

	if( has_table( 'dz4_ratings' ) )
		exit( 'Tablica dz4_ratings vec postoji. Obrisite ju pa probajte ponovno.' );

	try
	{
		$st = $db->prepare( 
			'CREATE TABLE IF NOT EXISTS dz4_ratings (' .
			'id_user int NOT NULL,' .
			'id_movie int NOT NULL,' .
			'rating int NOT NULL)'
		);

		$st->execute();
	}
	catch( PDOException $e ) { exit( "PDO error [create dz4_ratings]: " . $e->getMessage() ); }

	echo "Napravio tablicu dz4_ratings.<br />";
}

function create_table_watchlist()
{
	$db = DB::getConnection();

	if( has_table( 'dz4_watchlist' ) )
		exit( 'Tablica dz4_watchlist vec postoji. Obrisite ju pa probajte ponovno.' );

	try
	{
		$st = $db->prepare( 
			'CREATE TABLE IF NOT EXISTS dz4_watchlist (' .
			'id int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
            'id_user int NOT NULL,' .
            'id_movie int NOT NULL,' .
			'watched int)'
		);

		$st->execute();
	}
	catch( PDOException $e ) { exit( "PDO error [create dz4_watchlist]: " . $e->getMessage() ); }

	echo "Napravio tablicu dz4_watchlist.<br />";
}


?> 