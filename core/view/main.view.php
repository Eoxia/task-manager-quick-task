<?php
/**
 * Affiches le formulaire pour ajouter une tâche rapidement.
 *
 * @author Jimmy Latour <jimmy@eoxia.com>
 * @since 0.0.0.1
 * @version 0.0.0.1
 * @copyright 2017 Eoxia
 * @package core
 * @subpackage view
 */

namespace task_manager_quick_task;

if ( ! defined( 'ABSPATH' ) ) {	exit; } ?>

<form method="POST" style="width: 100%" action="<?php echo esc_attr( admin_url( 'admin-ajax.php' ) ); ?>" class="form quick-task">
	<input type="hidden" name="action" value="create_quick_task" />
	<input type="hidden" name="parent_id" value="<?php echo esc_attr( \eoxia\config_util::$init['task-manager-quick-task']->client_parent_id ); ?>" />
	<?php wp_nonce_field( 'create_quick_task' ); ?>

	<textarea style="width: 100%" name="comment"></textarea>
	<input type="text" name="time" value="15" />
	<input type="submit" class="submit-form" />
</form>

<ul class="quick-task-log"></ul>
