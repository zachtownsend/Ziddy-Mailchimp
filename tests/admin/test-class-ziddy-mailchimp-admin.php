<?php


class Ziddy_Mailchimp_Admin_Test extends WP_UnitTestCase {
	protected $admin;
	protected $options_fields;

	public function setUp() {
		$this->admin = new Ziddy_Mailchimp_Admin();

		$this->admin->init();
	}
}
