<?php
/**
 * Product quantity inputs
 *
 * @author 		JRB Themes
 * @package 	WooCommerce/Templates
 * @version     3.4.0
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>
<div class="quantity">
    <div class="up-down padding-left">
        <span class="qty-minus down">-</span>
        <input type="number" step="<?php echo esc_attr($step); ?>" <?php if (is_numeric($min_value)) : ?>min="<?php echo esc_attr($min_value); ?>"<?php endif; ?> <?php if (is_numeric($max_value)) : ?>max="<?php echo esc_attr($max_value); ?>"<?php endif; ?> name="<?php echo esc_attr($input_name); ?>" value="<?php echo esc_attr($input_value); ?>" title="<?php echo esc_attr__('Qty','educatito') ?>" class="input-text qty text" size="4" />
        <span class="qty-plus up">+</span>
    </div>
</div>
