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

        

    }

?>