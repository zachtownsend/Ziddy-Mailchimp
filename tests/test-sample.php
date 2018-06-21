<?php
/**
 * Class SampleTest
 *
 * @package Ziddy_Mailchimp
 */

/**
 * Sample test case.
 */
class SampleTest extends WP_UnitTestCase {

	/**
	 * A single example test.
	 */
	function test_sample() {
		// Replace this with some actual testing code.
		$this->assertTrue( true );

		$this->assertEquals( ZIDDY_MAILCHIMP_SLUG, 'ziddy-mailchimp' );

		$this->assertEquals( ZIDDY_MAILCHIMP_VERSION, '0.1.0' );
	}
}
