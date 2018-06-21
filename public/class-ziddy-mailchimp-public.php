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

	public function add_user_to_list( $email_address, $args = [] ) {
		$params = array_merge( [
			'email_address' => $email_address,
			'status' => 'subscribed',
		], $args );

		$result = $this->MailChimp->post("lists/$this->list_id/members", $params);

		if ( ! isset( $result['email_address'] ) ) {
			$error_message = "${result['title']} - ${result['detail']}";
			$error_message = apply_filters( 'ziddy_mailchimp_error_message', $error_message, $result['title'], $result['detail'] );
			$result = new WP_Error( 'member-exists', $error_message );
		}

		return $result;
	}

	public function get_lists() {
		return $this->MailChimp->get('lists');
	}
}
