( function( api ) {

	// Extends our custom "vr-gaming" section.
	api.sectionConstructor['vr-gaming'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );