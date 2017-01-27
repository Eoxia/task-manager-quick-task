window.taskManagerQuickTask.form = {};

window.taskManagerQuickTask.form.init = function() {
    window.taskManagerQuickTask.form.event();
};
window.taskManagerQuickTask.form.event = function() {
    jQuery( document ).on( 'click', '.submit-form', window.taskManagerQuickTask.form.submitForm );
};

window.taskManagerQuickTask.form.submitForm = function( event ) {
	var element = jQuery( this );

	element.closest( 'form' ).addClass( 'loading' );

	event.preventDefault();
	element.closest( 'form' ).ajaxSubmit( {
		success: function( response ) {
			element.closest( 'form' ).removeClass( 'loading' );

			if ( response && response.success ) {
				if ( response.data.module && response.data.callback_success ) {
					window.taskManagerQuickTask[response.data.module][response.data.callback_success]( element, response );
				}
			} else {
				if ( response.data.module && response.data.callback_error ) {
					window.taskManagerQuickTask[response.data.module][response.data.callback_error]( element, response );
				}
			}
		}
	} );
};
