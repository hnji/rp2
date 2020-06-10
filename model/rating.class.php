<?php
    class Rating{
        protected $id_user, $id_movie, $rating;

        public function __construct( $id_user, $id_movie, $rating ){
            $this->id_user = $id_user;
            $this->id_movie = $id_movie;
            $this->rating = $rating;
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