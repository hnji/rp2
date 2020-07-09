

$( document ).ready( function()
{
    var txt = $( "#director_search" );

    // Kad netko nešto tipka u text-box:
    txt.on( "input", function(e)
    {
        var unos = $( this ).val(); // this = HTML element input, $(this) = jQuery objekt

        // Napravi Ajax poziv sa GET i dobij sva imena koja sadrže s kao podstring
        $.ajax(
        {
            method: 'get',
            url: "directorSearch.php",
            data:
            {
                q: unos
            },
            success: function( data )
            {
                $( "#datalist_director" ).empty();
                
                
                // Jednostavno sve što dobiješ od servera stavi u dataset.
                for ( var i = 0; i < 5; ++i )
                {
                    
                    var option = $( '<option>' + data.directors[i].director + '</option>' );
                    option.attr( 'value', data.directors[i].director );
                    //$option.attr( 'value', i );
                    //$( "#datalist_director" ).append($( '<option value="' + i + '">' + i + '</option>' ));
                    //append( $option );
                    $( "#datalist_director" ).append( option );
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