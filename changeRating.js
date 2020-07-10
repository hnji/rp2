$( document ).ready( function()
{
    var btn = $( "#rate" );

    // Kad netko nešto tipka u text-box:
    btn.on( "click", function(e)
    {
        var ocjena = $( ".rating:checked" ).val(); // this = HTML element input, $(this) = jQuery objekt
        var user_id = $( "#js_user_id").val();
        var movie_id = $( "#js_movie_id").val();

        $.ajax(
        {
            method: 'get',
            url: "changeRating.php",
            data:
            {
                ocjena: ocjena,
                user_id: user_id,
                movie_id: movie_id
            },
            success: function( data )
            {
                $( "#js_averagerating" ).html( data.average );
                $( "#js_yourrating" ).html( data.your ); 
            },
            error: function( xhr, status )
            {
                if( status !== null )
                    console.log( "Greška prilikom Ajax poziva: " + status );
            }
        } );
    } );
} );
