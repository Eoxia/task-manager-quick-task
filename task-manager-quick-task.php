<?php
/**
 * Fichier boot du plugin
 *
 * @package Eoxia\Plugin
 */

namespace task_manager_quick_task;
/**
 * Plugin Name: Task Manager Quick Task
 * Plugin URI:
 * Description: Outils pour écrire des tâches rapidements dans le compte client "eoxia" de WPShop.
 * Version:     1.0.0.0
 * Author:      Eoxia
 * Author URI:  http://www.eoxia.com
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Domain Path: /core/assets/languages
 * Text Domain: task-manager-quick-task
 */

DEFINE( 'PLUGIN_TASK_MANAGER_QUICK_TASK_PATH', str_replace( '\\', '/', realpath( plugin_dir_path( __FILE__ ) ) . '/' ) );
DEFINE( 'PLUGIN_TASK_MANAGER_QUICK_TASK_URL', plugins_url( basename( __DIR__ ) ) . '/' );
DEFINE( 'PLUGIN_TASK_MANAGER_QUICK_TASK_DIR', basename( __DIR__ ) );

require_once 'core/external/wpeo_util/singleton.util.php';
require_once 'core/external/wpeo_util/init.util.php';
require_once 'core/external/wpeo_log/class/log.class.php';

\eoxia\Init_Util::g()->exec( PLUGIN_TASK_MANAGER_QUICK_TASK_PATH, basename( __FILE__, '.php' ) );
