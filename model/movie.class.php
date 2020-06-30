<?php
    class Movie{
        protected $id, $title, $genre, $year, $director, $average_rating;

        public function __construct( $id, $title, $genre, $year, $director, $cast, $average_rating ){
            $this->id = $id;
            $this->title = $title;
            $this->genre = $genre;
            $this->year = $year;
            $this->director = $director;
            $this->cast = $cast;
            $this->average_rating = $average_rating;
        }

        public function __get( $property ){
            if( property_exists( $this, $property ) )
                return $this->$property; 
        }

        public function __set( $property, $value ){
            if( property_exists( $this, $property ) )
                $this->$property = $value;
            
                return $this;
        }

        public function getAllMovies()
        {
            $movies = [];
            $db = DB::getConnection();
            $st = $db->prepare( 'SELECT * FROM movies ORDER BY title' );
            $st->execute();

            while( $row = $st->fetch() )
                $movies[] = new Movie($row['id'], $row['title'], $row['genre'], $row['year'], $row['director'], $row['cast'], $row['average_rating']);
            
            return $movies;
        }

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

    }

?>