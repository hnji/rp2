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
                for ( var i = 0; i < data.movies.length; ++i )
                {
                    $option = $( '<option></option>' );
                    $option.attr( 'value', data.movies[i].title );
                    $( "#datalist_search" ).append( $option );
                }
                    
            },
            error: function( xhr, status )
            {
                if( status !== null )
                    console.log( "Greška prilikom Ajax poziva: " + status );
            }
        } );
    } );
} );