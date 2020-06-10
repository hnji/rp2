<?php


// pitanja?
/*
- je li bolje spojiti ratings i watchlist u jednu tablicu? 
- Uočimo da ne treba specificirati id koji se automatski poveća kod svakog ubacivanja. 
        --> je li sigurno sve namješteno? ili ćemo s create_tables
- registration_sequence --> kako ga slati na nečiji mail?
*/


// Popunjavamo tablice u bazi "probnim" podacima.
require_once __DIR__ . '/db.class.php';

seed_table_users();
seed_table_books();
seed_table_watchlist();

// ------------------------------------------
function seed_table_users()
{
	$db = DB::getConnection();

    try
	{
		$st = $db->prepare( 'INSERT INTO users(username, password_hash, email, registration_sequence, has_registered, admin) VALUES (:username, :password_hash, :email, :registration_sequence, :has_registered, :admin)' );

        $st->execute( array( 'username' => 'admin', 'password_hash' => password_hash( 'admin', PASSWORD_DEFAULT ), 'email' => 'admin@te.ka', 'registration_sequence'  => 'ABA', 'has_registered' => 1, 'admin' => 1 ) );
		$st->execute( array( 'username' => 'mirna', 'password_hash' => password_hash( 'mirninasifra', PASSWORD_DEFAULT ), 'email' => 'mirna@te.ka', 'registration_sequence'  => 'AAA', 'has_registered' => 1, 'admin' => 0 ) );
		$st->execute( array( 'username' => 'matea', 'password_hash' => password_hash( 'mateinasifra', PASSWORD_DEFAULT ), 'email' => 'matea@te.ka', 'registration_sequence'  => 'AAB', 'has_registered' => 1, 'admin' => 0 ) );
		$st->execute( array( 'username' => 'kreso', 'password_hash' => password_hash( 'kresinasifra', PASSWORD_DEFAULT ), 'email' => 'kreso@te.ka', 'registration_sequence'  => 'ABB', 'has_registered' => 0, 'admin' => 0 ) );
		$st->execute( array( 'username' => 'leo', 'password_hash' => password_hash( 'leovasifra', PASSWORD_DEFAULT ), 'email' => 'leo@te.ka', 'registration_sequence'  => 'BAA', 'has_registered' => 0, 'admin' => 0 ) );
	}
	catch( PDOException $e ) { exit( "PDO error (seed_table_users): " . $e->getMessage() ); }

	echo "Ubacio korisnike u tablicu users.<br />";
}

function seed_table_movies()
{
	$db = DB::getConnection();

	try
	{
		$st = $db->prepare( 'INSERT INTO movies(title, director, release_year, genre, movie_cast, average_rating) VALUES (:title, :director, :release_year, :genre, :movie_cast, :average_rating)' );

		$st->execute( array( 'title' => 'Beetlejuice', 'director' => 'Tim Burton', 'release_year' => 1988, 'genre' => 'Comedy ', 'movie_cast' => 'Michael Keaton, 	Alec Baldwin, Geena Davis, Catherine OHara, Winona Ryder', 'average_rating' => 0) );
        $st->execute( array( 'title' => 'Ta divna splitska noc', 'director' => 'Arsen Anton Ostojic', 'release_year' => 2004, 'genre' => 'Drama ', 'movie_cast' => 'Dino Dvornik, Mladen Vulic, Coolio, Marija Skaricic, Nives Ivankovic', 'average_rating' => 0) );

	}
	catch( PDOException $e ) { exit( "PDO error (seed_table_movies): " . $e->getMessage() ); }

	echo "Ubacio filmove u tablicu movies.<br />";
}


function seed_table_watchlist()
{
	$db = DB::getConnection();

	try
	{
		$st = $db->prepare( 'INSERT INTO watchlist(id_user, id_movie, watched) VALUES (:id_user, :id_movie, :watched)' );

		$st->execute( array( 'id_user' => 1, 'id_movie' => 2, 'watched' => 0) );
		$st->execute( array( 'id_user' => 3, 'id_movie' => 1, 'watched' => 0) );
		$st->execute( array( 'id_user' => 5, 'id_movie' => 1, 'watched' => 1) );
		$st->execute( array( 'id_user' => 3, 'id_movie' => 2, 'watched' => 1) );
	}
	catch( PDOException $e ) { exit( "PDO error (seed_table_watchlist): " . $e->getMessage() ); }

	echo "Ubacio liste filmova za pogledati u tablicu watchlist.<br />";
}

function seed_table_ratings()
{
	$db = DB::getConnection();

	try
	{
		$st = $db->prepare( 'INSERT INTO ratings(id_user, id_movie, rating) VALUES (:id_user, :id_movie, :rating)' );

        $st->execute( array( 'id_user' => 3, 'id_movie' => 2, 'rating' => 9) );  // 9 --> 10
		$st->execute( array( 'id_user' => 3, 'id_movie' => 1, 'rating' => 9) );
		$st->execute( array( 'id_user' => 4, 'id_movie' => 1, 'rating' => 9) );
		$st->execute( array( 'id_user' => 5, 'id_movie' => 2, 'rating' => 8) );
	}
	catch( PDOException $e ) { exit( "PDO error (seed_table_ratings): " . $e->getMessage() ); }

	echo "Ubacio ocjene u tablicu ratings.<br />";
}

function seed_table_comments()
{
	$db = DB::getConnection();

	try
	{
		$st = $db->prepare( 'INSERT INTO comments(id_user, id_movie, content) VALUES (:id_user, :id_movie, :content)' );

        $st->execute( array( 'id_user' => 3, 'id_movie' => 1, 'content' => 'Bubimir, Bubimir,') );
        $st->execute( array( 'id_user' => 3, 'id_movie' => 2, 'content' => 'Bubimir!') ); 

	}
	catch( PDOException $e ) { exit( "PDO error (seed_table_comments): " . $e->getMessage() ); }

	echo "Ubacio komentare u tablicu comments.<br />";
}


?>