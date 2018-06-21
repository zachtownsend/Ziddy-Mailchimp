<?php
	$option_name      = $args['label_for'];
	$option_value     = get_option( $option_name );
	$checkbox_options = $args['options'];
?>

<?php foreach ( $args['options'] as $label => $option ) : ?>
	<?php if ( ! is_integer( $label ) ) : ?>
		<label for="<?php echo esc_attr( $option_name ); ?>[<?php echo esc_attr( $option ); ?>"><?php echo esc_html( $label ); ?></label>
	<?php endif ?>

	<input
		type="checkbox"
		name="<?php echo esc_attr( $option_name ); ?>[<?php echo esc_attr( $option ); ?>]"
		value="1"
		id="<?php echo esc_attr( $option_name ); ?>"
		<?php checked( '1', isset( $option_value[ $option ] ) ); ?>
	>
<?php endforeach ?>

<?php if ( $args['description'] ) : ?>
	<p class="description"><?php echo esc_html( $args['description'] ); ?></p>
<?php endif ?>
