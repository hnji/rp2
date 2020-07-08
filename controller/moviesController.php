<?php

require_once __DIR__ . '/../model/tekaservice.class.php';

    class MoviesController{

        public function allmovies()
        {
            $ls = new TekaService;

            $title = 'All movies';
            $movieList = $ls->getAllMovies();

            require_once __DIR__ . '/../view/allmovies.php';
        }

        public function toprated()
        {
            $ls = new TekaService;

            $title = 'Top rated movies';
            $movieList = $ls->getTopMovies();

            require_once __DIR__ . '/../view/topratedmovies.php';
        }

        public function mostpopular()
        {
            $ls = new TekaService;

            $title = 'Most popular movies';
            $movieList = $ls->getPopularMovies();

            foreach($movieList as $movie)
            {
                $nwatchlistsList[] = $ls->getNumberOfWatchlists((int)$movie->id_movie);
            }

            require_once __DIR__ . '/../view/mostpopularmovies.php';
        }

        public function search()
        {
            // ne radi glupi ajax

            if( isset($_POST['txt_year']) )
            {
                $year = $_POST['txt_year'];

                $ls = new TekaService;

                $title = 'Search';
                $movieList = $ls->moviesByYear( $year );

                require_once __DIR__ . '/../view/allmovies.php';
            }
            else
            {
                $title = 'Search';
                require_once __DIR__ . '/../view/search.php'; 
            }

            
        }

        public function movie()
        {
            if( !isset( $_SESSION['id_movie'] ) )
                $_SESSION['id_movie'] = $_POST['movie_id'];

            if( isset( $_SESSION['admin'] ) )
            {
                if (isset($_POST['movie_id']))
                {
                    $ls = new TekaService;

                    $id_m = (int)$_POST['movie_id'];
                    $id_u = (int)$_SESSION['id_user'];

                    //echo 'idjevi: ' . $id_m . $id_u;
                    //echo 'tu san: ' . $ls->isMovieOnWatchlist( $id_m, $id_u );

                    $isOnWatchlist = $ls->isMovieOnWatchlist( $id_m, $id_u );
                }
                else
                {
                    $ls = new TekaService;

                    $id_m = (int)$_SESSION['id_movie'];
                    $id_u = (int)$_SESSION['id_user'];
                    
                    $isOnWatchlist = $ls->isMovieOnWatchlist( $id_m, $id_u );
                }

            }
            
           
            if( isset($_POST["movie_title"]) && isset($_POST["movie_id"]) )
            {
                $title = $_POST["movie_title"];
                $id = $_POST["movie_id"];

                $_SESSION['id_movie'] = $id;

                $ls = new TekaService;

                $movie = $ls->getMovie( $id );

                $caststr = $ls->getCast( $id );
                $castList = explode( ',', $caststr );

                $commentList = $ls->getComments( $id );

                foreach($commentList as $comment)
                {
                    $usersList[] = $ls->getUsername($comment->id_user);
                }

                require_once __DIR__ . '/../view/movie.php';
            }
            else
            {
                $id_movie = (int) $_SESSION['id_movie'];

                $ls = new TekaService;

                $movie = $ls->getMovie( $id_movie );
                $title = $ls->getTitle( $id_movie );

                $caststr = $ls->getCast( $id_movie );
                $castList = explode( ',', $caststr );

                $commentList = $ls->getComments( $id_movie );

                foreach($commentList as $comment)
                {
                    $usersList[] = $ls->getUsername($comment->id_user);
                }

                require_once __DIR__ . '/../view/movie.php';
            }

        
        }
        
        // kad je movielist prazan???

        public function newcomment() //writeNewComment($id_movie, $id_user, $content)
        {
            if (isset ( $_SESSION['id_user']) )
            {
                if (isset ($_POST['content']))
                {
                    $id_movie = (int) $_SESSION['id_movie'];
                    //$id_user = (int) $_SESSION['id_user'];

                    $ls = new TekaService;
                    $ls->writeNewMessage( $id_movie, $_POST['content'] );

                    //$_SESSION['id_movie'] = $id_movie; //?
                    
                    $x = new MoviesController;
                    $x->movie(); 

                    require_once __DIR__ . '/../view/movie.php';
                }
                // jel treba tu ikakav else? šta se dogodi kad ide poslat prazni komentar

            }
            else 
            {
                require_once __DIR__ . '/../view/signin.php';
            }

        }

        public function watchlist()
        {
            if (isset ( $_POST['watchlist']) )
            {
                $id_movie = (int) $_SESSION['id_movie'];
                $id_user = (int) $_SESSION['id_user'];

                $ls = new TekaService;
                $ls->addMovieToWatchlist( $id_movie, $id_user );

                $x = new MoviesController;
                $x->movie(); 

                require_once __DIR__ . '/../view/movie.php';
                

            }
        }
    }




    
?>
