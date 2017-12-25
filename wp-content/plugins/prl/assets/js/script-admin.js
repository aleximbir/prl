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

	// Select single checkbox
	$( document ).on( 'change', 'input[type="checkbox"]', function( e ) {
		$( this ).siblings('input[type="checkbox"]').not(this).prop('checked', false);
	});

	// Open settings popup
	$( document ).on( 'click', '#prl-settings-modal', function( e ) {
		$( this ).siblings( '.prl-popup' ).slideDown();
	});

	// Empty popup onchange
	$( document ).on( 'change', '#repeater-inp-type', function( e ) {

		var content = '';

		$( this ).siblings( '.popup-wrapper' ).children( '.prl-popup' ).empty();

		if ( $( this ).siblings( '.popup-wrapper' ).children( '.prl-popup' ).css( "display" ) == "block" ) {
			$( this ).siblings( '.popup-wrapper' ).children( '.prl-popup' ).append( $( content ) );
		}
	});

	// Close settings popup
	$( document ).on( 'click', '#prl-close-modal, #repeater-type-save', function( e ) { 
		e.preventDefault();

		$( this ).parent().slideUp( 500, function() {
			$( this ).hide();
		});
	});

	// Populate default values
	$( document ).on( 'change', '#repeater-type-values', function( e ) {
		var repeater_values = $( this ).siblings( "#repeater-type-default-value" );
		repeater_values.empty();

		var values = $( this ).val().split("\n");
		$.each( values, function( index, value ) {
			value_formatted = value.replace(/ /g,"_");
			value_formatted = value_formatted.toLowerCase();
			repeater_values.append('<option value="' + value_formatted + '">' + value + '</option>');
		});
	});

/*** END PRODUCTS ***/

});