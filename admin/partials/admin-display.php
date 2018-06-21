<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://verbbrands.com
 * @since      1.0.0
 *
 * @package    Boat_Wizard
 * @subpackage Boat_Wizard/admin/partials
 */

?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">
	<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
	<form action="options.php" id="<?php echo ZIDDY_MAILCHIMP_SLUG; ?>-settings" method="post">
		<?php
			settings_fields( ZIDDY_MAILCHIMP_SLUG );
			do_settings_sections( ZIDDY_MAILCHIMP_SLUG );
		?>
		<div id="<?php echo ZIDDY_MAILCHIMP_SLUG; ?>_errors">

		</div>
		<?php submit_button(); ?>
	</form>
	<?php do_action( 'after_' . ZIDDY_MAILCHIMP_SLUG . '_settings' ); ?>
</div>
