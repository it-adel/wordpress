<?php
if (!function_exists('educatito_insert_shortcode')) {

    function educatito_insert_shortcode($tag, $func) {
        add_shortcode($tag, $func);
    }

}
if (!function_exists('educatito_custom_reg_post_type')) {

    function educatito_custom_reg_post_type($post_type, $args = array()) {
        register_post_type($post_type, $args);
    }

}
if (!function_exists('educatito_custom_reg_taxonomy')) {

    function educatito_custom_reg_taxonomy($taxonomy, $object_type, $args = array()) {
        register_taxonomy($taxonomy, $object_type, $args);
    }

}

if (!function_exists('objectToArray')) {

    function objectToArray($object) {
        if (!is_object($object) && !is_array($object)) {
            return $object;
        }
        return array_map('objectToArray', (array) $object);
    }

}
add_action('nav_menu_css_class', 'educatito_add_current_nav_class', 10, 2);

if (!function_exists('educatito_post_param')) {

    function educatito_post_param($param, $default = null) {
        return isset($_POST[$param]) ? $_POST[$param] : $default;
    }

}
if (!function_exists('educatito_get_param')) {

    function educatito_get_param($param, $default = null) {
        return isset($_GET[$param]) ? $_GET[$param] : $default;
    }

}

function educatito_add_current_nav_class($classes, $item) {

    // Getting the current post details
    global $post;

    if (isset($post) && $post != '') {
        // Getting the post type of the current post
        $current_post_type = get_post_type_object(get_post_type($post->ID));
        $current_post_type_slug = $current_post_type->rewrite['slug'];

        // Getting the URL of the menu item
        $menu_slug = strtolower(trim($item->url));

        // If the menu item URL contains the current post types slug add the current-menu-item class
        if (strpos($menu_slug, $current_post_type_slug) !== false) {

            $classes[] = 'current-menu-item current_page_item';
        }
    }
    return $classes;
}

require_once (EDUCATITO_PLUGIN_PATH . '/inc/megamenu/mega-menu.php');
// Add custom post type
$template = get_option('template');
if ($template == 'educatito') {
    $educatito_options = get_option('educatito_options');
// Meta Option ------------------------------------------------------------
    require_once( 'inc/meta-options/meta-option.php');
    require_once( 'inc/meta-options/template-option.php');
    require_once( 'inc/widgets/social.php' );
    require_once( 'inc/widgets/contact_us.php' );
    require_once( 'inc/widgets/contact_us_footer.php' );
    require_once( 'inc/widgets/recent_post.php' );
    require_once( 'inc/widgets/recent_post_2.php' );
    require_once( 'inc/widgets/banner-course.php' );
    require_once( 'inc/widgets/course-categories.php' );
    require_once( 'inc/widgets/course-tag.php' );
    require_once( 'inc/widgets/course-search.php' );
    require_once( 'inc/widgets/latest_course.php' );
    require_once( 'inc/widgets/testimonial.php' );
    require_once( 'inc/widgets/slider_course.php' );
    require_once( 'inc/widgets/course-megamenu.php' );

    if (is_admin() && educatito_post_param('action') === 'educatito_options_ajax_save') {
        /* Add SCSS. */
        if (!class_exists('WP_Filesystem')) {
            require_once(ABSPATH . 'wp-admin/includes/file.php');
        }

        WP_Filesystem();

        if (!class_exists('scssc')) {
            require_once(EDUCATITO_PLUGIN_PATH . 'style-option/scss.php');
        }
        /* Static css. */
        require_once(EDUCATITO_PLUGIN_PATH . 'style-option/static.php');
    }

    register_deactivation_hook(__FILE__, 'educatito_deactivate_options');

    if (!function_exists('educatito_deactivate_options')) {

        function educatito_deactivate_options() {
            if (!class_exists('WP_Filesystem')) {
                require_once(ABSPATH . 'wp-admin/includes/file.php');
            }

            WP_Filesystem();

            if (!class_exists('scssc')) {
                require_once(EDUCATITO_PLUGIN_PATH . 'style-option/scss.php');
            }
            /* Static css. */
            require_once(EDUCATITO_PLUGIN_PATH . 'style-option/static.php');
        }

    }
    /*
     * Shortcode
     */
    if (in_array('js_composer/js_composer.php', apply_filters('active_plugins', get_option('active_plugins')))) {
        require_once( 'shortcode/add-shortcodes.php');

        function educatito_custom_vc_taxonomy() {
            require_once( 'inc/meta-options/vc_extra_fields.php' );
        }

        add_action('vc_before_init', 'educatito_custom_vc_taxonomy', 20);
    }

    if (isset($educatito_options['jrb_enable_testimonial']) && $educatito_options['jrb_enable_testimonial'] == 1) {
        require_once('inc/post-types/testimonial.php');
    }
    if (isset($educatito_options['jrb_enable_team']) && $educatito_options['jrb_enable_team'] == 1) {
        require_once('inc/post-types/team.php');
    }
    if (isset($educatito_options['jrb_enable_portfolio']) && $educatito_options['jrb_enable_portfolio'] == 1) {
        require_once('inc/post-types/portfolio.php');
    }
} else {
    require_once('inc/post-types/testimonial.php');
    require_once('inc/post-types/team.php');
    require_once('inc/post-types/portfolio.php');
}
/*
 * Educatito Social Share
 */
add_action('educatito_social_share', 'educatito_social_share_post');
if (!function_exists('educatito_social_share_post')):

    function educatito_social_share_post() {
        global $post;
        $link_share = get_permalink($post->ID);
        ?> 
        <h3><?php echo esc_html__('Share Link :', 'educatito'); ?></h3>
        <ul class="social_element">
            <li>
                <a href="http://www.facebook.com/sharer.php?u=<?php echo esc_url($link_share); ?>" rel="nofollow" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
            </li>
            <li>
                <a href="https://twitter.com/intent/tweet?url=<?php echo esc_url($link_share); ?>" rel="nofollow" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
            </li>
            <li>
                <a href="https://plus.google.com/share?url=<?php echo esc_url($link_share); ?>" rel="nofollow" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
            </li>
            <li>
                <a href="http://pinterest.com/pin/create/bookmarklet/?url=<?php echo esc_url($link_share); ?>" rel="nofollow" target="_blank"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
            </li>
        </ul> 
        <?php
    }

endif;

if (!function_exists('educatito_mail_from')) {

    function educatito_mail_from($old) {
        return 'admin@gmail.com';
    }

}
if (!function_exists('educatito_mail_from_name')) {

    function educatito_mail_from_name($old) {
        return 'Educatito';
    }

}

add_filter('wp_mail_from', 'educatito_mail_from');
add_filter('wp_mail_from_name', 'educatito_mail_from_name');

if (!function_exists('educatito_reg_new_user')) {

    function educatito_reg_new_user() {

        if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'vb_new_user'))
            die('Ooops, something went wrong, please try again later.');

        $password = $_POST['pass'];
        $email = $_POST['mail'];
        $userdata = array(
            'user_login' => $email,
            'user_pass' => $password,
            'user_email' => $email,
        );

        $user_id = wp_insert_user($userdata);

        $user_pass = $_POST['pass'];
        $home_url = home_url();
        $email = $_POST["mail"];
        $headers[] = 'From: Me Myself "' . $email . '"';
        $subject = "Form to email message";

        $mailBody = "Username/Email: $email\n Password: $user_pass\n Click in here $home_url to login to website\n";
        wp_mail($email, $subject, $mailBody, "From: <$email>");

        if (!is_wp_error($user_id)) {
            echo '1';
        } else {
            echo esc_attr($user_id->get_error_message());
        }
        die();
    }

}
add_action('wp_ajax_register_user', 'educatito_reg_new_user');
add_action('wp_ajax_nopriv_register_user', 'educatito_reg_new_user');
