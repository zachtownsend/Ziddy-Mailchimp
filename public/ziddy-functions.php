<?php

if ( ! function_exists( 'ziddy_get_template_path' ) ) {
	function ziddy_get_template_path( $path ) {
		$override_template = get_template_directory() . "/ziddy-mailchimp/$path";

		if ( file_exists( $override_template ) ) {
			return $override_template;
		}

		$default_template = plugin_dir_path( __FILE__ ) . "templates/$path";

		if ( ! file_exists( $default_template ) ) {
			$error_message = "The template you have attempted to load ($path) does not exist";
			$error_message = apply_filters( 'ziddy_template_path_error', $error_message, $path );
			return new WP_Error( 'no-template-exists', $error_message );
		}

		return $default_template;
	}
}

if ( ! function_exists( 'ziddy_get_template' ) ) {
	function ziddy_get_template( $path ) {
		$template_path = ziddy_get_template_path( $path );

		if ( $template_path instanceof WP_Error ) {
			return $template_path->get_error_message();
		}

		if ( file_exists( $template_path ) ) {
			require $template_path;
		}
	}
}
