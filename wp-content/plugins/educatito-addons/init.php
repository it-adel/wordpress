<?php

/*
  Plugin Name: Educatito Addons
  Plugin URI: http://jrbthemes.com
  Description: Show all shortcode and educa options for educa theme.
  Version: 1.0
  Author: JRB Themes
  Author URI: http://jrbthemes.com
 */
if (!defined('ABSPATH')) {
    die('-1');
}
define('EDUCATITO_PLUGIN_URL', plugin_dir_url(__FILE__));

define('EDUCATITO_PLUGIN_PATH', plugin_dir_path(__FILE__));

add_filter('widget_text', 'do_shortcode');

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

/*
 * Loads the Options Panel
 */
require_once( 'custom-addons.php' );
require_once( 'import/one-click-demo-import.php' );
/* Import content data */
if (!function_exists('educatito_import_files')) :

    function educatito_import_files() {
        return array(
            array(
                'import_file_name' => 'Default Demo',
                'local_import_file' => EDUCATITO_PLUGIN_PATH . '/demo/default/content.xml',
                'local_import_widget_file' => EDUCATITO_PLUGIN_PATH . '/demo/default/widgets.wie',
                'import_customizer_file_url' => EDUCATITO_PLUGIN_URL . '/demo/default/customizer.dat',
                'import_redux' => array(
                    array(
                        'file_url' => EDUCATITO_PLUGIN_URL . '/demo/default/redux.json',
                        'option_name' => 'educatito_options',
                    ),
                ),
                'import_preview_image_url' => 'http://www.test2.jrbthemes.com/wp-content/themes/educatito/demo/default/screenshot.jpg',
                'preview_url' => 'http://www.educa.jrbthemes.com/',
            )
        );
    }

    add_filter('pt-ocdi/import_files', 'educatito_import_files');
endif;

if (!function_exists('educatito_after_import')) :

    function educatito_after_import($selected_import) {

        if ('Default Demo' === $selected_import['import_file_name']) {
            //Set Menu
            $main_menu = get_term_by('name', 'Main Menu', 'nav_menu');

            set_theme_mod('nav_menu_locations', array(
                'educatito-main-menu' => $main_menu->term_id,
                    )
            );
            $front_page_id = get_page_by_title('Home');
            $blog_page_id = get_page_by_title('Blog');
            $login_lp = get_page_by_title('Login');
            $courses_lp = get_page_by_title('Courses');
            $profile_lp = get_page_by_title('Profile');
            $checkout_lp = get_page_by_title('LP Checkout');
            $teacher_lp = get_page_by_title('LP Become A Teacher');
            update_option('learn_press_logout_redirect_page_id', $login_lp->ID);
            update_option('learn_press_courses_page_id', $courses_lp->ID);
            update_option('learn_press_profile_page_id', $profile_lp->ID);
            update_option('learn_press_checkout_page_id', $checkout_lp->ID);
            update_option('learn_press_become_a_teacher_page_id', $teacher_lp->ID);
            update_option('show_on_front', 'page');
            update_option('page_on_front', $front_page_id->ID);
            update_option('page_for_posts', $blog_page_id->ID);
            global $wp_rewrite;
            $wp_rewrite->set_permalink_structure('/%postname%/');
            //Import Revolution Slider
            if (class_exists('RevSlider')) {
                $slider_array = array(
                    EDUCATITO_PLUGIN_PATH . "/demo/default/home-slider.zip",
                    EDUCATITO_PLUGIN_PATH . "/demo/default/courseonline.zip",
                    EDUCATITO_PLUGIN_PATH . "/demo/default/homekid.zip"
                );

                $slider = new RevSlider();

                foreach ($slider_array as $filepath) {
                    $slider->importSliderFromPost(true, true, $filepath);
                }

                echo ' Slider processed';
            }
        }
    }

    add_action('pt-ocdi/after_import', 'educatito_after_import');
endif;

