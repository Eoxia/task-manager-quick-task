window.taskManagerQuickTask.render = {};

window.taskManagerQuickTask.render.init = function() {
	window.taskManagerQuickTask.render.event();
};

window.taskManagerQuickTask.render.event = function() {};

window.taskManagerQuickTask.render.callRenderChanged = function() {
	var key = undefined;

	for ( key in window.taskManagerQuickTask ) {
		if ( window.taskManagerQuickTask[key].renderChanged ) {
			window.taskManagerQuickTask[key].renderChanged();
		}
	}
};
