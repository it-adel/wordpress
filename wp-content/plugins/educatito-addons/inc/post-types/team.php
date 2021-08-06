<?php
/**
 * team.
 *
 * @package educa
 * @author JRB Themes
 * @link http://jrbthemes.com
 */
if (!function_exists('educatito_team_post_type')) {

    function educatito_team_post_type() {

        $team_item_slug = 'team';

        $labels = array(
            'name' => __('Teams', 'educatito'),
            'singular_name' => __('Teams', 'educatito'),
            'all_items' => __('All Teams', 'educatito'),
            'add_new' => __('Add New', 'educatito'),
            'add_new_item' => __('Add New Team', 'educatito'),
            'edit_item' => __('Edit Team', 'educatito'),
            'new_item' => __('New Team', 'educatito'),
            'view_item' => __('View Team', 'educatito'),
            'search_items' => __('Search Team', 'educatito'),
            'not_found' => __('No team found', 'educatito'),
            'not_found_in_trash' => __('No team found in Trash', 'educatito'),
            'parent_item_colon' => ''
        );

        $args = array(
            'labels' => $labels,
            'menu_icon' => EDUCATITO_PLUGIN_URL . "/images/Team.png",
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'query_var' => true,
            'capability_type' => 'post',
            'hierarchical' => false,
            'menu_position' => null,
            'rewrite' => array('slug' => $team_item_slug, 'with_front' => true),
            'supports' => array('title', 'editor', 'thumbnail','excerpt'),
            'has_archive' => true,
        );

        educatito_custom_reg_post_type('team', $args);

        educatito_custom_reg_taxonomy('team-types', 'team', array(
            'hierarchical' => true,
            'label' => __('Team Categories', 'educatito'),
            'singular_label' => __('Team Category', 'educatito'),
            'rewrite' => true,
            'query_var' => true
        ));
    }

// end function
}// end if 
add_action('init', 'educatito_team_post_type', 7);


/* ---------------------------------------------------------------------------
 * Edit columns
 * --------------------------------------------------------------------------- */

function educatito_team_edit_columns($columns) {
    $newcolumns = array(
        "cb" => "<input type='checkbox' />",
        "team_thumbnail" => esc_html__('Photo', 'educatito'),
        "title" => esc_html__('Title', 'educatito'),
    );
    $columns = array_merge($newcolumns, $columns);

    return $columns;
}

add_filter("manage_edit-team_columns", "educatito_team_edit_columns");


/* ---------------------------------------------------------------------------
 * Custom columns
 * --------------------------------------------------------------------------- */

function educatito_team_custom_columns($column) {
    global $post;
    switch ($column) {
        case "team_thumbnail":
            if (has_post_thumbnail()) {
                the_post_thumbnail(array(50, 50));
            }
            break;
    }
}

add_action("manage_posts_custom_column", "educatito_team_custom_columns");




// Metaboxes
if (!function_exists('educatito_team_metaboxes')) {

    function educatito_team_metaboxes() {
        add_meta_box('educatito_info_team', 'Info Team', 'educatito_info_team_output', 'team');
        add_meta_box('educatito_social_info', 'Social Info', 'educatito_social_info_output', 'team');
    }

}
add_action('add_meta_boxes', 'educatito_team_metaboxes');

// Metaboxes callback
if (!function_exists('educatito_info_team_output')) {

    function educatito_info_team_output() {
        global $post;
        $position_team = get_post_meta($post->ID, 'position_team', true);
        $email_team = get_post_meta($post->ID, 'email_team', true);
        $phone_team = get_post_meta($post->ID, 'phone_team', true);
        ?>
        <div class="info-team">
            <ul>
                <li>
                    <label><?php echo __('Position:', 'educatito'); ?></label>
                    <input type="text" id="position_team" name="position_team" value="<?php echo esc_attr($position_team); ?>" />
                </li>
                <li>
                    <label><?php echo __('Email:', 'educatito'); ?></label>
                    <input type="email" id="email_team" name="email_team" value="<?php echo esc_attr($email_team); ?>" />
                </li>
                <li>
                    <label><?php echo __('Phone:', 'educatito'); ?></label>
                    <input type="text" id="phone_team" name="phone_team" value="<?php echo esc_attr($phone_team); ?>" />
                </li>
            </ul>
        </div>
        <style>
            .info-team ul li textarea,
            .info-team ul li input{
                width: 100%;
            }
            .info-team label{
                display: block;
            }
        </style>
        <?php
    }

}
if (!function_exists('educatito_social_info_output')) {

    function educatito_social_info_output() {
        global $post;
        $facebook_team = get_post_meta($post->ID, 'facebook_team', true);
        $google_team = get_post_meta($post->ID, 'google_team', true);
        $twitter_team = get_post_meta($post->ID, 'twitter_team', true);
        $instagram_team = get_post_meta($post->ID, 'instagram_team', true);
        ?>
        <div class="social-info">
            <ul>
                <li>
                    <label><?php echo __('Facebook:', 'educatito'); ?></label>
                    <input type="text" id="facebook_team" name="facebook_team" value="<?php echo esc_attr($facebook_team); ?>" />
                </li>
                <li>
                    <label><?php echo __('Google +:', 'educatito'); ?></label>
                    <input type="text" id="google_team" name="google_team" value="<?php echo esc_attr($google_team); ?>" />
                </li>
                <li>
                    <label><?php echo __('Twitter:', 'educatito'); ?></label>
                    <input type="text" id="email_team" name="twitter_team" value="<?php echo esc_attr($twitter_team); ?>" />
                </li>
                <li>
                    <label><?php echo __('Instagram:', 'educatito'); ?></label>
                    <input type="text" id="instagram_team" name="instagram_team" value="<?php echo esc_attr($instagram_team); ?>" />
                </li>
            </ul>
        </div>
        <style>
            .social-info ul li input{
                width: 100%;
            }
            .social-info label{
                display: block;
            }
        </style>
        <?php
    }

}

// Save meta values
if (!function_exists('educatito_save_team_metaboxes')) {

    function educatito_save_team_metaboxes($post_id) {
        if (isset($_POST['position_team'])) {
            update_post_meta($post_id, 'position_team', $_POST['position_team']);
        }
        if (isset($_POST['email_team'])) {
            update_post_meta($post_id, 'email_team', $_POST['email_team']);
        }
        if (isset($_POST['phone_team'])) {
            update_post_meta($post_id, 'phone_team', $_POST['phone_team']);
        }

        if (isset($_POST['facebook_team'])) {
            update_post_meta($post_id, 'facebook_team', $_POST['facebook_team']);
        }
        if (isset($_POST['google_team'])) {
            update_post_meta($post_id, 'google_team', $_POST['google_team']);
        }
        if (isset($_POST['twitter_team'])) {
            update_post_meta($post_id, 'twitter_team', $_POST['twitter_team']);
        }
        if (isset($_POST['instagram_team'])) {
            update_post_meta($post_id, 'instagram_team', $_POST['instagram_team']);
        }
    }

}
add_action('save_post', 'educatito_save_team_metaboxes');


