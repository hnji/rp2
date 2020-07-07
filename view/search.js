$( document ).ready( function()
{
    var txt_godine = $( "#txt_year" ); //txt_redatelj = $( "#txt_director" );
    
    
    // Kad netko nešto tipka u text-box:
    txt_godine.on( "input", function(e)
    {
        var unos = $( this ).val(); // this = HTML element input, $(this) = jQuery objekt
        //console.log("unos = " + unos);

        
        // Napravi Ajax poziv sa GET i dobij sva imena koja sadrže s kao podstring
        $.ajax(
        {
            url: "search_function.php",
            data:
            {
                q: unos
            },
            success: function( data )
            {
                // Jednostavno sve što dobiješ od servera stavi u dataset.
                $( "#datalist_godine" ).html( data );
            },
            error: function( xhr, status )
            {
                if( status !== null )
                    console.log( "Greška prilikom Ajax poziva: " + status );
                //console.log("unos = " + unos);
            }
        } );

        
    } );

    /*txt_redatelj.on( "input", function(e)
    {
        var unos = $( this ).val(); // this = HTML element input, $(this) = jQuery objekt

        // Napravi Ajax poziv sa GET i dobij sva imena koja sadrže s kao podstring
        $.ajax(
        {
            url: "search_function.php",
            data:
            {
                q: unos,
                f: 1
            },
            success: function( data )
            {
                // Jednostavno sve što dobiješ od servera stavi u dataset.
                $( "#datalist_redatelj" ).html( data );
            },
            error: function( xhr, status )
            {
                if( status !== null )
                    console.log( "Greška prilikom Ajax poziva: " + status );
            }
        } );
    } );*/

} );

