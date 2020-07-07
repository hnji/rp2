<?php

require __DIR__ . '/../app/database/db.class.php';
require __DIR__ . '/user.class.php';
require __DIR__ . '/movie.class.php';
require __DIR__ . '/rating.class.php';
require __DIR__ . '/comment.class.php';
require __DIR__ . '/watchlist.class.php';

class TekaService{

    public function loginUser()
    {
            $db = DB::getConnection();

            $st = $db->prepare( 'SELECT has_registered FROM dz4_users WHERE username=:username' );
            $st->execute( array( 'username' => $_POST["username"] ) );
            $row = $st->fetch();
            if ($row === 0)
                return false;

            $st = $db->prepare( 'SELECT password_hash FROM dz4_users WHERE username=:username' );
            $st->execute( array( 'username' => $_POST["username"] ) );

            $row = $st->fetch();

            return $row;

    }

    public function getUserId( $username )
    {
            $db = DB::getConnection();
            $st = $db->prepare( 'SELECT id FROM dz4_users WHERE username=:username' );
            $st->execute( ['username' => $username] );
            $row = $st->fetch();
            
            return $row;
    }

    public function isUserAdmin()
    {
            $db = DB::getConnection();
            $st = $db->prepare( 'SELECT admin FROM dz4_users WHERE id=:id' );
            $st->execute( ['id' => $_SESSION['id_user']] );
            $row = $st->fetch();
            
            return $row;
    }
/*
    public function newUser()
    {
        $db = DB::getConnection();
        $st = $db->prepare( 'SELECT * FROM dz4_users WHERE username=:username' );
        $st->execute( ['username' => $_POST['newusername']] );
            
	if( $st->rowCount() !== 0 )
	{
			// Taj user u bazi već postoji
                return 0;
        }
            
        $reg_seq = '';
        for( $i = 0; $i < 20; ++$i )
                $reg_seq .= chr( rand(0, 25) + ord( 'a' ) ); // Zalijepi slučajno odabrano slovo

        $st = $db->prepare( 'INSERT INTO dz4_users(username, password_hash, email, registration_sequence, has_registered, admin) VALUES ' .
                                '(:username, :password, :email, :reg_seq, 0, 0)' );
        
        $st->execute( array( 'username' => $_POST['newusername'], 
                                        'password' => password_hash( $_POST['newpassword'], PASSWORD_DEFAULT ), 
                                        'email' => $_POST['newemail'], 
                                        'reg_seq'  => $reg_seq ) );
        return $reg_seq;
    }
*/

    public function newUser(){
        $db = DB::getConnection();

        try{
                    $st = $db->prepare( 'SELECT * FROM dz4_users WHERE username=:username' );
        $st->execute( array( 'username' => $_POST['newusername'] ) );
        }
        catch( PDOException $e ) { exit( "PDO error [dz4_users]: " . $e->getMessage() ); }

        if( $st->rowCount() !== 0 ){
            // Taj user u bazi već postoji
            //$title = 'Register';
            //echo 'User with that username already exists.';
            require_once __DIR__ . '/../view/signin.php';
            exit();
        }

        // Dakle sad je napokon sve ok.
        // Dodaj novog korisnika u bazu. Prvo mu generiraj random string od 10 znakova za registracijski link.
        $reg_seq = '';
        for( $i = 0; $i < 20; ++$i )
            $reg_seq .= chr( rand(0, 25) + ord( 'a' ) ); // Zalijepi slučajno odabrano slovo


        try{
                    $st = $db->prepare( 'INSERT INTO dz4_users(username, password_hash, email, registration_sequence, has_registered, admin) VALUES ' .
                                            '(:username, :password_hash, :email, :registration_sequence, 0, 0)' );
                    
                    $st->execute( array( 'username' => $_POST['newusername'], 
                                             'password_hash' => password_hash( $_POST['newpassword'], PASSWORD_DEFAULT ), 
                                             'email' => $_POST['newemail'], 
                             'registration_sequence'  => $reg_seq ) );
        }
        catch( PDOException $e ) { exit( "PDO error [dz4_users]: " . $e->getMessage() ); }

        // Sad mu još pošalji mail
        //provjerit dal se mail salje sa studenta
        $to       = $_POST['newemail'];
        $subject  = 'Registracijski mail';
        $message  = 'Poštovani ' . $_POST['newusername'] . "!\nZa dovršetak registracije kliknite na sljedeći link: ";
        $message .= 'http://' . $_SERVER['SERVER_NAME'] . htmlentities( dirname( $_SERVER['PHP_SELF'] ) ) . '/teka.php?niz=' . $reg_seq . "\n";
        $headers  = 'From: rp2@studenti.math.hr' . "\r\n" .
                    'Reply-To: rp2@studenti.math.hr' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();

        $isOK = mail($to, $subject, $message, $headers);

        if( !$isOK )
            exit( 'Error: can not send e-mail.' );

        // Zahvali mu na prijavi.
        //$title = 'Register';
        require_once __DIR__ . '/../view/registracija.php';
        exit();
    }

    public function getMovie( $id_movie )
    {
        $db = DB::getConnection();
        $st = $db->prepare( 'SELECT * FROM dz4_movies WHERE id_movie=:id_movie' );
        $st->execute( [ 'id_movie' => $id_movie ] );
        $row = $st->fetch();

        $movie = new Movie( $row['id_movie'], $row['title'], $row['director'], $row['release_year'], $row['genre'], $row['cast'], $row['average_rating'] );
        return $movie;
    }


    public function getWatchlist ()
        {
                $allmovies = [];

                $db = DB::getConnection();
                $st = $db->prepare( 'SELECT * FROM dz4_watchlist WHERE id_user=:id_user' );
                $st->execute( ['id_user' => $_SESSION['id_user']] );

                while( $row = $st->fetch() )
                $allmovies[] = new Watchlist( $row['id'], $row['id_user'], $row['id_movie'], $row['watched'] );
                
                return $allmovies;
        }

        public function getUsername() 
        {
            
            $db = DB::getConnection();
            $st = $db->prepare( 'SELECT * FROM dz4_users WHERE id=:id' );
            $st->execute( ['id' => $_SESSION['id_user']] );
            $row = $st->fetch();
            $user = new User ($row['id'], $row['username'], $row['password_hash'], $row['email'], $row['registration_sequence'], $row['has_registered'], $row['admin']);

            return $user->username;
        }
        // popraviti naredbu za brisanje korisnika
        public function eraseUser( $id )
        {
            $db = DB::getConnection();
            $st = $db->prepare( 'DELETE FROM dz4_users WHERE id LIKE :id' );
            $st->execute(['id' => $id]);
            return;

        }

        public function getCommentId( $content )
        {
            $db = DB::getConnection();
            $st = $db->prepare( 'SELECT id FROM dz4_comments WHERE content=:content' );
            $st->execute( ['content' => $content] );
            $row = $st->fetch();
            
            return $row;
        }
        //komentari se ne brisu, korisnici se brisu???
        public function eraseComment( $id )
        {
            $db = DB::getConnection();
            $st = $db->prepare( 'DELETE FROM dz4_comments WHERE id LIKE :id' );
            $st->execute(['id' => $id]);
            return;

        }

        //broj parametara ne stima???
        public function newMovie()
        {
            $db = DB::getConnection();
            try{
                $st = $db->prepare( 'INSERT INTO dz4_movies(title, director, release_year, genre, cast, average_rating) VALUES ' .
                            '(:title, :director, :release_year, :genre, cast, 0)' );
                $st->execute( array( 'title' => $_POST['newtitle'], 
                            'director' => $_POST['newdirector'], 
                            'release_year' => $_POST['newyear'], 
                            'genre' => $_POST['newgenre'],
                            'cast' => $_POST['newcast'] ) );
            }
            catch( PDOException $e ) { exit( "PDO error [dz4_comments]: " . $e->getMessage() ); }
            return;
        
        }
}

?>