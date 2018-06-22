<?php

class Ziddy_Mailchimp_Shortcodes_Test extends WP_UnitTestCase {
	static function setUpBeforeClass() {
		require_once ZIDDY_MAILCHIMP_PLUGIN_ROOT . 'public/ziddy-functions.php';
		require_once ZIDDY_MAILCHIMP_PLUGIN_ROOT . 'public/class-ziddy-mailchimp-shortcodes.php';

		new Ziddy_Mailchimp_Shortcodes();
	}

	public function test_template_is_loading () {
		ob_start();

		require ZIDDY_MAILCHIMP_PLUGIN_ROOT . 'public/templates/ziddy-mailchimp-form.php';

		$expected = ob_get_clean();

		$asserted = do_shortcode( '[ziddy_mailchimp_signup]' );

		$this->assertEquals( $expected, $asserted );
	}
}
