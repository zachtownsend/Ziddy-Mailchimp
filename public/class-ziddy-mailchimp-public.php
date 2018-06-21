<?php
use \DrewM\MailChimp\MailChimp;

/**
 * Ziddy Mailchimp Public Class
 */
class Ziddy_Mailchimp_Public {
	public $api_key;

	public $list_id;

	public $MailChimp;

	public function __construct() {
		$this->api_key = get_option( ZIDDY_MAILCHIMP_SLUG . '_api_key' );

		$this->list_id = get_option( ZIDDY_MAILCHIMP_SLUG . '_list_id' );

		$this->MailChimp = new Mailchimp( $this->api_key );
	}

	public function add_user_to_list() {
		$result = $this->MailChimp->post("lists/$this->list_id/members", [
			'email_address' => 'zach@zachtownsend.net',
			'status' => 'subscribed'
		]);

		return $result;
	}

	public function get_lists() {
		return $this->MailChimp->get('lists');
	}
}
