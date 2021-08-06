<?php

/*
  Plugin Name: Educatito Options
  Plugin URI: http://jrbthemes.com/options
  Description: Show educa options for educa theme.
  Version: 1.0
  Author: JRB Themes
  Author URI: http://jrbthemes.com
 */
define('EDUCATITO_OPTION_URL', plugin_dir_url(__FILE__));

define('EDUCATITO_OPTION_PATH', plugin_dir_path(__FILE__));

function educatito_option_menu_page() {
    add_menu_page(
            __('Educatito', 'educatito'), 'Educatito', '', 'educa.php', '', EDUCATITO_OPTION_URL . '/images/educa.png', 6
    );
}

add_action('admin_menu', 'educatito_option_menu_page');
require_once (EDUCATITO_OPTION_PATH . 'ReduxCore/framework.php');

/* Add theme options. */
require_once ( EDUCATITO_OPTION_PATH . 'options/functions.php' );
require_once ( EDUCATITO_OPTION_PATH . 'options/options.php' );

/* Add custom font */

function educatito_add_custom_font($array) {
    $font = array();
    $font['Educatito'] = array(
        'Cairo-Black' => 'Cairo-Black',
        'Cairo-Bold' => 'Cairo-Bold',
        'Cairo-ExtraLight' => 'Cairo-ExtraLight',
        'Cairo-Light' => 'Cairo-Light',
        'Cairo-Regular' => 'Cairo-Regular',
        'Cairo-SemiBold' => 'Cairo-SemiBold',
        'JosefinSans-Bold' => 'JosefinSans-Bold',
        'JosefinSans-BoldItalic' => 'JosefinSans-BoldItalic',
        'JosefinSans-Italic' => 'JosefinSans-Italic',
        'JosefinSans-Light' => 'JosefinSans-Light',
        'JosefinSans-LightItalic' => 'JosefinSans-LightItalic',
        'JosefinSans-Regular' => 'JosefinSans-Regular',
        'JosefinSans-SemiBold' => 'JosefinSans-SemiBold',
        'JosefinSans-SemiBoldItalic' => 'JosefinSans-SemiBoldItalic',
        'JosefinSans-Thin' => 'JosefinSans-Thin',
        'JosefinSans-ThinItalic' => 'JosefinSans-ThinItalic'
    );
    $array = $font;
    return $array;
}

add_filter("redux/educatito_options/field/typography/custom_fonts", "educatito_add_custom_font", 10, 1);

function educatito_removeDemoModeLink() {
    if (class_exists('ReduxFrameworkPlugin')) {
        remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2);
    }
    if (class_exists('ReduxFrameworkPlugin')) {
        remove_action('admin_notices', array(ReduxFrameworkPlugin::get_instance(), 'admin_notices'));
    }
}

add_action('init', 'educatito_removeDemoModeLink');
/* --------------------- */
