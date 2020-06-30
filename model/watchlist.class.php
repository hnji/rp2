<?php
    class Watchlist{
        protected $id, $id_user, $id_movie, $watched;

        public function __construct( $id, $id_user, $id_movie, $watched ){
            $this->id = $id;
            $this->id_user = $id_user;
            $this->id_movie = $id_movie;
            $this->watched = $watched;
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
    }

?>