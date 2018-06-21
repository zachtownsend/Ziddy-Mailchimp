<?php

class Ziddy_Mailchimp {
	protected $admin;

	protected $public;

	public function __construct() {
		$this->load_dependencies();

		$this->admin = new Ziddy_Mailchimp_Admin();
	}

	public function run() {
		$this->admin->init();
	}

	private function load_dependencies() {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-ziddy-mailchimp-admin.php';
	}
}
