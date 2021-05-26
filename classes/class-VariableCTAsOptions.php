<?php

/**
 * Class VariableCTAsOptions
 *
 * Handles the creation of a "VariableCTAs" options page
 *
 * @subpackage WordPress
 * @package Variable_Ctas
 */
class VariableCTAsOptions
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
			self::$instance = new VariableCTAsOptions();
		}

		return self::$instance;
	}

	/**
	 * Initializes the plugin by setting filters and administration functions.
	 */
	private function __construct()
	{
		add_action('admin_menu', array($this, 'vc_add_plugin_page'));
		add_action('admin_init', array($this, 'vc_page_init'));
		add_action('admin_enqueue_scripts', array($this, 'vc_media_uploader_enqueue'));
	}

	/**
	 * Register post type Variable CTAs
	 *
	 * @return void
	 */
	public function vc_add_plugin_page()
	{
		add_menu_page(
			__('Variable CTAs Options', VARIABLECTAS_TEXT_DOMAIN ), // page_title
			__('Variable CTAs Options', VARIABLECTAS_TEXT_DOMAIN ), // menu_title
			'manage_options', // capability
			'mv-options', // menu_slug
			array($this, 'vc_create_admin_page'), // function
			'dashicons-carrot', // icon_url
			5 // position
		);
	}

	public function vc_create_admin_page()
	{
		$this->vc_options = get_option('vc_general_options'); ?>

		<div class="wrap">
			<h2><?php _e('Variable CTAs Options', VARIABLECTAS_TEXT_DOMAIN); ?></h2>
			<p><?php _e('Setup defaults values to the Call To Actions', VARIABLECTAS_TEXT_DOMAIN); ?></p>
			<?php settings_errors(); ?>

			<form method="post" action="options.php">
				<?php
				settings_fields('vc_general_option_group');
				do_settings_sections('vc-general-options-admin');
				submit_button();
				?>
			</form>
		</div><?php
	}

	public function vc_page_init()
	{
		register_setting(
			'vc_general_option_group', // option_group
			'vc_general_options', // option_name
			array($this, 'vc_sanitize') // sanitize_callback
		);

		add_settings_section(
			'vc_header_setting_section', // id
			__('<hr>General settings', VARIABLECTAS_TEXT_DOMAIN), // title
			array($this, 'vc_header_section_info'), // callback
			'vc-general-options-admin' // page
		);

		add_settings_field(
			'vc_version', // id
			__('Default Version', VARIABLECTAS_TEXT_DOMAIN), // title
			array($this, 'vc_version_callback'), // callback
			'vc-general-options-admin', // page
			'vc_header_setting_section' // section
		);

		add_settings_field(
			'vc_avatar', // id
			__('Default Avatar', VARIABLECTAS_TEXT_DOMAIN), // title
			array($this, 'vc_avatar_callback'), // callback
			'vc-general-options-admin', // page
			'vc_header_setting_section' // section
		);

		add_settings_field(
			'vc_background', // id
			__('Default Background', VARIABLECTAS_TEXT_DOMAIN), // title
			array($this, 'vc_background_callback'), // callback
			'vc-general-options-admin', // page
			'vc_header_setting_section' // section
		);

		add_settings_field(
			'vc_phone', // id
			__('Default phone number', VARIABLECTAS_TEXT_DOMAIN), // title
			array($this, 'vc_phone_callback'), // callback
			'vc-general-options-admin', // page
			'vc_header_setting_section' // section
		);

		add_settings_field(
			'vc_color', // id
			__('Default color', VARIABLECTAS_TEXT_DOMAIN), // title
			array($this, 'vc_color_callback'), // callback
			'vc-general-options-admin', // page
			'vc_header_setting_section' // section
		);

		add_settings_section(
			'vc_shortcode_setting_section', // id
			__('<hr>Shortcodes documentation', VARIABLECTAS_TEXT_DOMAIN), // title
			array($this, 'vc_shortcode_section_info'), // callback
			'vc-general-options-admin' // page
		);
	}

	public function vc_sanitize($input)
	{
		$sanitary_values = array();
		if (isset($input['vc_version'])) {
			$sanitary_values['vc_version'] = sanitize_text_field($input['vc_version']);
		}
		if (isset($input['vc_avatar'])) {
			$sanitary_values['vc_avatar'] = sanitize_text_field($input['vc_avatar']);
		}
		if (isset($input['vc_background'])) {
			$sanitary_values['vc_background'] = sanitize_text_field($input['vc_background']);
		}
		if (isset($input['vc_phone'])) {
			$sanitary_values['vc_phone'] = sanitize_text_field($input['vc_phone']);
		}
		if (isset($input['vc_color'])) {
			$sanitary_values['vc_color'] = sanitize_text_field($input['vc_color']);
		}

		return $sanitary_values;
	}

	public function vc_header_section_info()
	{
		_e('Setup the general options', VARIABLECTAS_TEXT_DOMAIN);
	}

	public function vc_version_callback()
	{
		printf(
			'<input class="regular-number" type="number" name="vc_general_options[vc_version]" id="vc_version" min="1" max="6" step="1" value="%s">',
			isset($this->vc_options['vc_version']) ? esc_attr($this->vc_options['vc_version']) : ''
		);
	}

	public function vc_avatar_callback()
	{
		printf(
			'<input type="text" name="vc_general_options[vc_avatar]" id="vc_avatar" value="%s" />',
			isset($this->vc_options['vc_avatar']) ? esc_attr($this->vc_options['vc_avatar']) : ''
		);
		printf(
			'<input id="upload_avatar_button" type="button" class="upload_image_button button-primary" value="%s" />',
			__('Insert image avatar', VARIABLECTAS_TEXT_DOMAIN)
		);
		echo '<div class="thumbnail-preview-vc_avatar" style="background-size: contain;width: 250px;margin: 15px 0;"></div>';
		if (isset($this->vc_options['vc_avatar'])) {
			$image_id      = attachment_url_to_postid($this->vc_options['vc_avatar']);
			$thumbnail_url = wp_get_attachment_image_src($image_id, 'medium');
			echo '<div class="wrap"><img src="' . $thumbnail_url[0] . '"></div>';
		}
	}

	public function vc_background_callback()
	{
		printf(
			'<input type="text" name="vc_general_options[vc_background]" id="vc_background" value="%s" />',
			isset($this->vc_options['vc_background']) ? esc_attr($this->vc_options['vc_background']) : ''
		);
		printf(
			'<input id="upload_background_button" type="button" class="upload_image_button button-primary" value="%s" />',
			__('Insert image background', VARIABLECTAS_TEXT_DOMAIN)
		);
		echo '<div class="thumbnail-preview-vc_background" style="background-size: contain;width: 250px;margin: 15px 0;"></div>';
		if (isset($this->vc_options['vc_background'])) {
			$image_id      = attachment_url_to_postid($this->vc_options['vc_background']);
			$thumbnail_url = wp_get_attachment_image_src($image_id, 'medium');
			echo '<div class="wrap"><img src="' . $thumbnail_url[0] . '"></div>';
		}
	}

	public function vc_phone_callback()
	{
		printf(
			'<input class="regular-text" type="text" name="vc_general_options[vc_phone]" id="vc_phone" value="%s">',
			isset($this->vc_options['vc_phone']) ? esc_attr($this->vc_options['vc_phone']) : ''
		);
	}

	public function vc_color_callback()
	{
		printf(
			'<input class="color-field" type="text" name="vc_general_options[vc_color]" id="vc_color" value="%s">',
			isset($this->vc_options['vc_color']) ? esc_attr($this->vc_options['vc_color']) : ''
		);
	}

	/**
	 * Documentation setion
	 *
	 * @return void
	 */
	public function vc_shortcode_section_info()
	{
		_e('The shortcode acepts five parameters:', VARIABLECTAS_TEXT_DOMAIN);
		echo '<ol>';
		printf(
			'<li><b>version</b>: %s</li>',
			__('This value handle the version of CTA to show it. Values between 1 to 6. Default in options or 1', VARIABLECTAS_TEXT_DOMAIN)
		);
		printf(
			'<li><b>avatar</b>: %s</li>',
			__('This value is the picture to show. Default in options or none', VARIABLECTAS_TEXT_DOMAIN)
		);
		printf(
			'<li><b>background</b>: %s</li>',
			__('This value is the picture to show like background <b>in all version except version-1</b>. Default in options or none', VARIABLECTAS_TEXT_DOMAIN)
		);
		printf(
			'<li><b>phone</b>: %s</li>',
			__('This value is the phone number to show and ofuscated link. Default in options or 932 828 064', VARIABLECTAS_TEXT_DOMAIN)
		);
		printf(
			'<li><b>color</b>: %s</li>',
			__('This\'s a valid CSS color value to handle colors details. Default in options or #942192', VARIABLECTAS_TEXT_DOMAIN)
		);
		echo '</ol>';
		echo '<p>' . __("The use is pretty simple. You only have to put <b>[variable_cta version='2' avatar='https://domain.es/image.png' background='https://domain.es/image.png' phone='555636363' color='#942192']</b> where you want to show the CTA.", VARIABLECTAS_TEXT_DOMAIN). '</p>';
		echo '<p>' . __("If you only want to show default values you have to put <b>[variable_cta]</b> where you want to show the CTA.", VARIABLECTAS_TEXT_DOMAIN) . '</p>';
		_e('<b>Note the singles quotes</b>. This is because WordPress change automatically double quotes to angular ones (« ») in spanish language.​', VARIABLECTAS_TEXT_DOMAIN);
	}


	/**
	 * Enqueue scripts in admin
	 *
	 * @return void
	 */
	public function vc_media_uploader_enqueue()
	{
		wp_enqueue_media();
		wp_register_script('vc-media-uploader', VARIABLECTAS_PLUGIN_DIR_URL . 'assets/js/media-uploader.js', array('jquery'), '21');
		wp_enqueue_script('vc-media-uploader');
		wp_enqueue_style('wp-color-picker');
		wp_enqueue_script('wp-color-picker');
	}
}
