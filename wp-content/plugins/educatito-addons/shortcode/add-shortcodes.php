<?php

/**
 * Theme shortcodes.
 *
 * @package Educatito
 * @author JRB Themes
 * @link http://educa.jrbthemes.com
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

$educatito_options = get_option('educatito_options');

if (in_array('js_composer/js_composer.php', apply_filters('active_plugins', get_option('active_plugins')))) :

    if (isset($educatito_options['jrb_enable_testimonial']) && $educatito_options['jrb_enable_testimonial'] == 1) {
        $shortcodes = apply_filters('educatito_shortode_theme', array(
            'testimonial',
        ));
        foreach ($shortcodes as $shortcode) {
            educatito_insert_shortcode('educatito_' . $shortcode, 'educatito_' . $shortcode . '_template');
            require $shortcode . '.php';
        }
    }
    if (isset($educatito_options['jrb_enable_team']) && $educatito_options['jrb_enable_team'] == 1) {
        $shortcodes = apply_filters('educatito_shortode_theme', array(
            'our_team',
        ));
        foreach ($shortcodes as $shortcode) {
            educatito_insert_shortcode('educatito_' . $shortcode, 'educatito_' . $shortcode . '_template');
            require $shortcode . '.php';
        }
    }
    if (isset($educatito_options['jrb_enable_portfolio']) && $educatito_options['jrb_enable_portfolio'] == 1) {
        $shortcodes = apply_filters('educatito_shortode_theme', array(
            'portfolio_grid',
        ));
        foreach ($shortcodes as $shortcode) {
            educatito_insert_shortcode('educatito_' . $shortcode, 'educatito_' . $shortcode . '_template');
            require $shortcode . '.php';
        }
    }
    if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) :
        educatito_insert_shortcode('educatito_woo_slider', 'educatito_woo_slider_template');
        require 'woo_product/woo.php';
    endif;
    //Add shortcode educa
    $shortcodes = apply_filters('educatito_shortode_theme', array(
        'our_blog',
        'our_blog_slider',
        'custom_headings',
        'contact_us',
        'video_popup',
        'info_box',
        'social',
        'course_search',
        'our_course',
        'event_slider',
        'educatito_register',
        'list_blog',
        'list_event',
        'box_product'
    ));
    foreach ($shortcodes as $shortcode) {
        educatito_insert_shortcode('educatito_' . $shortcode, 'educatito_' . $shortcode . '_template');
        require $shortcode . '.php';
    }

endif;

if (function_exists('vc_request_param')) {
    if ('vc_get_autocomplete_suggestion' === vc_request_param('action') || 'vc_edit_form' === vc_post_param('action')) {
        // autocomplete taxonomies
        add_filter('vc_autocomplete_educatito_our_course_taxonomies_render', 'vc_autocomplete_taxonomies_field_render', 10, 1);
        add_filter('vc_autocomplete_educatito_our_course_taxonomies_callback', 'vc_autocomplete_taxonomies_field_search', 10, 1);

        add_filter('vc_autocomplete_educatito_woo_products_taxonomies_render', 'vc_autocomplete_taxonomies_field_render', 10, 1);
        add_filter('vc_autocomplete_educatito_woo_products_taxonomies_callback', 'vc_autocomplete_taxonomies_field_search', 10, 1);

        add_filter('vc_autocomplete_educatito_our_categories_tax_render', 'vc_autocomplete_taxonomies_field_render', 10, 1);
        add_filter('vc_autocomplete_educatito_our_categories_tax_callback', 'vc_autocomplete_taxonomies_field_search', 10, 1);
    }
}
