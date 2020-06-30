<?php

require __DIR__ . '/app/database/db.class.php';
require __DIR__ . '/model/user.class.php';
require __DIR__ . '/model/movie.class.php';
require __DIR__ . '/model/rating.class.php';
require __DIR__ . '/model/comment.class.php';
require __DIR__ . '/model/watchlist.class.php';

    class TekaService{

        public function getAllMovies ()
        {
            $movies = [];
            $db = DB::getConnection();
            $st = $db->prepare( 'SELECT * FROM movies ORDER BY title' );
            $st->execute();

            while( $row = $st->fetch() )
                $movies[] = new Movie($row['id'], $row['title'], $row['genre'], $row['year'], $row['director'], $row['cast'], $row['average_rating']);
            
            return $movies;
        }

//   $id, $title, $genre, $year, $director, $cast, $average_rating


        public function getTopMovies ()
        {
            $movies = [];
            $db = DB::getConnection();
            $st = $db->prepare( 'SELECT * FROM movies ORDER BY average_rating DESC LIMIT 0,5' );
            $st->execute();

            while( $row = $st->fetch() )
                $movies[] = new Movie($row['id'], $row['title'], $row['genre'], $row['year'], $row['director'], $row['cast'], $row['average_rating']);
            
            return $movies;
        }

        public function moviesByGenre ( $genre )
        {
            $allmovies = [];

            $db = DB::getConnection();
            $st = $db->prepare( 'SELECT * FROM movies WHERE genre=:genre ORDER BY title' );
            $st->execute( ['genre' => $genre] );

            while( $row = $st->fetch() )
                $allmovies[] = new Movie( $row['id'], $row['title'], $row['genre'], $row['year'], $row['director'], $row['cast'], $row['average_rating'] );
            
            return $allmovies;
        }


        public function moviesByYear ( $genre )
        {
            $allmovies = [];

            $db = DB::getConnection();
            $st = $db->prepare( 'SELECT * FROM movies WHERE year=:year ORDER BY title' );
            $st->execute( ['year' => $year] );

            while( $row = $st->fetch() )
                $allmovies[] = new Movie( $row['id'], $row['title'], $row['genre'], $row['year'], $row['director'], $row['cast'], $row['average_rating'] );
            
            return $allmovies;
        }


        public function moviesByDirector ( $genre )
        {
            $allmovies = [];

            $db = DB::getConnection();
            $st = $db->prepare( 'SELECT * FROM movies WHERE director=:director ORDER BY title' );
            $st->execute( ['director' => $director] );

            while( $row = $st->fetch() )
                $allmovies[] = new Movie( $row['id'], $row['title'], $row['genre'], $row['year'], $row['director'], $row['cast'], $row['average_rating'] );
            
            return $allmovies;
        }

        /*

        public function moviesByActor ( $actor )
        {
            $allmovies = [];

            $db = DB::getConnection();
            $st = $db->prepare( 'SELECT * FROM movies WHERE cast LIKE '%:actor%' ORDER BY title' );
            $st->execute( ['actor' => $actor] );

            while( $row = $st->fetch() )
                $allmovies[] = new Movie( $row['id'], $row['title'], $row['genre'], $row['year'], $row['director'], $row['cast'], $row['average_rating'] );
            
            return $allmovies;
        }
        */

        public function getComments ( $id_movie )
        {
            $allcomments = [];

            $db = DB::getConnection();
            $st = $db->prepare( 'SELECT * FROM comments WHERE id_movie=:id_movie ORDER BY date' );
            $st->execute( ['id_movie' => $id_movie] );

            while( $row = $st->fetch() )
                $allcomments[] = new Comment( $row['id_user'], $row['id_movie'], $row['content'], $row['date'] );
            
            return $allcomments;
        }

        public function getWacthlist ( $id_user )
        {
            $allmovies = [];

            $db = DB::getConnection();
            $st = $db->prepare( 'SELECT * FROM watchlist WHERE id_user=:id_user ORDER BY title' );
            $st->execute( ['id_user' => $id_user] );

            while( $row = $st->fetch() )
                $allmovies[] = new Watchlist( $row['id'], $row['id_user'], $row['id_movie'], $row['watched'] );
            
            return $allmovies;
        }

        public function getAllUsers()
        {
            $allusers = [];

            $db = DB::getConnection();
            $st = $db->prepare( 'SELECT * FROM users' );
            $st->execute();

            while( $row = $st->fetch() )
                $allusers[] = new User( $row['id'], $row['username'], $row['password_hash'], $row['email'], $row['registration_sequence'], $row['has_registered'], $row['admin'] );
            
            return $allusers;
        }

        public function getAllComments()
        {
            $allcomments = [];

            $db = DB::getConnection();
            $st = $db->prepare( 'SELECT * FROM comments' );
            $st->execute();

            while( $row = $st->fetch() )
                $allusers[] = new Comment( $row['id_user'], $row['id_movie'], $row['content'], $row['date'] );
            
            return $allcomments;
        }

        public function getPopularMovies()
        {
            $allmovies = [];

            $db = DB::getConnection();
            $st = $db->prepare( 'SELECT id_movie, COUNT(*) FROM watchlist GROUP BY id_movie ORDER BY 2 DESC LIMIT 0,5');
            $st->execute();

            while( $row = $st->fetch() )
                $allmovies[] = new Watchlist( $row['id'], $row['id_user'], $row['id_movie'], $row['watched'] );
            
            return $allmovies;
        }

        public function getMovie( $id ) 
        {
            
            $db = DB::getConnection();
            $st = $db->prepare( 'SELECT * FROM movies WHERE id=:id' );
            $st->execute( ['id' => $id] );
            $row = $st->fetch();
            $movie = new Movie( $row['id'], $row['title'], $row['genre'], $row['year'], $row['director'], $row['cast'], $row['average_rating'] );

            return $movie;
        }


        public function writeNewComment($id_movie, $id_user, $content)
        {
            date_default_timezone_set("Europe/Zagreb");
            $date = date("Y-m-d H:i:s"); 
            $db = DB::getConnection();
            $st = $db->prepare( 'INSERT INTO comments (id_user, id_movie, content, date) VALUE (:id_user, :id_movie, :content, :date)' );
            $st->execute(['id_user' => $id, 'id_movie' => $id_movie, 'content' => $content, 'date' => $date]);
        }


        //--------------------------------------

        //dohvati sve poruke određenog kanala ciji je id = id_channel
        public function getAllMessages ( $id_channel )
        {
            $allmessages = [];

            $db = DB::getConnection();
            $st = $db->prepare( 'SELECT * FROM dz2_messages WHERE id_channel=:id_channel ORDER BY date' );
            $st->execute( ['id_channel' => $id_channel] );

            while( $row = $st->fetch() )
                $allmessages[] = new Message( $row['id'], $row['id_user'], $row['id_channel'], $row['content'], $row['thumbs_up'], $row['date'] );
            
            return $allmessages;
        }

        public function getMyChannels( $id_user )
        {
            $mychannels = [];
            $db = DB::getConnection();
            $st = $db->prepare( 'SELECT * FROM dz2_channels WHERE id_user=:id_user' );
            $st->execute( ['id_user' => $id_user] );

            while( $row = $st->fetch() )
                $mychannels[] = new Channel( $row['id'], $row['id_user'], $row['name']);
            
            return $mychannels;
        }

        public function getAllChannels ()
        {
            $channels = [];
            $db = DB::getConnection();
            $st = $db->prepare( 'SELECT * FROM dz2_channels' );
            $st->execute();

            while( $row = $st->fetch() )
                $channels[] = new Channel($row['id'], $row['id_user'], $row['name']);
            
            return $channels;
        }

        public function getMyMessages ($id_user)
        {
            $mymessages = [];

            $db = DB::getConnection();
            $st = $db->prepare( 'SELECT * FROM dz2_messages WHERE id_user=:id_user ORDER BY date DESC' );
            $st->execute( ['id_user' => $id_user] );

            while( $row = $st->fetch() )
                $mymessages[] = new Message( $row['id'], $row['id_user'], $row['id_channel'], $row['content'], $row['thumbs_up'], $row['date'] );
            
            return $mymessages;
        }
        
        
        public function getUsername( $id ) 
        {
            
            $db = DB::getConnection();
            $st = $db->prepare( 'SELECT * FROM dz2_users WHERE id=:id' );
            $st->execute( ['id' => $id] );
            $row = $st->fetch();
            $user = new User ($row['id'], $row['username'], $row['password_hash'], $row['email'], $row['registration_sequence'], $row['has_registered']);

            return $user->username;
        }

        public function getUserId( $username )
        {
            $db = DB::getConnection();
            $st = $db->prepare( 'SELECT * FROM dz2_users WHERE username=:username' );
            $st->execute( ['username' => $username] );
            $row = $st->fetch();
            $user = new User ($row['id'], $row['username'], $row['password_hash'], $row['email'], $row['registration_sequence'], $row['has_registered']);

            return $user->id;
        }        

        public function getChannelName( $id )
        {
            $db = DB::getConnection();
            $st = $db->prepare( 'SELECT * FROM dz2_channels WHERE id=:id' );
            $st->execute( ['id' => $id] );
            $row = $st->fetch();
            $channel = new Channel ($row['id'], $row['id_user'], $row['name']);

            return $channel->name;
        }
    
        public function writeNewMessage($id_channel, $content)
        {
            $id = (int)$_SESSION['id_user'];
            date_default_timezone_set("Europe/Zagreb");
            $date = date("Y-m-d H:i:s"); 
            $db = DB::getConnection();
            $st = $db->prepare( 'INSERT INTO dz2_messages (id_user, id_channel, content, thumbs_up, date) VALUE (:id_user, :id_channel, :content, :thumbs_up, :date)' );
            $st->execute(['id_user' => $id, 'id_channel' => $id_channel, 'content' => $content, 'thumbs_up' => 0, 'date' => $date]);
        }


        public function newChannel( $name )
        {
            $id = (int)$_SESSION['id_user'];

            $db = DB::getConnection();
            $st = $db->prepare( 'INSERT INTO dz2_channels (id_user, name) VALUE (:id_user, :name)' );
            $st->execute( ['id_user' => $id, 'name' => $name] );

            return;

        }

        public function refreshThumb( $id )
        {

            $db = DB::getConnection();
            $st = $db->prepare( 'UPDATE dz2_messages SET thumbs_up=thumbs_up+1 WHERE id=:id' );
            $st->execute( ['id' => $id] );
        }

        public function loginUser()
        {
            $db = DB::getConnection();

            $st = $db->prepare( 'SELECT has_registered FROM dz2_users WHERE username=:username' );
            $st->execute( array( 'username' => $_POST["username"] ) );
            $row = $st->fetch();
            if ($row === 0)
                return false;

            $st = $db->prepare( 'SELECT password_hash FROM dz2_users WHERE username=:username' );
            $st->execute( array( 'username' => $_POST["username"] ) );

            $row = $st->fetch();

            return $row;

        }

        public function newUser()
        {
            $reg_seq = '';
		    for( $i = 0; $i < 20; ++$i )
                $reg_seq .= chr( rand(0, 25) + ord( 'a' ) ); // Zalijepi slučajno odabrano slovo
            
            $db = DB::getConnection();
            $st = $db->prepare( 'SELECT * FROM dz2_users WHERE username=:username' );
            $st->execute( ['username' => $_POST['newusername']] );
            
		    if( $st->rowCount() !== 0 )
		    {
			// Taj user u bazi već postoji
                return 0;
            }
            
            $reg_seq = '';
		    for( $i = 0; $i < 20; ++$i )
			    $reg_seq .= chr( rand(0, 25) + ord( 'a' ) ); // Zalijepi slučajno odabrano slovo

			$st = $db->prepare( 'INSERT INTO dz2_users(username, password_hash, email, registration_sequence, has_registered) VALUES ' .
				                '(:username, :password, :email, :reg_seq, 0)' );
			
			$st->execute( array( 'username' => $_POST['newusername'], 
				                 'password' => password_hash( $_POST['newpassword'], PASSWORD_DEFAULT ), 
				                 'email' => $_POST['newemail'], 
				                 'reg_seq'  => $reg_seq ) );
            return $reg_seq;
        }

        public function hasRegistered()
        {
            $db = DB::getConnection();

	        $st = $db->prepare( 'SELECT * FROM dz2_users WHERE registration_sequence=:reg_seq' );
	        $st->execute( array( 'reg_seq' => $_SESSION['niz'] ) );

            $row = $st->fetch();

            if( $st->rowCount() !== 1 )
	            return 0;
            else
            {
	            // Sad znamo da je točno jedan takav. Postavi mu has_registered na 1.
		        $st = $db->prepare( 'UPDATE dz2_users SET has_registered=1 WHERE registration_sequence=:reg_seq' );
                $st->execute( array( 'reg_seq' => $_SESSION['niz'] ) );
                return 1;
            }
        }
    }
?>