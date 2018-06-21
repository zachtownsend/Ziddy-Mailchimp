<?php
	$option_name  = $args['label_for'];
	$option_value = get_option( $option_name );
?>
<select
	name="<?php echo esc_attr( $option_name ); ?>"
	id="<?php echo esc_attr( $option_name ); ?>"
	value="<?php echo esc_attr( $option_value ); ?>"
>
	<option value="0">Automatic</option>
	<?php foreach ( get_pages() as $page ) : ?>
		<?php $value = get_permalink( $page->ID ); ?>
		<option value="<?php echo esc_attr( $value ); ?>" <?php selected( $option_value, $value ); ?>><?php echo esc_html( $page->post_title ); ?></option>
	<?php endforeach ?>
</select>
