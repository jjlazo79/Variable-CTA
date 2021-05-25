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
		// Add action
		add_action('wp_head',
			array($this, 'vc_data_layer')
		);
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
		// Get default values if set
		$options            = get_option('vc_general_options');
		$default_version    = ($options['vc_version']) ? $options['vc_version'] : 1;
		$default_avatar     = ($options['vc_avatar']) ? $options['vc_avatar'] : VARIABLECTAS_PLUGIN_DIR_URL . 'assets/img/avatar.png';
		$default_background = ($options['vc_background']) ? $options['vc_background'] :  VARIABLECTAS_PLUGIN_DIR_URL . 'assets/img/background.png';
		$default_phone      = ($options['vc_phone']) ? $options['vc_phone'] : '932 828 064';
		$default_color      = ($options['vc_color']) ? $options['vc_color'] : '#942092';

		$a = shortcode_atts(array(
			'version'    => $default_version,
			'avatar'     => $default_avatar,
			'background' => $default_background,
			'phone'      => $default_phone,
			'color'      => $default_color
		), $atts);


		if ($a['version'] == 1 && empty($options['vc_background'])) {
			$a['background'] = VARIABLECTAS_PLUGIN_DIR_URL . 'assets/img/background-1.png';
		}

		ob_start();

		echo 'Versión: '. $a['version'] . '<br>';
		echo 'Avatar: ' . $a['avatar'] . '<br>';
		echo 'Background: ' . $a['background'] . '<br>';
		echo 'Phone: ' . $a['phone'] . '<br>';
		echo 'Color: ' . $a['color'] . '<br>';

		echo '<section class="variable-cta">';

			include (VARIABLECTAS_PLUGIN_DIR_PATH.'templates/cta-version-'.$a['version'].'.php');

			echo '<style>
				.variable-cta * {
					font-family: "Helvetica Neue";
				}
				#version-' . $a['version'] . ' .pure-text-accent-color {
					color: ' . $a['color'] . ';
				}

				#version-' . $a['version'] . ' .pure-button.pure-button--secondary,
				#version-' . $a['version'] . ' .pure-button.pure-button--selected {
					background-color: ' . $a['color'] . ';
				}
			</style>';
		echo '</section>';

		echo '<hr>';

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
		wp_enqueue_style('vc-font', "https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap", array(), VARIABLECTAS_VERSION);
		wp_enqueue_style('vc-pure', VARIABLECTAS_PLUGIN_DIR_URL . "assets/css/pure.min.css", array(), VARIABLECTAS_VERSION);
		wp_enqueue_style('vc-pure-grids', VARIABLECTAS_PLUGIN_DIR_URL . "assets/css/grids-responsive.min.css", array('vc-pure'), VARIABLECTAS_VERSION);
		wp_enqueue_style('vc-shortcode', VARIABLECTAS_PLUGIN_DIR_URL . "assets/css/shortcode.css", array(), VARIABLECTAS_VERSION);

	}

	/**
	 * Add DataLayer script to head
	 *
	 * @return void
	 */
	public static function vc_data_layer()
	{
		echo '<script>dataLayer=[];</script>';
	}
}
