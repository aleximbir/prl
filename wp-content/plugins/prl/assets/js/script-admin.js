jQuery( document ).ready( function( $ ) {

	var cloneCount = 1;
	
	$( '#repeater-new-row' ).click( function( e ) {
		e.preventDefault();
		$( "#repeater-row" ).clone().attr( 'id', 'repeater-row' + cloneCount++ ).insertAfter( "#repeater-row" );
	});

	$( '#repeater-rows-count' ).change( function( e ) {
		e.preventDefault();

		var field_content = $( "#field" ).clone().attr({ 'id' : 'field' + cloneCount++ });

		$("#fields-to-repeat > *:not('#field')").remove();
		for( row = 1; row <= $( this ).val(); row++ ){
			$( "#fields-to-repeat" ).append('\
				<div id="field'+ cloneCount++ +'">\
				<input type="text" placeHolder="Name" name="repeater-inp-name" />\
				<select name="repeater-inp-type" id="repeater-inp-type">\
					<option value="">Type</option>\
					<option value="text">Text</option>\
					<option value="radio">Radio</option>\
					<option value="checkbox">Checkbox</option>\
					<option value="textarea">Textarea</option>\
					<option value="slide">Slide</option>\
					<option value="select">Select</option>\
					<option value="file">File</option>\
					<option value="color">Color</option>\
					<option value="wysiwyg">WYSIWYG</option>\
				</select>\
			</div>\
			');
		}
	});

	$( '.hide-repeater-row.toggle-indicator' ).click( function( e ) {
		e.preventDefault();
		$( "#fields-to-repeat" ).toggle('show');
	});

});