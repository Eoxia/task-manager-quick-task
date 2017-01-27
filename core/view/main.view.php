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

<form action="<?php echo esc_attr( admin_url( 'admin-ajax.php' ) ); ?>" class="form quick-task">
	<input type="hidden" name="action" value="create_quick_task" />
	<input type="hidden" name="parent_id" value="10" />
	<?php wp_nonce_field( 'create_quick_task' ); ?>

	<textarea name="comment"></textarea>
	<input type="text" name="time" value="15" />
	<input type="submit" class="submit-form" />
</form>
