<?php
/**
 * Testominal.
 *
 * @package educa
 * @author JRB Themes
 * @link http://jrbthemes.com
 */
function educatito_testimonial_post_type() {

    $testimonial_item_slug = 'testimonial';

    $labels = array(
        'name' => esc_html__('Testimonials', 'educatito'),
        'singular_name' => esc_html__('Testimonials', 'educatito'),
        'all_items' => __('All Testimonials', 'educatito'),
        'add_new' => esc_html__('Add New', 'educatito'),
        'add_new_item' => esc_html__('Add New Testimonial', 'educatito'),
        'edit_item' => esc_html__('Edit Testimonial', 'educatito'),
        'new_item' => esc_html__('New Testimonial', 'educatito'),
        'view_item' => esc_html__('View Testimonials', 'educatito'),
        'search_items' => esc_html__('Search Testimonials', 'educatito'),
        'not_found' => esc_html__('No testimonials found', 'educatito'),
        'not_found_in_trash' => esc_html__('No testimonials found in Trash', 'educatito'),
        'parent_item_colon' => ''
    );

    $args = array(
        'labels' => $labels,
        'menu_icon' => EDUCATITO_PLUGIN_URL . "/images/Testimonials.png",
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => null,
        'rewrite' => array('slug' => $testimonial_item_slug, 'with_front' => true),
        'supports' => array('title', 'editor', 'thumbnail'),
    );

    educatito_custom_reg_post_type('testimonial', $args);

    educatito_custom_reg_taxonomy('testimonial-types', 'testimonial', array(
        'hierarchical' => true,
        'label' => esc_html__('Testimonial categories', 'educatito'),
        'singular_label' => esc_html__('Testimonial category', 'educatito'),
        'rewrite' => true,
        'query_var' => true
    ));
}

add_action('init', 'educatito_testimonial_post_type', 7);


/* ---------------------------------------------------------------------------
 * Edit columns
 * --------------------------------------------------------------------------- */

function educatito_testimonial_edit_columns($columns) {
    $newcolumns = array(
        "cb" => "<input type='checkbox' />",
        "testimonial_thumbnail" => esc_html__('Photo', 'educatito'),
        "title" => esc_html__('Title', 'educatito'),
        //"testimonial_types" => esc_html__('Categories','educatito'),
        "testimonial_position" => esc_html__('Position', 'educatito'),
    );
    $columns = array_merge($newcolumns, $columns);

    return $columns;
}

add_filter("manage_edit-testimonial_columns", "educatito_testimonial_edit_columns");


/* ---------------------------------------------------------------------------
 * Custom columns
 * --------------------------------------------------------------------------- */

function educatito_testimonial_custom_columns($column) {
    global $post;
    switch ($column) {
        case "testimonial_thumbnail":
            if (has_post_thumbnail()) {
                the_post_thumbnail(array(50, 50));
            }
            break;
        case "testimonial_position":
            echo esc_attr(get_post_meta($post->ID, 'position', true));
            break;
    }
}

add_action("manage_posts_custom_column", "educatito_testimonial_custom_columns");


/* Add Meta */
// Metaboxes
if (!function_exists('educatito_testimonial_metaboxes')) {

    function educatito_testimonial_metaboxes() {
        add_meta_box('educatito_position', 'Position', 'educatito_position_output', 'testimonial');
    }

}
add_action('add_meta_boxes', 'educatito_testimonial_metaboxes');

if (!function_exists('educatito_position_output')) {

    function educatito_position_output() {
        global $post;
        $position = get_post_meta($post->ID, 'position', true);
        ?>
        <div class="position">
            <input style="width: 100%" type="text" id="position" name="position" value="<?php echo esc_attr($position); ?>" />
        </div>
        <?php
    }

}

// Save meta values
if (!function_exists('educatito_save_testimonial_metaboxes')) {

    function educatito_save_testimonial_metaboxes($post_id) {

        if (isset($_POST['position'])) {
            update_post_meta($post_id, 'position', $_POST['position']);
        }
    }

}
add_action('save_post', 'educatito_save_testimonial_metaboxes');
