/**
 * Initialise l'objet "taskManagerQuickTask" ainsi que la méthode "init" obligatoire pour la bibliothèque EoxiaJS.
 *
 * @since 0.0.0.1
 * @version 0.0.0.1
 */

window.eoxiaJS.taskManagerQuickTask.core = {};

window.eoxiaJS.taskManagerQuickTask.core.init = function() {};

window.eoxiaJS.taskManagerQuickTask.core.createQuickTaskSuccess = function( element, response ) {
	jQuery( '.form.quick-task textarea[name="comment"]' ).val( '' );
	jQuery( '.form.quick-task input[name="time"]' ).val( '15' );
	jQuery( '.quick-task-log' ).append( '<li>' + response.data.time.time.date + ' : ' + response.data.time.time.content + '</li>' );
};
