<?php
	$input_type   = $args['type'] ?: 'text';
	$option_name  = $args['label_for'];
	$option_value = get_option( $option_name );
?>
<input
	type="<?php echo esc_attr( $input_type ); ?>"
	name="<?php echo esc_attr( $option_name ); ?>"
	id="<?php echo esc_attr( $option_name ); ?>"
	value="<?php echo esc_attr( $option_value ); ?>"
>

<?php if ( $args['description'] ) : ?>
	<p class="description"><?php echo esc_html( $args['description'] ); ?></p>
<?php endif ?>
