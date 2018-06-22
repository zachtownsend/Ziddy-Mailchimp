<?php

/**
 * Class for handling Ziddy Mailchimp shortcodes
 */
class Ziddy_Mailchimp_Shortcodes {
	public function __construct() {
		add_shortcode( 'ziddy_mailchimp_signup', [$this, 'signup_shortcode'] );
	}

	public function signup_shortcode( $atts ) {
		$a = shortcode_atts([
			'template' => 'ziddy-mailchimp-form.php',
		], $atts );

		ob_start();

		ziddy_get_template( $a['template'] );

		return ob_get_clean();
	}
}
