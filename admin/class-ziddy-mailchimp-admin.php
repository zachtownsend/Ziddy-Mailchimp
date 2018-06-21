<?php

/**
 * Admin Class
 */
class Ziddy_Mailchimp_Admin {
	/**
	 * Array of available options for the plugin
	 * @var Array
	 */
	protected $options_fields;

	/**
	 * Array of options for the options page
	 * @var Array
	 */
	protected $options_page_settings;

	public function __construct() {
		$this->options_page_settings = [
			'page_title' => __( 'Ziddy Mailchimp Settings', 'ziddy-mailchimp' ),
			'menu_title' => __( 'Ziddy Mailchimp Settings', 'ziddy-mailchimp' ),
			'capability' => 'manage_options',
			'slug'       => ZIDDY_MAILCHIMP_SLUG . '-settings',
			'callback'   => [ $this, 'display_options_page' ],
		];

		$this->options_fields = [
			'general' => [
				'title' => 'General Settings',
				'fields' => [
					'api_key' => [
						'title' => 'Mailchimp API Key',
						'field' => 'input',
						'type' => 'text',
					],
					'list_id' => [
						'title' => 'Mailchimp List ID',
						'field' => 'input',
						'type' => 'text',
					],
				],
			],
		];
	}

	/**
	 * Initialise the admin hooks for the plugin
	 *
	 * @since   0.1.0
	 */
	public function init() {
		add_action( 'admin_menu', [ $this, 'add_options_page' ] );
		add_action( 'admin_init', [ $this, 'register_settings' ] );
	}

	/**
	 * Adds the option page
	 *
	 * @since   0.1.0
	 */
	public function add_options_page() {
		extract( $this->options_page_settings );

		add_options_page( $page_title, $menu_title, $capability, $slug, $callback );
	}

	/**
	 * Registers the plugin settings
	 *
	 * @since   0.1.0
	 */
	public function register_settings() {
		foreach ( $this->options_fields as $section_key => $section_data ) {
			$section_name = ZIDDY_MAILCHIMP_SLUG . "-$section_key";

			add_settings_section(
				$section_name,
				$section_data['title'],
				[ $this, 'settings_section_cb' ],
				ZIDDY_MAILCHIMP_SLUG
			);

			foreach ( $section_data['fields'] as $field_key => $field_data ) {
				$option_key = ZIDDY_MAILCHIMP_SLUG . "_$field_key";

				register_setting( ZIDDY_MAILCHIMP_SLUG, $option_key );

				add_settings_field(
					$option_key,
					$field_data['title'],
					[ $this, 'load_field_template' ],
					ZIDDY_MAILCHIMP_SLUG,
					$section_name,
					array_merge(
						array(
							'label_for'     => $option_key,
							'class'         => $option_key,
							'template_file' => "$section_key-$field_key.php",
						),
						$field_data
					)
				);
			}
		}
	}

	/**
	 * Load the field template from either the plugin or the theme override
	 *
	 * @param  Array $args Arguments sent from `add_settings_field` function
	 *
	 * @since  0.1.0
	 */
	public function load_field_template( $args ) {
		$template_file = 'partials/fields/' . $args['template_file'];

		if ( file_exists( plugin_dir_path( __FILE__ ) . $template_file ) ) {
			require_once $template_file;
		} else {
			require "partials/fields/templates/${args['field']}.php";
		}
	}

	/**
	 * Display options page template
	 *
	 * @since   0.1.0
	 */
	public function display_options_page() {
		include_once 'partials/admin-display.php';
	}
}
