'use strict';

window.eoxiaJS = {};
window.taskManagerQuickTask = {};

window.eoxiaJS.init = function() {
	window.eoxiaJS.loadScripts();
	window.eoxiaJS.initArrayForm();
};

window.eoxiaJS.loadScripts = function() {
	var key;
	for ( key in window.taskManagerQuickTask ) {
		window.taskManagerQuickTask[key].init();
	}
};

window.eoxiaJS.initArrayForm = function() {
	 window.eoxiaJS.arrayForm.init();
};

jQuery( document ).ready( window.eoxiaJS.init );
