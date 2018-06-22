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

		$result = $this->MailChimp->post( "lists/$this->list_id/members", $params );

		if ( ! $this->MailChimp->success() ) {
			return $this->get_error( $result['title'], $result['detail'], 'member_exists' );
		}

		return $result;
	}

	public function delete_user_from_list( $email_address ) {
		$list_id = $this->list_id;
		$subscriber_hash = $this->MailChimp->subscriberHash( $email_address );

		$response = $this->MailChimp->delete( "lists/$list_id/members/$subscriber_hash" );

		if ( $this->MailChimp->success() ) {
			return true;
		}

		return $this->get_error( $response['title'], $response['detail'], 'no_member_exists' );
	}

	private function get_error( $title, $detail, $error_type = 'error' ) {
		$message = "$title - $detail";
		$message = apply_filters( 'ziddy_mailchimp_' . $error_type . '_message', $message, $title, $detail );
		return new WP_Error( $error_type, $message );
	}
}
