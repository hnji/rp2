<?php
    class Movie{
        protected $id_movie, $title, $director, $release_year, $genre, $cast, $average_rating;

        public function __construct( $id_movie, $title, $director, $release_year, $genre, $cast, $average_rating ){
            $this->id_movie = $id_movie;
            $this->title = $title;
            $this->director = $director;
            $this->release_year = $release_year;
            $this->genre = $genre;
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

        

    }

?>