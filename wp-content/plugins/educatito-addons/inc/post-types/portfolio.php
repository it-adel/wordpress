<?php
/**
 * Portfolio.
 *
 * @package educa
 * @author JRB Themes
 * @link http://jrbthemes.com
 */

function educatito_portfolio_post_type() {

    $portfolio_item_slug = 'portfolio';

    $labels = array(
        'name' => esc_html__('Portfolios', 'educatito'),
        'singular_name' => esc_html__('Portfolios', 'educatito'),
        'all_items' => __('All Portfolios', 'educatito'),
        'add_new' => esc_html__('Add New', 'educatito'),
        'add_new_item' => esc_html__('Add New Portfolio', 'educatito'),
        'edit_item' => esc_html__('Edit Portfolio', 'educatito'),
        'new_item' => esc_html__('New Portfolio', 'educatito'),
        'view_item' => esc_html__('View Portfolio', 'educatito'),
        'search_items' => esc_html__('Search Portfolio', 'educatito'),
        'not_found' => esc_html__('No portfolios found', 'educatito'),
        'not_found_in_trash' => esc_html__('No portfolios found in Trash', 'educatito'),
        'parent_item_colon' => ''
    );

    $args = array(
        'labels' => $labels,
        'menu_icon' => EDUCATITO_PLUGIN_URL . "/images/portfolios.png",
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => null,
        'rewrite' => array('slug' => $portfolio_item_slug, 'with_front' => true),
        'supports' => array('title', 'editor', 'thumbnail','excerpt'),
        'has_archive' => true,
    );

    educatito_custom_reg_post_type('portfolio', $args);

    educatito_custom_reg_taxonomy('portfolio-types', 'portfolio', array(
        'hierarchical' => true,
        'label' => esc_html__('Portfolio categories', 'educatito'),
        'singular_label' => esc_html__('Portfolio category', 'educatito'),
        'rewrite' => true,
        'query_var' => true
    ));
}

add_action('init', 'educatito_portfolio_post_type', 7);


/* ---------------------------------------------------------------------------
 * Edit columns
 * --------------------------------------------------------------------------- */

function educatito_portfolio_edit_columns($columns) {
    $newcolumns = array(
        "cb" => "<input type='checkbox' />",
        "title" => esc_html__('Title', 'educatito'),
        "portfolio_types" => esc_html__('Categories', 'educatito'),
    );
    $columns = array_merge($newcolumns, $columns);

    return $columns;
}

add_filter("manage_edit-portfolio_columns", "educatito_portfolio_edit_columns");


function educatito_portfolio_custom_columns($column) {
    global $post;
    switch ($column) {
        case "portfolio_types":
            echo get_the_term_list($post->ID, 'portfolio-types', '', ', ', '');
            break;
    }
}

add_action("manage_posts_custom_column", "educatito_portfolio_custom_columns");
