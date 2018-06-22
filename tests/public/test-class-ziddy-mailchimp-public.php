<?php

class Ziddy_Mailchimp_Public_Test extends WP_UnitTestCase {
	protected $public;

	protected $test_email_addresses;

	public function setUp() {
		require_once ZIDDY_MAILCHIMP_PLUGIN_ROOT . 'vendor/autoload.php';
		require_once ZIDDY_MAILCHIMP_PLUGIN_ROOT . 'public/class-ziddy-mailchimp-public.php';

		update_option( ZIDDY_MAILCHIMP_SLUG . '_api_key', getenv('API_KEY') );
		update_option( ZIDDY_MAILCHIMP_SLUG . '_list_id', getenv('LIST_ID') );
		$this->public = new Ziddy_Mailchimp_Public();

		$this->test_email_addresses = [
			'jaffe@msn.com',
			'stefano@verizon.net',
			'natepuri@mac.com',
			'bockelboy@outlook.com',
		];
	}

	public function test_settings_are_correct () {
		$this->assertEquals( $this->public->api_key, getenv('API_KEY') );
		$this->assertEquals( $this->public->list_id, getenv('LIST_ID') );
	}

	// public function test_that_getting_correct_lists () {
	// 	$expected = array(
	// 		'lists' => [
	// 			'5d8a5e310f'
	// 		],
	// 		'total_items' => 2,

	// 	);
	// 	$this->assertEquals( $this->public->get_lists(), ['5d8a5e310f'] );
	// }

	public function test_add_subscribers() {
		/**
		 * Add the test emails
		 */
		foreach ( $this->test_email_addresses as $email ) {
			$added = $this->public->add_user_to_list( $email );
			$this->assertEquals( $added['email_address'], $email );
		}

	}

	public function test_handle_already_subscribed () {
		$result = $this->public->add_user_to_list( $this->test_email_addresses[0] );
		$this->assertEquals( $result->get_error_message(), 'Member Exists - jaffe@msn.com is already a list member. Use PUT to insert or update list members.' );
	}

	// public function test_delete_subscribes() {
	// 	$MailChimp = $this->public->MailChimp;
	// 	$list_id = $this->public->list_id;

	// 	foreach ( $this->test_email_addresses as $email ) {
	// 		$subscriber_hash = $this->public->MailChimp->subscriberHash( $email );

	// 		var_dump( "lists/$list_id/members/$subscriber_hash", $MailChimp->delete( "lists/$list_id/members/$subscriber_hash" ) );
	// 	}
	// }

	public static function tearDownAfterClass() {
		$public = new Ziddy_Mailchimp_Public();
		$list_id = get_option( ZIDDY_MAILCHIMP_SLUG . '_api_key' );
		$test_email_addresses = [
			'jaffe@msn.com',
			'stefano@verizon.net',
			'natepuri@mac.com',
			'bockelboy@outlook.com',
		];

		foreach ( $test_email_addresses as $email ) {
			$subscriber_hash = $public->MailChimp->subscriberHash( $email );
			$public->MailChimp->delete("lists/$list_id/members/$subscriber_hash");
		}
	}
}
