<?php
require_once __DIR__ . '/_header.php';
?>



    <hr>
        <dl>
            <dt>
                <input type="text"value="search movies">
            </dt>
            <dt>
                <a href="teka.php?rt=movies/search">Search</a>
            </dt>
            <dt>
                <a href="teka.php?rt=movies/toprated">Top rated</a>
            </dt>
            <dt>
                <a href="teka.php?rt=movies/mostpopular">Most popular</a>
            </dt>
            <dt>
                <a href="teka.php?rt=users/signin">Sign in</a>
            </dt>
        </dl>
    <hr>

    <h2> <?php echo $title; ?> </h2>

<?php
require_once __DIR__ . '/_footer.php';
?>