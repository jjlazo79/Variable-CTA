<?php

/**
 * Variable CTAs
 *
 * @package           WordPress
 * @subpackage        Variable_Ctas
 * @author            Jose Lazo
 * @copyright         2019 Jose Lazo
 * @license           GPL-2.0-or-later
 *
 * Plugin Name:       Variable CTAs
 * Plugin URI:        https://joselazo.es/variable-ctas
 * Description:       A collection of shortcodes to display diferents CTAs
 * Author:            jjlazo79
 * Author URI:        https://joselazo.es
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       variable-ctas
 * Domain Path:       /languages
 * Version:           1.0.6
 * Requires at least: 5.2
 * Requires PHP:      7.0
 */

declare(strict_types=1);
// If this file is called directly, abort.
defined('ABSPATH') or die('Bad dog. No biscuit!');

define('VARIABLECTAS_PLUGIN_DIR_PATH', plugin_dir_path(__FILE__));
define('VARIABLECTAS_PLUGIN_DIR_URL', plugin_dir_url(__FILE__));
/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 */
define('VARIABLECTAS_VERSION', '1.0.6');
/**
 * Plugin text domain to localize.
 */
define('VARIABLECTAS_TEXT_DOMAIN', 'variable-ctas');

// Activation, deactivation and uninstall plugin hooks
register_activation_hook(__FILE__, array('VariableCTAsPlugin', 'variablectas_plugin_activation'));
register_deactivation_hook(__FILE__, array('VariableCTAsPlugin', 'variablectas_plugin_deactivation'));
register_uninstall_hook(__FILE__, array('VariableCTAsPlugin', 'variablectas_plugin_uninstall'));

// Initialize the plugin
$seers_services_plugin = new VariableCTAsPlugin();

class VariableCTAsPlugin
{
	/**
	 * Initializes the plugin.
	 *
	 * To keep the initialization fast, only add filter and action
	 * hooks in the constructor.
	 */
	public function __construct()
	{
		// Include classes
		include_once 'classes/class-VariableCTAsOptions.php';
		include_once 'classes/class-VariableCTAsShortcode.php';
		// Actions
		add_action('init', array($this, 'mv_localize_scripts'));
		add_action('plugins_loaded', array('VariableCTAsOptions', 'get_instance'));
		add_action('plugins_loaded', array('VariableCTAsShortcode', 'get_instance'));
		// Filters
	}

	/**
	 * Activation hook
	 *
	 * @return void
	 */
	public static function variablectas_plugin_activation()
	{
		if (!current_user_can('activate_plugins')) return;

		// Clear the permalinks after the post type has been registered.
		flush_rewrite_rules();
	}

	/**
	 * Deactivation hook
	 *
	 * @return void
	 */
	public static function variablectas_plugin_deactivation()
	{
		// Unregister the post type and taxonomies, so the rules are no longer in memory.
		// unregister_post_type('custom_post_type');
		// unregister_taxonomy('taxonomy_name');
		// Clear the permalinks to remove our post type's rules from the database.
		flush_rewrite_rules();
	}

	/**
	 * Unistall hook
	 *
	 * @return void
	 */
	public static function variablectas_plugin_uninstall()
	{
		// Delete options
		delete_option('vc_general_options');
	}

	/**
	 * Localize path folder
	 *
	 * @return void
	 */
	public function mv_localize_scripts()
	{
		$domain = VARIABLECTAS_TEXT_DOMAIN;
		$locale = apply_filters('plugin_locale', get_locale(), $domain);
		load_textdomain($domain, trailingslashit(WP_LANG_DIR) . $domain . '/' . $domain . '-' . $locale . '.mo');
		load_plugin_textdomain($domain, FALSE, basename(dirname(__FILE__)) . '/languages');
	}
}
