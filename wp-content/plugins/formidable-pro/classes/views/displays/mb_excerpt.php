<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( 'You are not allowed to call this page directly.' );
}
?>
<textarea id="excerpt" name="excerpt" class="frm_98_width"><?php echo FrmAppHelper::esc_textarea( $post->post_excerpt ) ?></textarea>
<p class="howto"><?php esc_html_e( 'This is not displayed anywhere, but is just for your reference. (optional)', 'formidable-pro' ); ?></p>
