



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
                for ( var i = 0; i < data.length; ++i )
                {
                    
                    var option = $( '<option></option>' );
                    option.attr( 'value', data[i] );
                    //option.attr( 'id', data.directors[i].id_movie );
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


function search()
{
    var txt = $( "#director_search" );
    var unos = txt.val(); 

    $.ajax(
        {
            method: 'get',
            url: "moviesbydirector.php",
            data:
            {
                q: unos
            },
            success: function( data )
            {
                $( '#movies' ).html( '' );
                var lista = $( '<ol></ol>' );
                $( '#movies' ).append( $( '<h3>' + unos + ' movies:</h3>' ) );
                
                // Jednostavno sve što dobiješ od servera stavi u dataset.
                for ( var i = 0; i < data.title.length; ++i )
                {
                    console.log(data.title[i]);
                    var li = $( '<li>' + data.title[i] + '</li>' );
                    console.log(li);
                    li.attr( 'id', data.id_movie[i] );
                    //$option.attr( 'value', i );
                    //$( "#datalist_director" ).append($( '<option value="' + i + '">' + i + '</option>' ));
                    //append( $option );
                    lista.append( li );


                }

                $( '#movies' ).append( lista );
                    
            },
            error: function( xhr, status )
            {
                if( status !== null )
                    console.log( "Greška prilikom Ajax poziva: " + status );
            }
        } );


}