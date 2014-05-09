var currentURL = 'resumen'; // almacena la direccion actual para evitar la recarga

function drawContent( data )
{
	$( '.subchapter-title' ).text( data.SubChapter );
	$( '.content' ).html(data.Content );
} // end drawContent

//****************************************************************************

function getContent( element )
{
	url = element.attr( 'id' );

	currentURL = url;

	$.ajax({
		url: '',
		dataType: 'json',
		data: {'ajax':'true','update':'Content', 'url':url },
		contentType: 'application/x-www-form-urlencoded',
		error: function() {
			alert( 'Ha ocurrido un error' );
		},
		success: function( data ) {
			drawContent( data );
			getGist();
		},
		ifModified: false,
		processData: true,
		type: 'POST',
	});
} // end getContent

//****************************************************************************

function getGist(){
	
    $('div[data-gist]').ajaxgist();
}

//*****************************************************************************

$(document).on( 'ready', function(){
	
	$("a.subchapter").on( 'click', function( e ) {
  		e.preventDefault();		
		history.pushState({}, '', $(this).attr("href"));
		getContent( $(this) );
    	return;
    	
  	});

  	getGist();

});
