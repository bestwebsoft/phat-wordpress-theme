(function( $ ) {

	/* Function that changes padding for each window size, calls custom selectBox and fileInput */
	$( document ).ready( function() {
		$( 'input[type=file]' ).nicefileinput();
		var width           = window.innerWidth,
				padd            = ( width - 940 ) / 2,
				padding         = padd / width * 100,
				padding_percent = padding.toFixed( 1 ) + '%';
		$( 'header' ).css( 'padding-left', padding_percent );
		$( '.content' ).css( 'padding-left', padding_percent );
		$( 'select' ).selectBox();
		$( "#back-top" ).hide();

		/* scroll body to 0px on click */
		$( '#back-top a' ).click( function() {
			$( 'body, html' ).animate( {
				scrollTop: 0
			}, 300 );
			return false;
		} );

		/* Custom Radio & Checkboxes */
		$( 'input' ).iCheck( {
			checkboxClass: 'icheckbox_minimal',
			radioClass:    'iradio_minimal'
		} );
	} );

	/* Fixes left padding when window resizes */
	$( window ).resize( function() {
		var width           = window.innerWidth,
				padd            = ( width - 940 ) / 2,
				padding         = padd / width * 100,
				padding_percent = padding.toFixed( 1 ) + '%';
		$( 'header' ).css( 'padding-left', padding_percent );
		$( '.content' ).css( 'padding-left', padding_percent );
	} );

	/* For scroll to top function */
	$( window ).scroll( function() {
		if ( $( this ).scrollTop() > 100 ) {
			$( '#back-top' ).fadeIn( 200 );
		} else {
			$( '#back-top' ).fadeOut( 200 );
		}
	} );
})( jQuery );