window.taskManagerQuickTask.date = {};

window.taskManagerQuickTask.date.init = function() {
	jQuery( document ).on( 'click', '.date', function( e ) {
		jQuery( this ).datepicker( {
			dateFormat: 'dd/mm/yy'
		} );

		jQuery( this ).datepicker( 'show' );
	} );
};
