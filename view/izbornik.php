<?php
require_once __DIR__ . '/_header.php';
?>



    <hr>
        <dl>
            <dt>
                <input type="text">search</input>
            </dt>
            <dt>
                <a href="chat.php?rt=channels/naslovna">Search</a>
            </dt>
            <dt>
                <a href="chat.php?rt=channels/index">Top rated</a>
            </dt>
            <dt>
                <a href="chat.php?rt=channels/new">Most popular</a>
            </dt>
            <dt>
                <a href="chat.php?rt=channels/mojePoruke">Sign in</a>
            </dt>
        </dl>
    <hr>

    <h2> <?php echo $title; ?> </h2>

<?php
require_once __DIR__ . '/_footer.php';
?>