<?php
/**
 * L'action qui boot l'application
 *
 * @package Eoxia\Core
 *
 * @since 0.0.0.1
 * @version 0.0.0.1
 */

namespace task_manager_quick_task;

if ( ! defined( 'ABSPATH' ) ) {	exit; }

/**
 * L'action qui boot l'application
 */
class Task_Manager_Quick_Task_Action {

	/**
	 * Le constructeur
	 *
	 * @since 0.0.0.1
	 * @version 0.0.0.1
	 */
	public function __construct() {
		add_action( 'admin_enqueue_scripts', array( $this, 'callback_before_admin_enqueue_scripts' ), 10 );
		add_action( 'admin_enqueue_scripts', array( $this, 'callback_admin_enqueue_scripts' ), 11 );
		add_action( 'admin_bar_menu', array( $this, 'callback_admin_bar_menu' ), 105 );

		add_action( 'wp_ajax_open_popup_quick_task', array( $this, 'callback_open_popup_quick_task' ) );
		add_action( 'wp_ajax_create_quick_task', array( $this, 'callback_create_quick_task' ) );
	}

	/**
	 * Initialise les fichiers JS inclus dans WordPress: thickbox
	 *
	 * @return void
	 *
	 * @since 0.0.0.1
	 * @version 0.0.0.1
	 */
	public function callback_before_admin_enqueue_scripts() {
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'jquery-form' );
		add_thickbox();
	}

	/**
	 * Initialise le fichier style.min.css et backend.min.js du plugin.
	 *
	 * @return void
	 *
	 * @since 0.0.0.1
	 * @version 0.0.0.1
	 */
	public function callback_admin_enqueue_scripts() {
		wp_enqueue_script( 'task-manager-quick-task-script', PLUGIN_TASK_MANAGER_QUICK_TASK_URL . 'core/assets/js/backend.min.js', array(), config_util::$init['task-manager-quick-task']->version, false );
	}


	/**
	 * Permet d'afficher la dashicons qui vas être affiché dans la barre de WordPress.
	 *
	 * @param mixed $wp_admin_bar L'objet de WordPress pour gérer les noeuds.
	 *
	 * @return void
	 *
	 * @since 0.0.0.1
	 * @version 0.0.0.1
	 */
	public function callback_admin_bar_menu( $wp_admin_bar ) {

		$query_args = array(
			'action' => 'open_popup_quick_task',
		);

		$href = add_query_arg( $query_args, admin_url( 'admin-ajax.php' ) );

		$button_open_popup = array(
			'id'       	=> 'button-open-popup-quick-task',
			'parent'		=> 'new-content',
			'href'			=> '#',
			'title'    	=> __( 'Tâche rapide', 'task_manager_quick_task' ),
			'meta'		 	=> array(
				'onclick' => 'tb_show( "Tâche rapide", "' . $href . '")',
			),
		);

		$wp_admin_bar->add_node( $button_open_popup );
	}

	/**
	 * Cette méthode appelle une vue qui se renvoyé au rendu de la thickbox.
	 *
	 * @return void
	 *
	 * @since 0.0.0.1
	 * @version 0.0.0.1
	 */
	public function callback_open_popup_quick_task() {
		ob_start();
		require( PLUGIN_TASK_MANAGER_QUICK_TASK_PATH . '/core/view/main.view.php' );
		wp_die( ob_get_clean() ); // WPCS: XSS is ok.
	}

	/**
	 * Cette méthode créer une tâche si celle-ci n'existe pas dans le client "technique@eoxia.com".
	 * Elle créer également un point correspondant à la date du jour, puis elle ajoute le commentaire + le temps entré
	 * par l'utilisateur dans ce point.
	 *
	 * @return void
	 *
	 * @since 0.0.0.1
	 * @version 0.0.0.1
	 */
	public function callback_create_quick_task() {
		check_ajax_referer( 'create_quick_task' );

		$parent_id = ! empty( $_POST['parent_id'] ) ? (int) $_POST['parent_id'] : 0;
		$comment = ! empty( $_POST['comment'] ) ? sanitize_text_field( $_POST['comment'] ) : '';
		$time = ! empty( $_POST['time'] ) ? sanitize_text_field( $_POST['time'] ) : '';

		if ( 0 === $parent_id || '' === $comment || '' === $time ) {
			wp_send_json_error();
		}

		global $task_controller;
		global $point_controller;
		global $time_controller;

		$current_user = wp_get_current_user();

		$task = $task_controller->index( array(
			'post_parent' => $parent_id,
			'name' => 'unclassified',
		) );

		if ( empty( $task ) ) {
			$task = $task_controller->create( array(
				'parent_id' => $parent_id,
				'title' => __( 'Unclassified', 'task-manager-quick-task' ),
			) );
		} else {
			$task = $task[0];
		}

		$point = $point_controller->index( $task->id, array(
			'user_id' => $current_user->ID,
			'status' => -34070,
		) );

		if ( empty( $point ) ) {
			$point = $point_controller->create( array(
				'status' => '-34070',
				'author_id' => $current_user->ID,
				'post_id' => $task->id,
				'content' => $current_user->user_login,
			) );

			$task->option['task_info']['order_point_id'][] = (int) $point->id;
			$task_controller->update( $task );
		} else {
			$point = $point[0];
		}

		$time = $time_controller->create( array(
			'status' => '-34070',
			'content' => $comment,
			'date' => current_time( 'mysql' ),
			'parent_id' => $point->id,
			'option' => array(
				'time_info' => array(
					'elapsed' => $time,
				),
			),
		) );

		wp_send_json_success( array(
			'module' => 'core',
			'callback_success' => 'createQuickTaskSuccess',
			'time' => $time,
		) );
	}
}

new Task_Manager_Quick_Task_Action();
