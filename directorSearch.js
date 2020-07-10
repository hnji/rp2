
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
                if( !data.title.length )
                    alert( 'There is no director ' + unos + ' in database.' );
                //var lista = $( '<ol></ol>' );
                else
                {
                    $( '#movies' ).append( $( '<h3>' + unos + ' movies:</h3>' ) );
                
                // Jednostavno sve što dobiješ od servera stavi u dataset.
                    for ( var i = 0; i < data.title.length; ++i )
                    {
                        //console.log(data.title[i]);
                        var li = $( '<div class="movie_title" onmouseenter="prikaziInfo()" onmouseleave="sakrijInfo()">' + (i+1) + '. ' + data.title[i] + '</div>' );
                        //console.log(li);
                        li.prop( 'id', data.id_movie[i] );
                        //console.log( data.id_movie[i] );
                        //$option.attr( 'value', i );
                        //$( "#datalist_director" ).append($( '<option value="' + i + '">' + i + '</option>' ));
                        //append( $option );
                        $( '#movies' ).append( li );


                    }
                }
                

                //$( '#movies' ).append( lista );
                    
            },
            error: function( xhr, status )
            {
                if( status !== null )
                    console.log( "Greška prilikom Ajax poziva: " + status );
            }
        } );


}


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


    //$( "<div>" ).on( "mouseenter", prikaziInfo );
    //$( "<div>" ).on( "mouseleave", sakrijInfo );
    
} );




/*
prikaziInfo = function( event )
{
	// Dohvati element nad kojim je događaj.
	var a = $( this );

	// Dohvati podatke o odgovarajućoj datoteci.
	$.ajax(
	{
		url: "balon.php",
		data: { id_movie: a.prop( "id" ) },
		dataType: "json",
		success: function( data )
		{
			console.log( "Dobio od servera: " + JSON.stringify( data ) );

			// Stvori balon (div) i prikaži ga.
			var div = $( "<div></div>" );

			// Uoči: PHP vrati lastModified u sekundama od 1.1.1970.
			// JavaScript koristi milisekunde.
			div
				.prop( "id", "balon" )
				.css(
				{
					"position": "absolute",
					"left": event.clientX + 20,
					"top": event.clientY + 20,
					"border": "solid 1px",
					"background-color": "rgb(245, 245, 255)",
					"padding": "5px"
                } )
                .html(
                    'Average rating: ' + data.average_rating + 
                    '<br>Release year: ' + data.release_year + 
                    '<br>Genre: ' + data.genre + 
                    '<br>Cast: ' + data.cast
                );


			$( "body" ).append( div );
		}
	} );
}


sakrijInfo = function()
{
	// Samo ukloni (jedini) element sa id-om "balon"
	$( "#balon" ).remove();
}*/