<?php
/**
 * Review order table
 *
 * @author        JRB Themes
 * @package       LearnPress/Templates
 * @version       3.0.0
 */

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

$cart                 = learn_press_get_checkout_cart();

?>

<h3 class="title"><?php esc_html_e( 'Your order', 'educatito' ) ; ?></h3>

<table class="learn-press-checkout-review-order-table">
	<thead>
	<tr>
		<th class="course-name"><?php esc_html_e( 'Course', 'educatito' ); ?></th>
		<th class="course-total"><?php esc_html_e( 'Total', 'educatito' ); ?></th>
	</tr>
	</thead>
	<tbody>

	<?php do_action( 'learn_press_review_order_before_cart_contents' ); ?>

	<?php if ( $items = $cart->get_items() ) foreach ( $items as $item_id => $cart_item ) {
		$cart_item = apply_filters( 'learn_press_cart_item', $cart_item );
		$_course   = learn_press_get_course( $item_id );
		if ( $_course && $cart_item['quantity'] > 0 ) {
			?>
			<tr class="<?php echo esc_attr( apply_filters( 'learn_press_cart_item_class', 'cart-item', $cart_item ) ); ?>">
				<td class="course-name">
					<?php echo wp_kses_post(apply_filters( 'learn_press_cart_item_name', $_course->get_title(), $cart_item )) . '&nbsp;'; ?>
					<?php echo wp_kses_post(apply_filters( 'learn_press_cart_item_quantity', ' <strong class="course-quantity">' . sprintf( '&times; %s', $cart_item['quantity'] ) . '</strong>', $cart_item )); ?>
				</td>
				<td class="course-total">
					<?php echo wp_kses_post(apply_filters( 'learn_press_cart_item_subtotal', $cart->get_item_subtotal( $_course, $cart_item['quantity'] ), $cart_item )); ?>
				</td>
			</tr>
			<?php
		}
	} ?>

	<?php do_action( 'learn_press_review_order_after_cart_contents' ); ?>

	</tbody>

	<tfoot>

	<tr class="cart-subtotal">
		<th><?php esc_html_e( 'Subtotal', 'educatito' ); ?></th>
		<td><?php echo wp_kses_post($cart->get_subtotal()); ?></td>
	</tr>

	<?php do_action( 'learn_press_review_order_before_order_total' ); ?>

	<tr class="order-total">
		<th><?php esc_html_e( 'Total', 'educatito' ); ?></th>
		<td><?php echo wp_kses_post($cart->get_total()); ?></td>
	</tr>

	<?php do_action( 'learn_press_review_order_after_order_total' ); ?>

	</tfoot>

</table>
