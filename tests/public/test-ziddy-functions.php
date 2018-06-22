<?php

/**
 * Test Ziddy Functions
 */
class Ziddy_Functions_Test extends WP_UnitTestCase {
	public static function setUpBeforeClass() {
		require_once ZIDDY_MAILCHIMP_PLUGIN_ROOT . 'public/ziddy-functions.php';

		switch_theme( 'twentyseventeen' );
	}

	public function test_get_default_template_path() {
		$asserted = ziddy_get_template_path( 'ziddy-mailchimp-form.php' );
		$expected = ZIDDY_MAILCHIMP_PLUGIN_ROOT . 'public/templates/ziddy-mailchimp-form.php';
		$this->assertEquals( $expected, $asserted );
		$this->assertFileExists( $asserted );
	}

	public function test_get_template_override() {
		$override_path = '/tmp/wordpress/wp-content/themes/twentyseventeen/ziddy-mailchimp';

		if ( ! is_dir( $override_path ) ) {
			mkdir( $override_path, 0755, true );
		}

		$override_file = fopen( $override_path . '/ziddy-mailchimp-form.php', 'w' );

		ob_start();
		require_once 'templates/ziddy-mailchimp-form-theme-override.php';
		fwrite( $override_file, ob_get_clean() );
		fclose( $override_file );

		$asserted = ziddy_get_template_path( 'ziddy-mailchimp-form.php' );
		$expected = $override_path . '/ziddy-mailchimp-form.php';
		$this->assertEquals( $expected, $asserted );
		$this->assertFileExists( $asserted );

		if ( file_exists( $expected ) ) {
			unlink( $expected );
		}
	}

	public function test_handle_bad_template_path_error () {
		$asserted = ziddy_get_template_path( 'bad-template.php' );

		$this->assertInstanceOf( WP_Error::class, $asserted );
		$this->assertEquals( $asserted->get_error_message(), 'The template you have attempted to load (bad-template.php) does not exist' );
	}
}
