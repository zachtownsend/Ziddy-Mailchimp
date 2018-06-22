<?php

class Ziddy_Mailchimp_Public_Test extends WP_UnitTestCase {
	protected $public;

	protected $test_email_addresses = [
		'jaffe@msn.com',
		'stefano@verizon.net',
		'natepuri@mac.com',
		'bockelboy@outlook.com',
	];

	protected $test_email = 'test@test.com';

	public function setUp() {
		require_once ZIDDY_MAILCHIMP_PLUGIN_ROOT . 'public/class-ziddy-mailchimp-public.php';

		update_option( ZIDDY_MAILCHIMP_SLUG . '_api_key', getenv('API_KEY') );
		update_option( ZIDDY_MAILCHIMP_SLUG . '_list_id', getenv('LIST_ID') );
		$this->public = new Ziddy_Mailchimp_Public();
	}

	public function test_settings_are_correct () {
		$this->assertEquals( $this->public->api_key, getenv('API_KEY') );
		$this->assertEquals( $this->public->list_id, getenv('LIST_ID') );
	}

	public function test_add_subscribers() {
		/**
		 * Add the test email
		 */
		$result = $this->public->add_user_to_list( 'joebloggs@jodo.com' );

		if ( is_array( $result ) ) {
			$this->assertArrayHasKey( 'email_address', $result );
			$this->assertEquals( $result['email_address'], 'joebloggs@jodo.com' );
		} else {
			$this->assertInstanceOf( WP_Error::class, $result );
		}
	}

	public function test_handle_already_subscribed () {
		$result = $this->public->add_user_to_list( 'joebloggs@jodo.com' );
		$this->assertInstanceOf( WP_Error::class, $result );
	}

	public function test_fake_email () {
		$result = $this->public->add_user_to_list( 'test@test.com' );
		$this->assertInstanceOf( WP_Error::class, $result );
	}

	public function test_delete_subscriber() {
		$added = $this->public->add_user_to_list( 'joebloggs@jodo.com' );

		if ( is_array( $added ) ) {
			$result = $this->public->delete_user_from_list( 'joebloggs@jodo.com' );
			$this->assertTrue( $result );
		} else {
			$this->assertInstanceOf( WP_Error::class, $added );
		}
	}

	public function test_delete_subscriber_error () {
		$result = $this->public->delete_user_from_list( 'joebloggs@jodo.com' );

		$this->assertInstanceOf( WP_Error::class, $result );
	}

	public static function tearDownAfterClass() {
		$public = new Ziddy_Mailchimp_Public();
		$list_id = getenv('LIST_ID');

		$subscriber_hash = $public->MailChimp->subscriberHash( 'joebloggs@jodo.com' );
		$public->MailChimp->delete("lists/$list_id/members/$subscriber_hash");
	}
}
