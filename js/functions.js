( function( $ ) {

	/**
	 * Primary menu toggle
	 */
	$( '#primary-menu-toggle' ).click( function( e ) {
		var _this = $( this ),
		    _menu = $( '#primary-menu' );

		_this.toggleClass( 'toggle-on' );

		_menu.attr( 'aria-expanded', _menu.attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' ).toggleClass( 'toggle-on' );

		e.preventDefault();
	} );

	/**
	 *	Remove Mailerlite styles
	 */
	$( '.widget_mailerlite_widget' ).find( 'style' ).remove();

	/**
	 *	Disable logo click on landing pages
	 */
	$( '.page-template-landing .custom-logo-link, .page-template-landing .site-title a, .testimonial-entry-title a' ).click( function( e ) {
		return false;
	} );

	/**
	 * Hero slideshow
	 */
	$( '.panel:first-child' ).backstretch( forme.header_images, { duration: 3000, fade: 750 } );

} )( jQuery );
