<?php
/**
 * @author  JRB Themes
 * @package LearnPress/Templates
 * @version 3.0.0
 */

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( !is_user_logged_in() ) {
	return;
}

global $user_identity;
?>

<div class="message message-notice">
	<?php
        /* translators: %s: Logged in */
	printf(
		wp_kses_post( 'Logged in as <a href="%1$s">%2$s</a>.', 'educatito' ),
		esc_url(get_edit_user_link()),
		esc_attr($user_identity)
	);
	?>
	<a href="<?php echo esc_url(wp_logout_url( get_permalink()) ); ?>" title="<?php esc_attr_e( 'Log out of this account', 'educatito' ); ?>"><?php esc_html_e( 'Log out &raquo;', 'educatito' ); ?></a>
</div>
