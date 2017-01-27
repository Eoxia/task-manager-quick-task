window.taskManagerQuickTask.input = {};

window.taskManagerQuickTask.input.init = function() {
	window.taskManagerQuickTask.input.event();
};

window.taskManagerQuickTask.input.event = function() {
  jQuery( document ).on( 'keyup', '.digirisk-wrap .form-element input, .digirisk-wrap .form-element textarea', window.taskManagerQuickTask.input.keyUp );
};

window.taskManagerQuickTask.input.keyUp = function( event ) {
	if ( 0 < jQuery( this ).val().length ) {
		jQuery( this ).closest( '.form-element' ).addClass( 'active' );
	} else {
		jQuery( this ).closest( '.form-element' ).removeClass( 'active' );
	}
};
