<?php

require_once __DIR__ . '/../model/tekaservice.class.php';
require_once __DIR__ . '/../model/movie.class.php';

require_once __DIR__ . '/../controller/userController.php';

class adminController{

    public function index()
    {
        if( !isset ( $_SESSION['admin'] ) )
        {
            require_once __DIR__ . '/../view/signin.php';
        }
            
        else
        {
            
            $info = '';
            $emptylist = '';
            $title = 'My profile';
            $emptyratings = '';

            $x = new TekaService;
            
            $username = $x->getUsername( $_SESSION['id_user'] );
            
            
            $watchList = [];
            $watchList = $x->getWatchlist();
            $movieList = [];


            for( $i = 0; $i < sizeof($watchList); ++$i )
            {
               $movieList[$i] = $x->getMovie( $watchList[$i]->id_movie );
            }

            if ( sizeof($movieList) === 0 ) 
            {
                $emptylist = 'Your Watchlist is empty!';
            }

            $ratedMoviesList = $x->getAllRatedMovies();

            if( sizeof($ratedMoviesList) === 0)
            {
                $emptyratings = "You haven't rated any movies!";
            }

            for( $i = 0; $i < sizeof($ratedMoviesList); ++$i )
            {
               $ratingsList[$i] = $x->getRating( $ratedMoviesList[$i]->id_movie );
            }

            if ( (int)$_SESSION['admin'] )
                require_once __DIR__ . '/../view/admin.php';
            
            else
                require_once __DIR__ . '/../view/myprofile.php';
        }
            
    }
    
    public function eraseuser(){

        if ( isset( $_POST['eraseuser'] ) )
        {
            $x = new TekaService;
            $username = $_POST['search_users'];
            $id = $x->getUserId( $username );
            $x->eraseUser( $id );

            require_once __DIR__ . '/../view/eraseuser.php';

        }

    }

    public function erasecomment(){

        if ( isset( $_POST['erasecomment'] ) )
        {
            $x = new TekaService;
            $content = $_POST['search_comments'];
            $id = $x->getCommentId( $content );
            $x->eraseComment( $id );

            require_once __DIR__ . '/../view/erasecomment.php';

        }

    }


    public function newmovie()
    {
        $x = new TekaService;
        $x->newMovie();
        require_once __DIR__ . '/../view/newmovie.php';

    }

    //fja za dodavanje admina
    public function addadmin()
    {
        $x = new TekaService;
        $admin = $x->newAdmin( $_POST['new_admin'] );
        if ( $admin )
            $info = 'This user is already admin.';
        else 
            $info = 'User ' . $_POST['new_admin'] . ' is now also admin.';

        $title = 'My profile';

        $x = new TekaService;
        
        $username = $x->getUsername( $_SESSION['id_user'] );
        
        
        $watchList = [];
        $watchList = $x->getWatchlist();
        $movieList;
        for( $i = 0; $i < sizeof($watchList); ++$i )
        {
            $movieList[$i] = $x->getMovie( $watchList[$i]->id_movie );
        }
        require_once __DIR__ . '/../view/admin.php';

        

    }




    public function logout(){
        
        session_unset();
        session_destroy();

        require_once __DIR__ . '/../view/_header.php';
        require_once __DIR__ . '/../view/menu.php';
        require_once __DIR__ . '/../view/_footer.php';

    }


}