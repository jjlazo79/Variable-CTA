<?php

/**
 * Class VariableCTAsShortcode
 *
 * Handles the creation of a custom shortcode
 *
 * @subpackage WordPress
 * @package Variable_Ctas
 */
class VariableCTAsShortcode
{

	/**
	 * A reference to an instance of this class.
	 */
	private static $instance;

	/**
	 * Returns an instance of this class.
	 */
	public static function get_instance()
	{

		if (null == self::$instance) {
			self::$instance = new VariableCTAsShortcode();
		}

		return self::$instance;
	}

	/**
	 * Initializes the plugin by setting filters and administration functions.
	 */
	private function __construct()
	{
		// Add shortcode
		add_shortcode(
			'variable_cta',
			array($this, 'vc_shortcode_handler')
		);
	}

	/**
	 * Register shortcode Variable CTA
	 */
	public function vc_shortcode_handler($atts)
	{
		// Only in shortcode page insert
		VariableCTAsShortcode::vc_enqueue_front_scripts();
		$options         = get_option('vc_general_options');
		$default_version = ($options['vc_version']) ? $options['vc_version'] : 1;
		$default_avatar  = ($options['vc_avatar']) ? $options['vc_avatar'] : '';
		$default_phone   = ($options['vc_phone']) ? $options['vc_phone'] : '932 828 064';
		$default_color   = ($options['vc_color']) ? $options['vc_color'] : '#942192';

		$a = shortcode_atts(array(
			'version' => $default_version,
			'avatar'  => $default_avatar,
			'phone'   => $default_phone,
			'color'   => $default_color
		), $atts);

		$image_id      = attachment_url_to_postid($a['avatar']);
		$thumbnail_url = wp_get_attachment_image_src($image_id, 'medium');


		ob_start();

		echo $a['version'] . '<br>';
		echo $a['avatar'] . '<br>';
		echo '<div class="wrap"><img src="' . $thumbnail_url[0] . '"></div>';
		echo $a['phone'] . '<br>';
		echo $a['color'] . '<br>';

		$output = ob_get_clean();

		return $output;
	}


	/**
		* Enqueue front scripts
		*
		* @return void
		*/
	public static function vc_enqueue_front_scripts()
	{
		wp_enqueue_style('vc-shortcode-styles', VARIABLECTAS_PLUGIN_DIR_URL . "assets/css/shortcode.css");
		// wp_enqueue_style('vc-shortcode-fontawesome', 'https://pro.fontawesome.com/releases/v5.10.0/css/all.css');
		wp_enqueue_script('vc-shortcode-script', VARIABLECTAS_PLUGIN_DIR_URL . "assets/js/shortcode.js");
	}
}
