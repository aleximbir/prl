jQuery( document ).ready( function( $ ) {

/*** PRODUCTS ***/

	// Add New Row
	var i = 1;
	$( document ).on( 'click', '#repeater-new-row', function( e ) {
		e.preventDefault();

		var $content = $( base_prl_admin_main.repeater_content ); i++;

		$content.filter('.repeater-row').attr( 'id', 'repeater-row' + i );

		if ( $( '.repeater-wrapper' ).is( ':empty' ) ) {
			$( ".repeater-wrapper" ).append( $( $content[0] ) );
		} else {
			$( $content[0] ).insertAfter( $( ".repeater-row" ).last() );
		}
	});

	// Add Fields In Row
	$( document ).on( 'change', '#repeater-rows-count', function( e ) { 
		e.preventDefault();

		span = $( this ).siblings( '.row-name-list' ).find('span');

		field = $( this ).parent().siblings( '#fields-to-repeat' ).children( '#field' );

		field_val = $( this ).val();

		fields_no = $( this ).parent().siblings( '#fields-to-repeat' ).children( '#field' ).length;
		
		if ( parseInt( $( this ).val() ) > parseInt( fields_no ) ) {
			for( row = fields_no; row < $( this ).val(); row++ ) {
				$( this ).parent().parent().children( "#fields-to-repeat" ).append( base_prl_admin_main.repeater_field_content );
				$( this ).siblings( '.row-name-list' ).append( '<span></span>' );
			}
		} else if ( parseInt( $( this ).val() ) < parseInt( fields_no ) ) {
			field.each( function() {
				if( $( this ).index() >= field_val ){
					$( this ).remove();
				}
			});

			span.each( function() {
				if( $( this ).index() >= field_val ){
					$( this ).remove();
				}
			});
		}
	});

	// Show/Hide Row Content
	$( document ).on( 'click', '#handlediv-prl-row', function( e ) {
		e.preventDefault();

		var $current_row = $( this ).siblings( "#fields-to-repeat" );
		if ( $current_row.css( "display" ) == "none" ) {
			$current_row.slideDown();
			$( this ).children(".toggle-indicator-up").attr('class', 'toggle-indicator');
		} else {
			$current_row.slideUp();
			$( this ).children(".toggle-indicator").attr('class', 'toggle-indicator-up');
		}
	});

	// Remove the row
	$( document ).on( 'click', '.remove-row', function( e ) { 
		e.preventDefault();

		$( this ).parent().parent().slideUp( 500, function() {
			$( this ).remove();
		});
	});

	// Display fields name on row
	$( document ).on( 'change', '#field input', function( e ) {
		input_index = $(this).parent().index();
		$( this ).parent().parent().siblings( '#fields-count' ).children( '.row-name-list' ).children( 'span' ).eq(input_index).text( $( this ).val() + '; ' );
	});

/*** END PRODUCTS ***/

});