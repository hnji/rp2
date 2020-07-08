



    <hr>
        <dl>
            <dt>
            <input type="text" value="search movies" list="datalist_search" id="txt_search">
                <datalist id="datalist_search"></datalist>
                <button type="submit">Search!</button>
                
            </dt>
            <dt>
                <br><br>
                <a href="teka.php?rt=movies/search">Search</a>
            </dt>
            <dt>
                <a href="teka.php?rt=movies/allmovies">All movies</a>
            </dt>
            <dt>
                <a href="teka.php?rt=movies/toprated">Top rated</a>
            </dt>
            <dt>
                <a href="teka.php?rt=movies/mostpopular">Most popular</a>
            </dt>
            <dt>
                <a href="teka.php?rt=user/signin">Sign in</a>
            </dt>
            <dt>
                <a href="teka.php?rt=admin/index">My profile</a>
            </dt>
        </dl>
    </hr>
    <hr></hr>

    <script>

$( document ).ready( function()
{
    var txt = $( "#txt_search" );

    // Kad netko nešto tipka u text-box:
    txt.on( "input", function(e)
    {
        var unos = $( this ).val(); // this = HTML element input, $(this) = jQuery objekt

        // Napravi Ajax poziv sa GET i dobij sva imena koja sadrže s kao podstring
        $.ajax(
        {
            method: 'get',
            url: "searchSuggest.php",
            data:
            {
                q: unos
            },
            success: function( data )
            {
                // Jednostavno sve što dobiješ od servera stavi u dataset.
                $( "#datalist_search" ).html( data );
            },
            error: function( xhr, status )
            {
                if( status !== null )
                    console.log( "Greška prilikom Ajax poziva: " + status );
            }
        } );
    } );
} );

</script>