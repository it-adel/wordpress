<?php

/**
 * Themes Options
 */
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
$msg = $disabled = '';
if (!class_exists('WPBakeryVisualComposerAbstract') or ! class_exists('CmssuperheroesCore')) {
    $disabled = ' disabled ';
    $msg = esc_html__('You should be install visual composer and Cmssuperheroes plugins to import', 'educatito');
}
require_once ( EDUCATITO_OPTION_PATH . 'options/requirement.php' );

$this->sections[] = array(
    'title' => esc_html__('JRB Requirements', 'educatito'),
    'icon' => 'fa fa-list-alt',
    'id' => 'bt_requirement',
    'desc' => educatito_server_required(),
);


$this->sections[] = array(
    'title' => esc_html__('General', 'educatito'),
    'icon' => 'fa fa-cogs',
    'fields' => array(
        array(
            'id' => 'jrb_setting_font_theme',
            'icon' => true,
            'type' => 'info',
            'raw' => sprintf(__('<h3>Setting Font Default Theme</h3>', 'educatito')),
        ),
        array(
            'desc' => esc_html__('Enable or disable fonts default from theme.', 'educatito'),
            'id' => 'jrb_font_default_theme',
            'on' => 'Yes',
            'off' => 'No',
            'type' => 'switch',
            'title' => esc_html__('Font Theme', 'educatito'),
            'default' => 1,
        ),
        array(
            'id' => 'jrb_boxed_mode_only',
            'icon' => true,
            'type' => 'info',
            'raw' => sprintf(__('<h3>Background options</h3>', 'educatito')),
        ),
        array(
            'desc' => esc_html__('Select an image or insert an image url to use for the backgroud.', 'educatito'),
            'id' => 'jrb_bg_image',
            'type' => 'media',
            'title' => esc_html__('Background Image', 'educatito'),
            'url' => true,
        ),
        array(
            'desc' => esc_html__('The background image display at 100% in width and height and scale according to the browser size.', 'educatito'),
            'id' => 'jrb_bg_full',
            'on' => 'Yes',
            'off' => 'No',
            'type' => 'switch',
            'title' => esc_html__('100% Background Image', 'educatito'),
            'default' => 1,
        ),
        array(
            'desc' => esc_html__('Select how the background image repeats.', 'educatito'),
            'id' => 'jrb_bg_repeat',
            'type' => 'select',
            'options' => array(
                'repeat' => esc_html__('repeat', 'educatito'),
                'repeat-x' => esc_html__('repeat-x', 'educatito'),
                'repeat-y' => esc_html__('repeat-y', 'educatito'),
                'no-repeat' => esc_html__('no-repeat', 'educatito'),
            ),
            'title' => esc_html__('Background Repeat', 'educatito'),
            'default' => 'repeat',
        ),
        array(
            'desc' => esc_html__('Select the position from where background image starts.', 'educatito'),
            'id' => 'jrb_bg_pos',
            'type' => 'select',
            'options' => array(
                'top left' => esc_html__('top left', 'educatito'),
                'top center' => esc_html__('top center', 'educatito'),
                'top right' => esc_html__('top right', 'educatito'),
                'center left' => esc_html__('center left', 'educatito'),
                'center center' => esc_html__('center center', 'educatito'),
                'center right' => esc_html__('center right', 'educatito'),
                'bottom left' => esc_html__('bottom left', 'educatito'),
                'bottom center' => esc_html__('bottom center', 'educatito'),
                'bottom right' => esc_html__('bottom right', 'educatito'),
            ),
            'title' => esc_html__('Background Position', 'educatito'),
            'default' => 'center center',
        ),
        array(
            'desc' => esc_html__('Display a pattern in the background. If Yes, select the pattern from below.', 'educatito'),
            'id' => 'jrb_bg_pattern_option',
            'on' => 'Yes',
            'off' => 'No',
            'type' => 'switch',
            'title' => esc_html__('Background Pattern', 'educatito'),
            'default' => 0,
        ),
        array(
            'desc' => esc_html__('Select a background pattern.', 'educatito'),
            'id' => 'jrb_bg_pattern',
            'type' => 'image_select',
            'options' => array(
                4 => EDUCATITO_OPTION_URL . 'assets/images/bg/bg1.png',
                9 => EDUCATITO_OPTION_URL . 'assets/images/bg/bg2.png',
                10 => EDUCATITO_OPTION_URL . 'assets/images/bg/bg3.png',
                0 => EDUCATITO_OPTION_URL . 'assets/images/bg/bg4.png',
                6 => EDUCATITO_OPTION_URL . 'assets/images/bg/bg5.png',
                1 => EDUCATITO_OPTION_URL . 'assets/images/bg/bg6.jpg',
                7 => EDUCATITO_OPTION_URL . 'assets/images/bg/bg7.jpg',
                3 => EDUCATITO_OPTION_URL . 'assets/images/bg/bg8.png',
                5 => EDUCATITO_OPTION_URL . 'assets/images/bg/bg9.png',
                2 => EDUCATITO_OPTION_URL . 'assets/images/bg/bg10.png',
                8 => EDUCATITO_OPTION_URL . 'assets/images/bg/bg11.png',
                11 => EDUCATITO_OPTION_URL . 'assets/images/bg/bg0.png',
            ),
            'title' => esc_html__('Select a Background Pattern', 'educatito'),
            'default' => EDUCATITO_OPTION_URL . 'assets/images/bg/bg0.png',
            'required' => array(
                0 => 'jrb_bg_pattern_option',
                1 => '=',
                2 => 1,
            ),
            'tiles' => true,
        ),
        array(
            'id' => 'jrb_header_info',
            'icon' => true,
            'type' => 'info',
            'raw' => sprintf(__('<h3>Logo Options</h3>', 'educatito')),
        ),
        array(
            'desc' => esc_html__('Select an image file for your logo.', 'educatito'),
            'id' => 'jrb_logo',
            'type' => 'media',
            'title' => esc_html__('Logo', 'educatito'),
            'default' => array(
                'url' => EDUCATITO_OPTION_URL . 'options/images/logo.png',
            ),
            'url' => true,
        ),
        array(
            'desc' => esc_html__('Enter logo height, In pixels, ex: 40px', 'educatito'),
            'id' => 'jrb_logo_max_height',
            'type' => 'text',
            'title' => esc_html__('Logo Max Height', 'educatito'),
            'default' => '45px',
        ),
        array(
            'desc' => esc_html__('In pixels, top right bottom left, ex: 10px 10px 10px 10px', 'educatito'),
            'id' => 'jrb_margin_logo',
            'type' => 'text',
            'title' => esc_html__('Logo Margin', 'educatito'),
            'default' => '0px',
        ),
        array(
            'desc' => esc_html__('In pixels, top right bottom left, ex: 10px 10px 10px 10px', 'educatito'),
            'id' => 'jrb_padding_logo',
            'type' => 'text',
            'title' => esc_html__('Logo Padding', 'educatito'),
            'default' => '0px',
        ),
        array(
            'desc' => esc_html__('Select an image file for your logo mobile.', 'educatito'),
            'id' => 'jrb_logo_mobile',
            'type' => 'media',
            'title' => esc_html__('Logo Mobile', 'educatito'),
            'default' => array(
                'url' => EDUCATITO_OPTION_URL . 'options/images/logo.png',
            ),
            'url' => true,
        ),
        array(
            'desc' => esc_html__('Select an image file for your logo sticky.', 'educatito'),
            'id' => 'jrb_logo_sticky',
            'type' => 'media',
            'title' => esc_html__('Logo Sticky', 'educatito'),
            'default' => array(
                'url' => EDUCATITO_OPTION_URL . 'options/images/logo.png',
            ),
            'url' => true,
        )
    ),
);
/**
 * Page Loader
 *
 */
$this->sections[] = array(
    'title' => esc_html__('Page Loader', 'educatito'),
    'desc' => esc_html__('Page Loader Options', 'educatito'),
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'use_page_loader',
            'type' => 'switch',
            'title' => esc_html__('Use Page Loader?', 'educatito'),
            'desc' => esc_html__('', 'educatito'),
            'default' => 0,
            'on' => esc_html__('Enabled', 'educatito'),
            'off' => esc_html__('Disabled', 'educatito')
        ),
        array(
            'id' => 'layout_loader',
            'type' => 'image_select',
            'compiler' => true,
            'title' => esc_html__('Loader layout', 'educatito'),
            'subtitle' => esc_html__('Please choose loader layout', 'educatito'),
            'options' => array(
                'style-1' => array('alt' => esc_html__('Style 1', 'educatito'), 'img' => EDUCATITO_OPTION_URL . 'assets/images/loader/loader-1.jpg'),
                'style-2' => array('alt' => esc_html__('Style 2', 'educatito'), 'img' => EDUCATITO_OPTION_URL . 'assets/images/loader/loader-2.jpg'),
                'style-3' => array('alt' => esc_html__('Style 2', 'educatito'), 'img' => EDUCATITO_OPTION_URL . 'assets/images/loader/loader-3.jpg'),
            ),
            'default' => 'style-1',
            'required' => array('use_page_loader', 'equals', array(1)),
        ),
        array(
            'id' => 'background_page_loader',
            'type' => 'background',
            'title' => esc_html__('Background Color Page Loader', 'educatito'),
            'background-repeat' => false,
            'background-attachment' => false,
            'background-position' => false,
            'background-image' => false,
            'background-size' => false,
            'preview' => false,
            'transparent' => false,
            'default' => array(
                'background-color' => '#FFFFFF',
            ),
            'output' => array('.educatito_page_loader'),
            'required' => array('use_page_loader', 'equals', array(1)),
        ),
    )
);
/**
 * Smooth Scroll
 *
 */
$this->sections[] = array(
    'title' => esc_html__('Smooth Scroll', 'educatito'),
    'desc' => esc_html__('', 'educatito'),
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'use_smooth_scroll',
            'type' => 'switch',
            'title' => esc_html__('Use Smooth Scroll?', 'educatito'),
            'desc' => esc_html__('Smooth Scroll Options', 'educatito'),
            'default' => 0,
            'on' => esc_html__('Enabled', 'educatito'),
            'off' => esc_html__('Disabled', 'educatito')
        ),
    )
);
/* End Dummy Data */

$this->sections[] = array(
    'title' => esc_html__('Layout & Styling', 'educatito'),
    'icon' => 'fa fa-tachometer',
    'fields' => array(
        array(
            'id' => 'jrb_layout',
            'icon' => true,
            'type' => 'info',
            'raw' => sprintf(__('<h3>Layout Options</h3>', 'educatito')),
        ),
        array(
            'desc' => esc_html__('Select boxed or wide layout.', 'educatito'),
            'id' => 'jrb_layout',
            'type' => 'image_select',
            'options' => array(
                'full' => EDUCATITO_OPTION_URL . 'assets/images/full.jpg',
                'boxed' => EDUCATITO_OPTION_URL . 'assets/images/box.jpg',
            ),
            'title' => esc_html__('Layout', 'educatito'),
            'default' => 'full',
        ),
        array(
            'id' => 'jrb_main_color',
            'icon' => true,
            'type' => 'info',
            'raw' => sprintf(__('<h3>Main Color</h3>', 'educatito')),
        ),
        array(
            'desc' => esc_html__('Controls several items, ex: link hovers, highlights, and more.', 'educatito'),
            'id' => 'jrb_primary_color',
            'type' => 'color',
            'title' => esc_html__('Primary Color', 'educatito'),
            'default' => '#ec910e',
        ),
        array(
            'desc' => esc_html__('Controls the color of all text links.', 'educatito'),
            'id' => 'jrb_link_color',
            'type' => 'color',
            'title' => esc_html__('Link Color', 'educatito'),
            'default' => '#636363',
        ),
        array(
            'desc' => esc_html__('Link Color Hover.', 'educatito'),
            'id' => 'jrb_link_hover_color',
            'type' => 'color',
            'title' => esc_html__('Link Color Hover.', 'educatito'),
            'default' => '#ec910e',
        ),
        array(
            'desc' => esc_html__('Controls the background hover color of buttons.', 'educatito'),
            'id' => 'jrb_button_text_color',
            'type' => 'color',
            'title' => esc_html__('Background Button hover Color', 'educatito'),
            'default' => '#ec910e',
        ),
    ),
);
$this->sections[] = array(
    'title' => esc_html__('404 Page', 'educatito'),
    'icon' => 'fa fa-exclamation-circle',
    'fields' => array(
        array(
            'id' => 'jrb_404_bg',
            'type' => 'background',
            'title' => esc_html__('Background', 'educatito'),
            'subtitle' => esc_html__('background with image, color, etc.', 'educatito'),
            'default' => array(
                'background-color' => '#1e1e1e',
                'background-image' => EDUCATITO_OPTION_URL . 'options/images/404-bg1.jpg',
                'background-repeat' => 'no-repeat',
                'background-size' => 'cover',
                'background-position' => 'center top',
            ),
            'output' => array('.error-page'),
        ),
        array(
            'id' => 'jrb_404',
            'icon' => true,
            'type' => 'info',
            'raw' => sprintf(__('<h3>Title</h3>', 'educatito')),
        ),
        array(
            'desc' => esc_html__('Show Title 404', 'viltorax'),
            'id' => 'jrb_show_title_404',
            'on' => 'Yes',
            'off' => 'No',
            'type' => 'switch',
            'title' => esc_html__('Show Title 404', 'viltorax'),
            'default' => 1,
        ),
        array(
            'desc' => esc_html__('Add a custom Title text. ', 'educatito'),
            'id' => 'jrb_title_404',
            'type' => 'text',
            'title' => esc_html__('Title 404', 'educatito'),
            'default' => esc_html__('404 Error !', 'educatito'),
            'required' => array(
                0 => 'jrb_show_title_404',
                1 => '=',
                2 => 1,
            ),
        ),
        array(
            'id' => 'jrb_404',
            'icon' => true,
            'type' => 'info',
            'raw' => sprintf(__('<h3>Content</h3>', 'educatito')),
        ),
        array(
            'desc' => esc_html__('Show content 404', 'viltorax'),
            'id' => 'jrb_show_content_404',
            'on' => 'Yes',
            'off' => 'No',
            'type' => 'switch',
            'title' => esc_html__('Show content 404', 'viltorax'),
            'default' => 1,
        ),
        array(
            'desc' => esc_html__('Add a custom content text. ', 'educatito'),
            'id' => 'jrb_content_404',
            'type' => 'textarea',
            'title' => esc_html__('Content 404', 'educatito'),
            'default' => esc_html__('Sorry, we can not find the page you are looking for. Please go to ', 'educatito'),
            'required' => array(
                0 => 'jrb_show_content_404',
                1 => '=',
                2 => 1,
            ),
        ),
    ),
);
/**
 * Menu
 *
 */
$this->sections[] = array(
    'title' => __('Menu', 'educatito'),
    'icon' => 'fa fa-bars',
    'fields' => array(
        array(
            'id' => 'jrb_header_info',
            'icon' => true,
            'type' => 'info',
            'raw' => sprintf(__('<h3>Mega Menu Image</h3>', 'educatito')),
        ),
        array(
            'id' => 'jrb_maga_menu_bg',
            'type' => 'background',
            'title' => esc_html__('Background', 'educatito'),
            'subtitle' => esc_html__('background with image, color, etc.', 'educatito'),
            'default' => array(
                'background-color' => '#ffffff',
                'background-image' => EDUCATITO_OPTION_URL . 'options/images/megamenu.png',
                'background-repeat' => 'no-repeat',
                'background-size' => 'contain',
                'background-position' => 'right bottom',
            ),
            'output' => array('.header-v1 .header .main-menu .menu-primary>li.menu_full_width>ul.multicolumn.columns2, .header-v2 .header .main-menu .menu-primary>li.menu_full_width>ul.multicolumn.columns2, .header-v3 .header .main-menu .menu-primary>li.menu_full_width>ul.multicolumn.columns2'),
        ),
        array(
            'id' => 'jrb_header_info',
            'icon' => true,
            'type' => 'info',
            'raw' => sprintf(__('<h3>Menu Options</h3>', 'educatito')),
        ),
        array(
            'desc' => __('Display background in menu.', 'educatito'),
            'id' => 'jrb_background_menu',
            'type' => 'color',
            'title' => __('Background Menu', 'educatito'),
            'default' => '',
        ),
        array(
            'desc' => __('Transparent menu.<br /> Min: 0, max: 100, step: 1, default value: 100', 'educatito'),
            'id' => 'jrb_menu_transparent',
            'step' => '1',
            'max' => '100',
            'type' => 'slider',
            'title' => esc_html__('Transparent Menu', 'educatito'),
            'default' => '100',
        ),
        array(
            'desc' => esc_html__('Uppercase in menu', 'educatito'),
            'id' => 'jrb_menu_uppercase',
            'on' => 'Yes',
            'off' => 'No',
            'type' => 'switch',
            'title' => esc_html__('Uppercase Menu', 'educatito'),
            'default' => 1,
        ),
        array(
            'desc' => __('Use a number without \'px\', ex: 14px. (Default is 14px).', 'educatito'),
            'id' => 'jrb_menu_fontsize',
            'type' => 'text',
            'title' => __('Menu Font Size', 'educatito'),
            'default' => '14px',
        ),
        array(
            'desc' => __('Controls color menu items, ex: link, and more.', 'educatito'),
            'id' => 'jrb_menu_color',
            'type' => 'color',
            'title' => __('Menu Color', 'educatito'),
            'default' => '#060709',
        ),
        array(
            'desc' => __('Menu item hover color, ex: hover link menu item and more.', 'educatito'),
            'id' => 'jrb_menu_hover_color',
            'type' => 'color',
            'title' => __('Menu Item Hovers Color', 'educatito'),
            'default' => '#ec910e',
        ),
        array(
            'desc' => __('Menu item hover background, ex: hover link menu item and more.', 'educatito'),
            'id' => 'jrb_menu_background_hover_color',
            'type' => 'color',
            'title' => __('Menu Item Hovers Background', 'educatito'),
            'default' => '',
        ),
        array(
            'desc' => __('Menu item color current, ex: click link, active link, and more.', 'educatito'),
            'id' => 'jrb_menu_acti_color',
            'type' => 'color',
            'title' => __('Menu Item Active Color', 'educatito'),
            'default' => '#ec910e',
        ),
        array(
            'desc' => __('Menu item background current, ex: click link, active link, and more.', 'educatito'),
            'id' => 'jrb_menu_background_acti_color',
            'type' => 'color',
            'title' => __('Menu Item Active Background', 'educatito'),
            'default' => '',
        ),
        array(
            'id' => 'jrb_header_info',
            'icon' => true,
            'type' => 'info',
            'raw' => sprintf(__('<h3>Sub Menu Options</h3>', 'educatito')),
        ),
        array(
            'desc' => __('Controls color sub menu items.', 'educatito'),
            'id' => 'jrb_submenu_color',
            'type' => 'color',
            'title' => __('Sub Menu Color', 'educatito'),
            'default' => '#060709',
        ),
        array(
            'desc' => __('Display background in submenu.', 'educatito'),
            'id' => 'jrb_background_submenu',
            'type' => 'color',
            'title' => __('Background Sub Menu', 'educatito'),
            'default' => '#ffffff',
        ),
        array(
            'desc' => __('Sub menu item hover color', 'educatito'),
            'id' => 'jrb_sub_menu_hover_color',
            'type' => 'color',
            'title' => __('Sub Menu Item Hover Color', 'educatito'),
            'default' => '#ec910e',
        ),
        array(
            'desc' => __('Sub menu item hover backgroud.', 'educatito'),
            'id' => 'jrb_sub_menu_backgound_hover_color',
            'type' => 'color',
            'title' => __('Sub Menu Item Hover Background', 'educatito'),
            'default' => '',
        ),
        array(
            'desc' => __('Sub menu item color current, ex: click link, active link, and more.', 'educatito'),
            'id' => 'jrb_sub_menu_acti_color',
            'type' => 'color',
            'title' => __('Sub Menu Item Active Color', 'educatito'),
            'default' => '#ec910e',
        ),
        array(
            'desc' => __('Sub menu item backgroud current, ex: click link, active link, and more.', 'educatito'),
            'id' => 'jrb_sub_menu_backgound_acti_color',
            'type' => 'color',
            'title' => __('Sub Menu Item Active Background', 'educatito'),
            'default' => '',
        ),
    ),
);

/**
 * Header Options
 */
$this->sections[] = array(
    'title' => esc_html__('Header', 'educatito'),
    'icon' => 'fa fa-header',
    'fields' => array(
        array(
            'id' => 'jrb_info_header',
            'icon' => true,
            'type' => 'info',
            'raw' => sprintf(__('<h3>Top Header</h3>', 'educatito')),
        ),
        array(
            'id' => 'jrb_info_header_login',
            'on' => 'Yes',
            'off' => 'No',
            'type' => 'switch',
            'title' => esc_html__('Display Login', 'educatito'),
            'default' => 1,
        ),
        array(
            'id' => 'jrb_info_header_info',
            'on' => 'Yes',
            'off' => 'No',
            'type' => 'switch',
            'title' => esc_html__('Display Info', 'educatito'),
            'default' => 1,
        ),
        array(
            'desc' => esc_html__('Please, Enter a welcome here.', 'educatito'),
            'id' => 'jrb_info_header_welcome',
            'type' => 'text',
            'title' => esc_html__('Welcome', 'educatito'),
            'default' => esc_html__('Welcome to EDUCATITO center !', 'educatito'),
            'required' => array(
                0 => 'jrb_info_header_info',
                1 => '=',
                2 => 1,
            ),
        ),
        array(
            'desc' => esc_html__('Please, Enter a address here.', 'educatito'),
            'id' => 'jrb_info_header_address',
            'type' => 'text',
            'title' => esc_html__('Address', 'educatito'),
            'default' => esc_html__('155th West, 43rd Stress, New York', 'educatito'),
            'required' => array(
                0 => 'jrb_info_header_info',
                1 => '=',
                2 => 1,
            ),
        ),
        array(
            'desc' => esc_html__('Please, Enter a phone here.', 'educatito'),
            'id' => 'jrb_info_header_phone',
            'type' => 'text',
            'title' => esc_html__('Phone', 'educatito'),
            'default' => esc_html__('(+88) 111 555 666', 'educatito'),
            'required' => array(
                0 => 'jrb_info_header_info',
                1 => '=',
                2 => 1,
            ),
        ),
        array(
            'id' => 'jrb_logo_menu',
            'icon' => true,
            'type' => 'info',
            'raw' => sprintf(__('<h3>Logo and Main Menu</h3>', 'educatito')),
        ),
        array(
            'desc' => esc_html__('You can choose various different logo and main menu positions here', 'educatito'),
            'id' => 'jrb_logo_menu',
            'type' => 'image_select',
            'options' => array(
                'v1' => EDUCATITO_OPTION_URL . 'images/header/header-1.jpg',
                'v2' => EDUCATITO_OPTION_URL . 'images/header/header-2.jpg',
                'v3' => EDUCATITO_OPTION_URL . 'images/header/header-3.jpg',
            ),
            'title' => esc_html__('Menu and Logo Position', 'educatito'),
            'default' => 'v1',
        ),
        array(
            'desc' => __('Controls color header.', 'educatito'),
            'id' => 'jrb_header_color',
            'type' => 'color',
            'title' => __('Header Color', 'educatito'),
            'default' => '',
        ),
        array(
            'desc' => esc_html__('Background header', 'educatito'),
            'id' => 'jrb_background_header',
            'type' => 'color',
            'title' => esc_html__('Background Header', 'educatito'),
            'default' => '',
        ),
        array(
            'desc' => __('Transparent header.<br /> Min: 0, max: 100, step: 1, default value: 100', 'educatito'),
            'id' => 'jrb_header_transparent',
            'step' => '1',
            'max' => '100',
            'type' => 'slider',
            'title' => esc_html__('Transparent Header', 'educatito'),
            'default' => '100',
        ),
        array(
            'desc' => esc_html__('Display cart', 'educatito'),
            'id' => 'jrb_cart_woo',
            'on' => 'Yes',
            'off' => 'No',
            'type' => 'switch',
            'title' => esc_html__('Display Cart', 'educatito'),
            'default' => 1,
        ),
        array(
            'desc' => esc_html__('Display Login/Register', 'educatito'),
            'id' => 'jrb_login_woo',
            'on' => 'Yes',
            'off' => 'No',
            'type' => 'switch',
            'title' => esc_html__('Display Login/Register', 'educatito'),
            'default' => 1,
        ),
        array(
            'id' => 'jrb_display_button_header',
            'on' => 'Yes',
            'off' => 'No',
            'type' => 'switch',
            'title' => esc_html__('Display Button Header', 'educatito'),
            'default' => 1,
        ),
        array(
            'desc' => esc_html__('text button header', 'educatito'),
            'id' => 'jrb_text_button_header',
            'type' => 'text',
            'title' => esc_html__('Text Button', 'educatito'),
            'default' => esc_html__('APPLY NOW', 'educatito'),
            'required' => array(
                0 => 'jrb_display_button_header',
                1 => '=',
                2 => 1,
            ),
        ),
        array(
            'desc' => esc_html__('Link button header', 'educatito'),
            'id' => 'jrb_link_button_header',
            'type' => 'text',
            'title' => esc_html__('Link Button', 'educatito'),
            'default' => esc_html__('#', 'educatito'),
            'required' => array(
                0 => 'jrb_display_button_header',
                1 => '=',
                2 => 1,
            ),
        ),
        array(
            'id' => 'jrb_sticky_header_info',
            'icon' => true,
            'type' => 'info',
            'raw' => sprintf(__('<h3>Sticky Header Options</h3>', 'educatito')),
        ),
        array(
            'desc' => esc_html__('Enable a fixed header when scrolling.', 'educatito'),
            'id' => 'jrb_header_sticky',
            'on' => 'Yes',
            'off' => 'No',
            'type' => 'switch',
            'title' => esc_html__('Enable Sticky Header', 'educatito'),
            'default' => 0,
        ),
        array(
            //'desc' => esc_html__('Customs sticky header when scrolling.', 'educatito'),
            'id' => 'jrb_custom_header_sticky',
            'on' => 'Yes',
            'off' => 'No',
            'type' => 'switch',
            'title' => esc_html__('Customs Sticky Header', 'educatito'),
            'default' => 0,
            'required' => array(
                0 => 'jrb_header_sticky',
                1 => '=',
                2 => 1,
            ),
        ),
        array(
            'desc' => esc_html__('Background header sticky', 'educatito'),
            'id' => 'jrb_background_header_sticky',
            'type' => 'color',
            'title' => esc_html__('Background Header Sticky', 'educatito'),
            'default' => '#fff',
            'required' => array(
                0 => 'jrb_custom_header_sticky',
                1 => '=',
                2 => 1,
            ),
        ),
        array(
            'desc' => __('Set the opacity of background.<br /> Min: 0, max: 100, step: 1, default value: 45', 'educatito'),
            'id' => 'jrb_header_sticky_opacity',
            'step' => '1',
            'max' => '100',
            'type' => 'slider',
            'title' => esc_html__('Sticky Header Opacity', 'educatito'),
            'required' => array(
                0 => 'jrb_custom_header_sticky',
                1 => '=',
                2 => 1,
            ),
        ),
        array(
            'desc' => esc_html__('Color header sticky', 'educatito'),
            'id' => 'jrb_color_header_sticky',
            'type' => 'color',
            'title' => esc_html__('Color Header Sticky', 'educatito'),
            'default' => '#060709',
            'required' => array(
                0 => 'jrb_custom_header_sticky',
                1 => '=',
                2 => 1,
            ),
        ),
        array(
            'desc' => __('Color hover header sticky, ex: hover link menu item and more.', 'educatito'),
            'id' => 'jrb_color_hover_header_sticky',
            'type' => 'color',
            'title' => __('Color Hover Header Sticky', 'educatito'),
            'default' => '',
            'required' => array(
                0 => 'jrb_custom_header_sticky',
                1 => '=',
                2 => 1,
            ),
        ),
        array(
            'desc' => __('Color active header sticky, ex: click link, active link, and more.', 'educatito'),
            'id' => 'jrb_color_active_header_sticky',
            'type' => 'color',
            'title' => __('Color Active Header Sticky', 'educatito'),
            'default' => '',
            'required' => array(
                0 => 'jrb_custom_header_sticky',
                1 => '=',
                2 => 1,
            ),
        ),
    ),
);

/**
 * Footer
 */
$this->sections[] = array(
    'title' => esc_html__('Footer', 'educatito'),
    'icon' => 'fa fa-copyright',
    'fields' => array(
        array(
            'desc' => '',
            'id' => 'jrb_footer_backtotop',
            'on' => 'Yes',
            'off' => 'No',
            'type' => 'switch',
            'title' => esc_html__('Back to top', 'educatito'),
            'default' => 1,
        ),
        array(
            'desc' => esc_html__('Select an image or insert an image url to use for the footer top area backgroud.', 'educatito'),
            'id' => 'jrb_footer_top_bg_image',
            'type' => 'media',
            'title' => esc_html__('Background Image', 'educatito'),
            'url' => true,
        ),
        array(
            'desc' => esc_html__('Footer background color.', 'educatito'),
            'id' => 'jrb_backgroud_footer',
            'type' => 'color',
            'title' => esc_html__('Footer Background Color', 'educatito'),
            'default' => '#fff',
        ),
        array(
            'desc' => esc_html__('Footer background color bottom', 'educatito'),
            'id' => 'jrb_backgroud_footer_bottom',
            'type' => 'color',
            'title' => esc_html__('Footer Background Color bottom', 'educatito'),
            'default' => '#222',
        ),
        array(
            'desc' => esc_html__('Footer color.', 'educatito'),
            'id' => 'jrb_color_footer',
            'type' => 'color',
            'title' => esc_html__('Footer Color', 'educatito'),
            'default' => '#636363',
        ),
        array(
            'desc' => esc_html__('Footer headings color.', 'educatito'),
            'id' => 'jrb_color_heading_footer',
            'type' => 'color',
            'title' => esc_html__('Footer Headings Color', 'educatito'),
            'default' => '#1a1a23',
        ),
        array(
            'desc' => esc_html__('Footer Links color.', 'educatito'),
            'id' => 'jrb_color_link_footer',
            'type' => 'color',
            'title' => esc_html__('Footer Link Color', 'educatito'),
            'default' => '#636363',
        ),
        array(
            'desc' => esc_html__('Footer links hover color.', 'educatito'),
            'id' => 'jrb_color_link_hover_footer',
            'type' => 'color',
            'title' => esc_html__('Footer Link Hover Color', 'educatito'),
            'default' => '#ec910e',
        ),
        array(
            'desc' => esc_html__('The footer top background image display at 100% in width and height and scale according to the browser size.', 'educatito'),
            'id' => 'jrb_footer_top_bg_full',
            'on' => 'Yes',
            'off' => 'No',
            'type' => 'switch',
            'title' => esc_html__('100% Background Image', 'educatito'),
        ),
        array(
            'desc' => esc_html__('Select how the background image repeats.', 'educatito'),
            'id' => 'jrb_footer_top_bg_repeat',
            'type' => 'select',
            'options' => array(
                'repeat' => 'repeat',
                'repeat-x' => 'repeat-x',
                'repeat-y' => 'repeat-y',
                'no-repeat' => 'no-repeat',
            ),
            'title' => esc_html__('Background Repeat', 'educatito'),
            'default' => 'repeat',
        ),
        array(
            'desc' => esc_html__('Select the position from where background image starts.', 'educatito'),
            'id' => 'jrb_footer_top_bg_pos',
            'type' => 'select',
            'options' => array(
                0 => 'top left',
                1 => 'top center',
                2 => 'top right',
                3 => 'center left',
                4 => 'center center',
                5 => 'center right',
                6 => 'bottom left',
                7 => 'bottom center',
                8 => 'bottom right',
            ),
            'title' => esc_html__('Background Position', 'educatito'),
            'default' => 'center center',
        ),
        array(
            'desc' => esc_html__('In pixels, top left botton right, ex: 50px, 35px 0px, 90px 0 90px 0', 'educatito'),
            'id' => 'jrb_footer_top_padding',
            'type' => 'text',
            'title' => esc_html__('Footer Padding', 'educatito'),
            'default' => '80px 0 80px 0',
        ),
        array(
            'desc' => esc_html__('In pixels, top left botton right, ex: 10px 10px 10px 10px. (Default: 0px auto).', 'educatito'),
            'id' => 'jrb_footer_top_margin',
            'type' => 'text',
            'title' => esc_html__('Footer Margin', 'educatito'),
            'default' => '0px auto',
        ),
        array(
            'id' => 'jrb_footer_heading',
            'icon' => true,
            'type' => 'info',
            'raw' => sprintf(__('<h3>FOOTER SETTINGS</h3>', 'educatito')),
        ),
        array(
            'desc' => '',
            'id' => 'jrb_footer',
            'on' => 'Yes',
            'off' => 'No',
            'type' => 'switch',
            'title' => esc_html__('Footer Enable', 'educatito'),
            'default' => 1,
        ),
        array(
            'id' => 'jrb_footer_widget_heading',
            'icon' => true,
            'type' => 'info',
            'raw' => sprintf(__('<h3>FOOTER WIDGETS SETTINGS</h3>', 'educatito')),
        ),
        array(
            'desc' => '',
            'id' => 'jrb_footer_widget',
            'on' => 'Yes',
            'off' => 'No',
            'type' => 'switch',
            'title' => esc_html__('Footer Widget Enable', 'educatito'),
            'default' => 1,
        ),
        array(
            'id' => 'jrb_footer_widgets_layout',
            'type' => 'image_select',
            'compiler' => true,
            'title' => esc_html__('Footer widgets layout', 'educatito'),
            'subtitle' => esc_html__('Select your footer widgets layout', 'educatito'),
            'options' => array(
                '2-6_1-6_1-6_2-6' => array('alt' => esc_html__('Layout 1', 'educatito'), 'img' => EDUCATITO_OPTION_URL . 'assets/images/footer/footer-1-2.png'),
                '2-5_1-5_1-5_1-5' => array('alt' => esc_html__('Layout 2', 'educatito'), 'img' => EDUCATITO_OPTION_URL . 'assets/images/footer/footer-1-1.png'),
                '1-4_1-4_1-4_1-4' => array('alt' => esc_html__('Layout 3', 'educatito'), 'img' => EDUCATITO_OPTION_URL . 'assets/images/footer/footer-1.png'),
                '2-4_1-4_1-4' => array('alt' => esc_html__('Layout 4', 'educatito'), 'img' => EDUCATITO_OPTION_URL . 'assets/images/footer/footer-2.png'),
                '1-4_1-4_2-4' => array('alt' => esc_html__('Layout 5', 'educatito'), 'img' => EDUCATITO_OPTION_URL . 'assets/images/footer/footer-3.png'),
                '1-2_1-2' => array('alt' => esc_html__('Layout 6', 'educatito'), 'img' => EDUCATITO_OPTION_URL . 'assets/images/footer/footer-4.png'),
                '1-3_1-3_1-3' => array('alt' => esc_html__('Layout 7', 'educatito'), 'img' => EDUCATITO_OPTION_URL . 'assets/images/footer/footer-5.png'),
                '2-3_1-3' => array('alt' => esc_html__('Layout 8', 'educatito'), 'img' => EDUCATITO_OPTION_URL . 'assets/images/footer/footer-6.png'),
                '1-3_2-3' => array('alt' => esc_html__('Layout 9', 'educatito'), 'img' => EDUCATITO_OPTION_URL . 'assets/images/footer/footer-7.png'),
                '1-4_2-4_1-4' => array('alt' => esc_html__('Layout 10', 'educatito'), 'img' => EDUCATITO_OPTION_URL . 'assets/images/footer/footer-8.png'),
                '1-1' => array('alt' => esc_html__('Layout 11', 'educatito'), 'img' => EDUCATITO_OPTION_URL . 'assets/images/footer/footer-9.png'),
            ),
            'default' => '1-4_1-4_1-4_1-4',
            'required' => array(
                0 => 'jrb_footer_widget',
                1 => '=',
                2 => 1,
            ),
        ),
        array(
            'id' => 'jrb_footer_bottom_heading',
            'icon' => true,
            'type' => 'info',
            'raw' => sprintf(__('<h3>FOOTER BOTTOM SETTINGS</h3>', 'educatito')),
        ),
        array(
            'desc' => '',
            'id' => 'jrb_footer_bottom',
            'on' => 'Yes',
            'off' => 'No',
            'type' => 'switch',
            'title' => esc_html__('Footer Bottom Enable', 'educatito'),
            'default' => 1,
        ),
        array(
            'desc' => esc_html__('Add a custom copyright text at the bottom of your site. ', 'educatito'),
            'id' => 'jrb_copyright',
            'type' => 'text',
            'title' => esc_html__('Copyright', 'educatito'),
            'default' => esc_html__('Copyright 2018 EDUCATITO - All Right Reserved', 'educatito'),
            'required' => array(
                0 => 'jrb_footer_bottom',
                1 => '=',
                2 => 1,
            ),
        ),
    ),
);
/**
 * Sidebar
 */
$this->sections[] = array(
    'title' => esc_html__('Sidebar Options', 'educatito'),
    'icon' => 'fa fa-th-list',
    'fields' => array(
        array(
            'id' => 'jrb_sidebar_info',
            'icon' => true,
            'type' => 'info',
            'raw' => sprintf(__('<h3>Sidebar Options</h3>', 'educatito')),
        ),
        array(
            'desc' => esc_html__('Choose the archive sidebar position here. This setting will be applied to all archive pages', 'educatito'),
            'id' => 'jrb_sidebar_archive',
            'type' => 'image_select',
            'options' => array(
                'no_sidebar' => EDUCATITO_OPTION_URL . 'assets/images/no-sidebar.png',
                'sidebar_left' => EDUCATITO_OPTION_URL . 'assets/images/left-sidebar.png',
                'sidebar_right' => EDUCATITO_OPTION_URL . 'assets/images/right-sidebar.png',
            ),
            'title' => esc_html__('Sidebar on Archive Pages', 'educatito'),
            'default' => 'sidebar_right',
        ),
        array(
            'desc' => esc_html__('Choose the blog sidebar position here. This setting will be applied to the blog page', 'educatito'),
            'id' => 'jrb_sidebar_blog',
            'type' => 'image_select',
            'options' => array(
                'no_sidebar' => EDUCATITO_OPTION_URL . 'assets/images/no-sidebar.png',
                'sidebar_left' => EDUCATITO_OPTION_URL . 'assets/images/left-sidebar.png',
                'sidebar_right' => EDUCATITO_OPTION_URL . 'assets/images/right-sidebar.png',
            ),
            'title' => esc_html__('Sidebar on Blog Page', 'educatito'),
            'default' => 'sidebar_right',
        ),
        array(
            'desc' => esc_html__('Choose the blog post sidebar position here. This setting will be applied to single blog posts.', 'educatito'),
            'id' => 'jrb_sidebar_single_post',
            'type' => 'image_select',
            'options' => array(
                'no_sidebar' => EDUCATITO_OPTION_URL . 'assets/images/no-sidebar.png',
                'sidebar_left' => EDUCATITO_OPTION_URL . 'assets/images/left-sidebar.png',
                'sidebar_right' => EDUCATITO_OPTION_URL . 'assets/images/right-sidebar.png',
            ),
            'title' => esc_html__('Sidebar on Single Post', 'educatito'),
            'default' => 'sidebar_right',
        ),
        array(
            'desc' => esc_html__('Choose the default page layout here. You can change the setting of each individual page when editing that page.', 'educatito'),
            'id' => 'jrb_sidebar_page',
            'type' => 'image_select',
            'options' => array(
                'no_sidebar' => EDUCATITO_OPTION_URL . 'assets/images/no-sidebar.png',
                'sidebar_left' => EDUCATITO_OPTION_URL . 'assets/images/left-sidebar.png',
                'sidebar_right' => EDUCATITO_OPTION_URL . 'assets/images/right-sidebar.png',
            ),
            'title' => esc_html__('Sidebar on Pages', 'educatito'),
            'default' => 'no_sidebar',
        ),
    ),
);

/**
 * Pages
 */
$this->sections[] = array(
    'title' => esc_html__('Pages Options', 'educatito'),
    'icon' => 'fa fa-file',
);
$this->sections[] = array(
    'title' => esc_html__('Page', 'educatito'),
    'desc' => '',
    'icon' => '',
    'subsection' => true,
    'fields' => array(
        array(
            'desc' => esc_html__('Show Comments for pages', 'educatito'),
            'id' => 'jrb_page_comments',
            'on' => 'Yes',
            'off' => 'No',
            'type' => 'switch',
            'title' => esc_html__('Page Comments', 'educatito'),
            'default' => true,
        ),
    ),
);
$this->sections[] = array(
    'title' => esc_html__('Title Bar', 'educatito'),
    'desc' => '',
    'icon' => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'jrb_page_show_page_title',
            'type' => 'switch',
            'title' => esc_html__('Show Page Title', 'educatito'),
            'subtitle' => esc_html__('Show page title in page title bar.', 'educatito'),
            'default' => true,
            'on' => 'Yes',
            'off' => 'No',
        ),
        array(
            'id' => 'jrb_page_show_page_breadcrumb',
            'type' => 'switch',
            'title' => esc_html__('Show Page Breadcrumb', 'educatito'),
            'subtitle' => esc_html__('Show page breadcrumb in page title bar.', 'educatito'),
            'default' => true,
            'on' => 'Yes',
            'off' => 'No',
        ),
        array(
            'id' => 'jrb_page_title_color',
            'type' => 'color',
            'title' => esc_html__('Page Title Color', 'educatito'),
            'default' => '#ffffff',
        ),
        array(
            'id' => 'jrb_page_breadcrumb_color',
            'type' => 'color',
            'title' => esc_html__('Page Breadcrumb Color', 'educatito'),
            'default' => '#ffffff',
        ),
        array(
            'id' => 'jrb_page_title_bar_bg',
            'type' => 'background',
            'title' => esc_html__('Background', 'educatito'),
            'subtitle' => esc_html__('background with image, color, etc.', 'educatito'),
            'default' => array(
                'background-color' => '#1E1E1E',
                'background-image' => EDUCATITO_OPTION_URL . 'options/images/bg_title_bar.jpg',
                'background-repeat' => 'no-repeat',
                'background-size' => 'cover',
                'background-position' => 'center top',
            ),
            'output' => array('.page-title-bar'),
        ),
        array(
            'id' => 'jrb_page_title_bar_margin',
            'title' => esc_html__('Margin', 'educatito'),
            'subtitle' => esc_html__('Please, Enter margin of title bar.', 'educatito'),
            'type' => 'spacing',
            'mode' => 'margin',
            'units' => array('px', '%'),
            'output' => array('.page-title-bar'),
            'default' => array(
                'margin-top' => '0',
                'margin-right' => '0',
                'margin-bottom' => '90',
                'margin-left' => '0',
                'units' => 'px',
            )
        ),
        array(
            'id' => 'jrb_page_title_bar_padding',
            'title' => esc_html__('Padding', 'educatito'),
            'subtitle' => esc_html__('Please, Enter padding of title bar.', 'educatito'),
            'type' => 'spacing',
            'units' => array('px', '%'),
            'output' => array('.page-title-bar'),
            'default' => array(
                'padding-top' => '170px',
                'padding-right' => '0',
                'padding-bottom' => '177px',
                'padding-left' => '0',
                'units' => 'px',
            )
        ),
        array(
            'id' => 'jrb_page_breadcrumb_delimiter',
            'type' => 'text',
            'title' => esc_html__('Delimiter', 'educatito'),
            'subtitle' => esc_html__('Please, Enter Delimiter of page breadcrumb in title bar.', 'educatito'),
            'default' => '/'
        ),
    ),
);

/**
 * Blog
 */
$this->sections[] = array(
    'title' => esc_html__('Blog Options', 'educatito'),
    'icon' => 'fa fa-file-text-o',
);
$this->sections[] = array(
    'title' => esc_html__('Title Bar', 'educatito'),
    'desc' => '',
    'icon' => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'jrb_show_post_title_blog',
            'type' => 'switch',
            'title' => esc_html__('Show Post Title', 'educatito'),
            'subtitle' => esc_html__('Show post title in post title bar.', 'educatito'),
            'default' => true,
            'on' => 'Yes',
            'off' => 'No',
        ),
        array(
            'id' => 'jrb_show_post_breadcrumb_blog',
            'type' => 'switch',
            'title' => esc_html__('Show Post Breadcrumb', 'educatito'),
            'subtitle' => esc_html__('Show post breadcrumb in post title bar.', 'educatito'),
            'default' => true,
            'on' => 'Yes',
            'off' => 'No',
        ),
        array(
            'id' => 'jrb_blog_title_color',
            'type' => 'color',
            'title' => esc_html__('Page Title Color', 'educatito'),
            'default' => '#ffffff',
        ),
        array(
            'id' => 'jrb_blog_breadcrumb_color',
            'type' => 'color',
            'title' => esc_html__('Page Breadcrumb Color', 'educatito'),
            'default' => '#ffffff',
        ),
        array(
            'id' => 'jrb_blog_title_bar_bg',
            'type' => 'background',
            'title' => esc_html__('Background', 'educatito'),
            'subtitle' => esc_html__('background with image, color, etc.', 'educatito'),
            'default' => array(
                'background-color' => '#1e1e1e',
                'background-image' => EDUCATITO_OPTION_URL . 'options/images/bg_title_bar.jpg',
                'background-repeat' => 'no-repeat',
                'background-size' => 'cover',
                'background-position' => 'center top',
            ),
            'output' => array('.blog-title-bar'),
        ),
        array(
            'id' => 'jrb_blog_title_bar_margin',
            'title' => 'Margin',
            'subtitle' => esc_html__('Please, Enter margin of title bar.', 'educatito'),
            'type' => 'spacing',
            'mode' => 'margin',
            'units' => array('px', '%'),
            'output' => array('.blog-title-bar'),
            'default' => array(
                'margin-top' => '0',
                'margin-right' => '0',
                'margin-bottom' => '90',
                'margin-left' => '0',
                'units' => 'px',
            )
        ),
        array(
            'id' => 'jrb_blog_title_bar_padding',
            'title' => 'Padding',
            'subtitle' => esc_html__('Please, Enter padding of title bar.', 'educatito'),
            'type' => 'spacing',
            'units' => array('px', '%'),
            'output' => array('.blog-title-bar'),
            'default' => array(
                'padding-top' => '170px',
                'padding-right' => '0',
                'padding-bottom' => '177px',
                'padding-left' => '0',
                'units' => 'px',
            )
        ),
        array(
            'id' => 'jrb_blog_breadcrumb_delimiter',
            'type' => 'text',
            'title' => esc_html__('Delimiter', 'educatito'),
            'subtitle' => esc_html__('Please, Enter Delimiter of page breadcrumb in title bar.', 'educatito'),
            'default' => '/'
        ),
    )
);
$this->sections[] = array(
    'title' => esc_html__('Blog', 'educatito'),
    'icon' => '',
    'subsection' => true,
    'fields' => array(
        array(
            'desc' => esc_html__('You can either chose a predefined layout or build your own blog layout with the advanced layout editor', 'educatito'),
            'id' => 'jrb_blog_layout',
            'type' => 'image_select',
            'options' => array(
                'list-2' => EDUCATITO_OPTION_URL . 'assets/images/list-v2.jpg',
                'list' => EDUCATITO_OPTION_URL . 'assets/images/list.jpg',
                'grid-2-column' => EDUCATITO_OPTION_URL . 'assets/images/gird.jpg',
            ),
            'title' => esc_html__('Blog Layout', 'educatito'),
            'default' => 'list',
        ),
        array(
            'desc' => esc_html__('Previous/Next Pagination', 'educatito'),
            'id' => 'jrb_show_navigation_post',
            'on' => 'Yes',
            'off' => 'No',
            'type' => 'switch',
            'title' => esc_html__('Previous/Next Pagination', 'educatito'),
            'default' => 1,
        ),
    ),
);
$this->sections[] = array(
    'title' => esc_html__('Blog Detail', 'educatito'),
    'icon' => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'jrb_post_show_post_title',
            'type' => 'switch',
            'title' => esc_html__('Show Post Title', 'educatito'),
            'subtitle' => esc_html__('Show or not title of post on your single blog.', 'educatito'),
            'default' => false,
            'on' => 'Yes',
            'off' => 'No',
        ),
        array(
            'id' => 'jrb_post_show_social_share',
            'type' => 'switch',
            'title' => esc_html__('Show Social Share', 'educatito'),
            'subtitle' => esc_html__('Show or not social share of post on your single blog.', 'educatito'),
            'default' => true,
            'on' => 'Yes',
            'off' => 'No',
        ),
        array(
            'id' => 'jrb_post_show_post_info',
            'type' => 'switch',
            'title' => esc_html__('Show Post Info', 'educatito'),
            'subtitle' => esc_html__('Show or not info of post on your single blog.', 'educatito'),
            'default' => true,
            'on' => 'Yes',
            'off' => 'No',
        ),
        array(
            'id' => 'jrb_post_show_post_nav',
            'type' => 'switch',
            'title' => esc_html__('Show Post Navigation', 'educatito'),
            'subtitle' => esc_html__('Show or not post navigation on your single blog.', 'educatito'),
            'default' => true,
            'on' => 'Yes',
            'off' => 'No',
        ),
        array(
            'id' => 'jrb_post_show_post_tags',
            'type' => 'switch',
            'title' => esc_html__('Show Post Tags', 'educatito'),
            'subtitle' => esc_html__('Show or not post tags on your single blog.', 'educatito'),
            'default' => true,
            'on' => 'Yes',
            'off' => 'No',
        ),
        array(
            'id' => 'jrb_post_show_post_comment',
            'type' => 'switch',
            'title' => esc_html__('Show Post Comment', 'educatito'),
            'subtitle' => esc_html__('Show or not post comment on your single blog.', 'educatito'),
            'default' => true,
            'on' => 'Yes',
            'off' => 'No',
        ),
    ),
);
/**
  /*  Product Options */
if (class_exists('Woocommerce')) {
    $this->sections[] = array(
        'title' => esc_html__('Product Options', 'educatito'),
        'desc' => '',
        'icon' => 'fa fa-shopping-bag',
        'fields' => array(
        )
    );
    $this->sections[] = array(
        'title' => esc_html__('Title Bar', 'educatito'),
        'desc' => '',
        'icon' => '',
        'subsection' => true,
        'fields' => array(
            array(
                'id' => 'jrb_show_page_title_shop',
                'type' => 'switch',
                'title' => esc_html__('Show Page Title', 'educatito'),
                'subtitle' => esc_html__('Show page title in page title bar.', 'educatito'),
                'default' => true,
                'on' => 'Yes',
                'off' => 'No',
            ),
            array(
                'id' => 'jrb_show_page_breadcrumb_shop',
                'type' => 'switch',
                'title' => esc_html__('Show Page Breadcrumb', 'educatito'),
                'subtitle' => esc_html__('Show page breadcrumb in page title bar.', 'educatito'),
                'default' => true,
                'on' => 'Yes',
                'off' => 'No',
            ),
            array(
                'id' => 'jrb_shop_title_color',
                'type' => 'color',
                'title' => esc_html__('Page Title Color', 'educatito'),
                'default' => '#ffffff',
            ),
            array(
                'id' => 'jrb_shop_breadcrumb_color',
                'type' => 'color',
                'title' => esc_html__('Page Breadcrumb Color', 'educatito'),
                'default' => '#ffffff',
            ),
            array(
                'id' => 'jrb_product_title_bar_bg',
                'type' => 'background',
                'title' => esc_html__('Background', 'educatito'),
                'subtitle' => esc_html__('background with image, color, etc.', 'educatito'),
                'default' => array(
                    'background-color' => '#1E1E1E',
                    'background-image' => EDUCATITO_OPTION_URL . 'options/images/bg_title_bar.jpg',
                    'background-repeat' => 'no-repeat',
                    'background-size' => 'cover',
                    'background-position' => 'center top',
                ),
                'output' => array('.product-title-bar'),
            ),
            array(
                'id' => 'jrb_product_title_bar_margin',
                'title' => esc_html__('Margin', 'educatito'),
                'subtitle' => esc_html__('Please, Enter margin of title bar.', 'educatito'),
                'type' => 'spacing',
                'mode' => 'margin',
                'units' => array('px', '%'),
                'output' => array('.product-title-bar'),
                'default' => array(
                    'margin-top' => '0',
                    'margin-right' => '0',
                    'margin-bottom' => '90',
                    'margin-left' => '0',
                    'units' => 'px',
                )
            ),
            array(
                'id' => 'jrb_product_title_bar_padding',
                'title' => esc_html__('Padding', 'educatito'),
                'subtitle' => esc_html__('Please, Enter padding of title bar.', 'educatito'),
                'type' => 'spacing',
                'units' => array('px', '%'),
                'output' => array('.product-title-bar'),
                'default' => array(
                    'padding-top' => '170px',
                    'padding-right' => '0',
                    'padding-bottom' => '177px',
                    'padding-left' => '0',
                    'units' => 'px',
                )
            ),
            array(
                'id' => 'jrb_product_breadcrumb_delimiter',
                'type' => 'text',
                'title' => esc_html__('Delimiter', 'educatito'),
                'subtitle' => esc_html__('Please, Enter Delimiter of page breadcrumb in title bar.', 'educatito'),
                'default' => '/'
            ),
        )
    );
    $this->sections[] = array(
        'title' => esc_html__('Archive Products', 'educatito'),
        'icon' => '',
        'subsection' => true,
        'fields' => array(
            array(
                'desc' => esc_html__('Select a layout.', 'educatito'),
                'id' => 'jrb_woo_layout',
                'type' => 'image_select',
                'options' => array(
                    'full' => EDUCATITO_OPTION_URL . 'assets/images/no-sidebar.png',
                    'left' => EDUCATITO_OPTION_URL . 'assets/images/left-sidebar.png',
                    'right' => EDUCATITO_OPTION_URL . 'assets/images/right-sidebar.png',
                ),
                'default' => 'left',
                'title' => 'Layout',
            ),
//            array(
//                'id' => 'jrb_woo-view-mode',
//                'type' => 'button_set',
//                'title' => esc_html__('View Mode', 'educatito'),
//                'options' => array(
//                    'grid' => esc_html__('Grid', 'educatito'),
//                    'list' => esc_html__('List', 'educatito'),
//                ),
//                'default' => 'grid',
//            ),
            array(
                'id' => 'jrb_archive_show_catalog_ordering',
                'type' => 'switch',
                'title' => esc_html__('Show Catalog Ordering', 'educatito'),
                'subtitle' => esc_html__('Show catalog ordering in page archive products.', 'educatito'),
                'default' => true,
                'on' => 'Yes',
                'off' => 'No',
            ),
            array(
                'desc' => esc_html__('Insert the number of WooCommerce products displayed per page.', 'educatito'),
                'id' => 'jrb_products_per_page',
                'type' => 'text',
                'title' => esc_html__('Products per page', 'educatito'),
                'default' => '12',
            ),
            array(
                'id' => 'jrb_archive_show_title_product',
                'type' => 'switch',
                'title' => esc_html__('Show Product Title', 'educatito'),
                'subtitle' => esc_html__('Show product title in page archive products.', 'educatito'),
                'default' => true,
                'on' => 'Yes',
                'off' => 'No',
            ),
            array(
                'id' => 'jrb_archive_show_price_product',
                'type' => 'switch',
                'title' => esc_html__('Show Product Price', 'educatito'),
                'subtitle' => esc_html__('Show product price in page archive products.', 'educatito'),
                'default' => true,
                'on' => 'Yes',
                'off' => 'No',
            ),
            array(
                'id' => 'jrb_archive_show_sale_flash_product',
                'type' => 'switch',
                'title' => esc_html__('Show Product Sale Flash', 'educatito'),
                'subtitle' => esc_html__('Show product sale flash in page archive products.', 'educatito'),
                'default' => true,
                'on' => 'Yes',
                'off' => 'No',
            ),
            array(
                'id' => 'jrb_archive_show_add_to_cart_product',
                'type' => 'switch',
                'title' => esc_html__('Show Product Add To Cart', 'educatito'),
                'subtitle' => esc_html__('Show product add to cart in page archive products.', 'educatito'),
                'default' => true,
                'on' => 'Yes',
                'off' => 'No',
            ),
            array(
                'id' => 'jrb_archive_show_quick_view_product',
                'type' => 'switch',
                'title' => esc_html__('Show Product Quick view', 'educatito'),
                'subtitle' => esc_html__('Show product quick view in page archive products.', 'educatito'),
                'default' => true,
                'on' => 'Yes',
                'off' => 'No',
            ),
            array(
                'id' => 'jrb_archive_show_pagination_shop',
                'type' => 'switch',
                'title' => esc_html__('Show Pagination', 'educatito'),
                'subtitle' => esc_html__('Show pagination in page archive products.', 'educatito'),
                'default' => true,
                'on' => 'Yes',
                'off' => 'No',
            ),
        ),
    );

    $this->sections[] = array(
        'title' => esc_html__('Single Products', 'educatito'),
        'desc' => '',
        'icon' => '',
        'subsection' => true,
        'fields' => array(
            array(
                'desc' => esc_html__('Select a background pattern.', 'educatito'),
                'id' => 'jrb_woo_detail_layout',
                'type' => 'image_select',
                'options' => array(
                    'full' => EDUCATITO_OPTION_URL . 'assets/images/no-sidebar.png',
                    'left' => EDUCATITO_OPTION_URL . 'assets/images/left-sidebar.png',
                    'right' => EDUCATITO_OPTION_URL . 'assets/images/right-sidebar.png',
                ),
                'default' => 'right',
                'title' => esc_html__('Layout', 'educatito'),
            ),
            array(
                'id' => 'product-short-desc',
                'type' => 'switch',
                'title' => esc_html__('Show Short Description', 'educatito'),
                'default' => true,
                'on' => 'Yes',
                'off' => 'No',
                'default' => 1,
            ),
            array(
                'id' => 'product-related',
                'type' => 'switch',
                'title' => esc_html__('Show Related Products', 'educatito'),
                'default' => true,
                'on' => 'Yes',
                'off' => 'No',
                'default' => 1,
            ),
        ),
    );
}

/**
  /*  Courses Options */
$this->sections[] = array(
    'title' => esc_html__('Courses Options', 'educatito'),
    'desc' => '',
    'icon' => 'fa fa-graduation-cap',
    'fields' => array(
    )
);

$this->sections[] = array(
    'title' => esc_html__('Archive Courses', 'educatito'),
    'icon' => '',
    'subsection' => true,
    'fields' => array(
        array(
            'desc' => esc_html__('Select a background pattern.', 'educatito'),
            'id' => 'jrb_courses_layout',
            'type' => 'image_select',
            'options' => array(
                'full' => EDUCATITO_OPTION_URL . 'assets/images/no-sidebar.png',
                'left' => EDUCATITO_OPTION_URL . 'assets/images/left-sidebar.png',
                'right' => EDUCATITO_OPTION_URL . 'assets/images/right-sidebar.png',
            ),
            'default' => 'left',
            'title' => esc_html__('Layout', 'educatito'),
        ),
        array(
            'desc' => esc_html__('You can either chose a predefined layout or build your own Courses layout with the advanced layout editor', 'educatito'),
            'id' => 'jrb_courses_templates',
            'type' => 'image_select',
            'options' => array(
                'list' => EDUCATITO_OPTION_URL . 'assets/images/list.jpg',
                'grid' => EDUCATITO_OPTION_URL . 'assets/images/gird.jpg',
            ),
            'title' => esc_html__('Courses Layout', 'educatito'),
            'default' => 'grid',
        ),
        array(
            'id' => 'jrb_archive_courses_show_title',
            'type' => 'switch',
            'title' => esc_html__('Show Title', 'educatito'),
            'subtitle' => esc_html__('Show title in page archive courses.', 'educatito'),
            'default' => true,
            'on' => 'Yes',
            'off' => 'No',
        ),
        array(
            'id' => 'jrb_archive_courses_show_excerpt',
            'type' => 'switch',
            'title' => esc_html__('Show Excerpt', 'educatito'),
            'subtitle' => esc_html__('Show excerpt in page archive courses.', 'educatito'),
            'default' => true,
            'on' => 'Yes',
            'off' => 'No',
        ),
        array(
            'id' => 'jrb_archive_courses_show_pagination',
            'type' => 'switch',
            'title' => esc_html__('Show Pagination', 'educatito'),
            'subtitle' => esc_html__('Show pagination in page archive courses.', 'educatito'),
            'default' => true,
            'on' => 'Yes',
            'off' => 'No',
        ),
    ),
);

$this->sections[] = array(
    'title' => esc_html__('Single Courses', 'educatito'),
    'desc' => '',
    'icon' => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'jrb_courses_detail_show_title',
            'type' => 'switch',
            'title' => esc_html__('Show Title', 'educatito'),
            'subtitle' => esc_html__('Show Title detail in page single courses.', 'educatito'),
            'default' => true,
            'on' => 'Yes',
            'off' => 'No',
        ),
        array(
            'id' => 'jrb_courses_detail_show_info',
            'type' => 'switch',
            'title' => esc_html__('Show info', 'educatito'),
            'subtitle' => esc_html__('Show info detail in page single courses.', 'educatito'),
            'default' => true,
            'on' => 'Yes',
            'off' => 'No',
        ),
        array(
            'id' => 'jrb_courses_detail_show_thumbnail',
            'type' => 'switch',
            'title' => esc_html__('Show Thumbnail', 'educatito'),
            'subtitle' => esc_html__('Show thumbnail detail in page single courses.', 'educatito'),
            'default' => true,
            'on' => 'Yes',
            'off' => 'No',
        ),
        array(
            'id' => 'jrb_courses_detail_show_curriculum',
            'type' => 'switch',
            'title' => esc_html__('Show Curriculum', 'educatito'),
            'subtitle' => esc_html__('Show Curriculum detail in page single courses.', 'educatito'),
            'default' => true,
            'on' => 'Yes',
            'off' => 'No',
        ),
        array(
            'id' => 'jrb_courses_detail_show_review_rating',
            'type' => 'switch',
            'title' => esc_html__('Show Review and Rating', 'educatito'),
            'subtitle' => esc_html__('Show Review and Rating in page single courses.', 'educatito'),
            'default' => true,
            'on' => 'Yes',
            'off' => 'No',
        ),
        array(
            'id' => 'jrb_courses_detail_show_related',
            'type' => 'switch',
            'title' => esc_html__('Show Related', 'educatito'),
            'subtitle' => esc_html__('Show Related in page single courses.', 'educatito'),
            'default' => true,
            'on' => 'Yes',
            'off' => 'No',
        ),
        array(
            'id' => 'jrb_courses_detail_show_author',
            'type' => 'switch',
            'title' => esc_html__('Show Author', 'educatito'),
            'subtitle' => esc_html__('Show Author in page single courses.', 'educatito'),
            'default' => true,
            'on' => 'Yes',
            'off' => 'No',
        ),
    ),
);


/**
  /*  Event Options */
$this->sections[] = array(
    'title' => esc_html__('Event Options', 'educatito'),
    'desc' => '',
    'icon' => 'fa fa-pencil-square-o',
    'fields' => array(
    )
);

$this->sections[] = array(
    'title' => esc_html__('Archive Event', 'educatito'),
    'icon' => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'jrb_archive_event_show_date',
            'type' => 'switch',
            'title' => esc_html__('Show Date', 'educatito'),
            'subtitle' => esc_html__('Show Date in page archive event.', 'educatito'),
            'default' => true,
            'on' => 'Yes',
            'off' => 'No',
        ),
        array(
            'id' => 'jrb_archive_event_show_content',
            'type' => 'switch',
            'title' => esc_html__('Show content', 'educatito'),
            'subtitle' => esc_html__('Show content in page archive event.', 'educatito'),
            'default' => true,
            'on' => 'Yes',
            'off' => 'No',
        ),
        array(
            'id' => 'jrb_archive_event_show_image',
            'type' => 'switch',
            'title' => esc_html__('Show Image', 'educatito'),
            'subtitle' => esc_html__('Show Image in page archive event.', 'educatito'),
            'default' => true,
            'on' => 'Yes',
            'off' => 'No',
        ),
    ),
);

$this->sections[] = array(
    'title' => esc_html__('Single Event', 'educatito'),
    'desc' => '',
    'icon' => '',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'jrb_event_detail_show_title_detail',
            'type' => 'switch',
            'title' => esc_html__('Show title Detail', 'educatito'),
            'subtitle' => esc_html__('Show title detail in page single event.', 'educatito'),
            'default' => true,
            'on' => 'Yes',
            'off' => 'No',
        ),
        array(
            'id' => 'jrb_event_detail_show_image',
            'type' => 'switch',
            'title' => esc_html__('Show Image', 'educatito'),
            'subtitle' => esc_html__('Show Image in page single event.', 'educatito'),
            'default' => true,
            'on' => 'Yes',
            'off' => 'No',
        ),
        array(
            'id' => 'jrb_event_detail_show_countdown',
            'type' => 'switch',
            'title' => esc_html__('Show countdown', 'educatito'),
            'subtitle' => esc_html__('Show countdown in page single event.', 'educatito'),
            'default' => true,
            'on' => 'Yes',
            'off' => 'No',
        ),
        array(
            'id' => 'jrb_event_detail_show_content',
            'type' => 'switch',
            'title' => esc_html__('Show content', 'educatito'),
            'subtitle' => esc_html__('Show content in page single event.', 'educatito'),
            'default' => true,
            'on' => 'Yes',
            'off' => 'No',
        ),
        array(
            'id' => 'jrb_event_detail_show_social',
            'type' => 'switch',
            'title' => esc_html__('Show social', 'educatito'),
            'subtitle' => esc_html__('Show social in page single event.', 'educatito'),
            'default' => true,
            'on' => 'Yes',
            'off' => 'No',
        ),
        array(
            'id' => 'jrb_event_detail_show_maps',
            'type' => 'switch',
            'title' => esc_html__('Show Maps', 'educatito'),
            'subtitle' => esc_html__('Show Maps in page single event.', 'educatito'),
            'default' => true,
            'on' => 'Yes',
            'off' => 'No',
        ),
    ),
);


/**
 *
 * Social
 */
$this->sections[] = array(
    'title' => esc_html__('Social', 'educatito'),
    'icon' => 'fa fa-globe',
    'fields' => array(
        array(
            'desc' => esc_html__('[educatito_social_site] shortcode social of your site. If you want a show which social you need to enter URL in this. If empty is not show', 'educatito'),
            'id' => 'jrb_info_shortcode_social_site',
            'type' => 'info',
            'style' => 'info',
            'title' => esc_html__('Shortcode Social', 'educatito'),
        ),
        array(
            'desc' => esc_html__('Type your Facebook link here', 'educatito'),
            'id' => 'jrb_social_facebook',
            'type' => 'text',
            'title' => esc_html__('Facebook', 'educatito'),
            'default' => '#',
        ),
        array(
            'desc' => esc_html__('Type your Google + link here', 'educatito'),
            'id' => 'jrb_social_google',
            'type' => 'text',
            'title' => esc_html__('Google +', 'educatito'),
            'default' => '#',
        ),
        array(
            'desc' => esc_html__('Type your Twitter link here', 'educatito'),
            'id' => 'jrb_social_twitter',
            'type' => 'text',
            'title' => esc_html__('Twitter', 'educatito'),
            'default' => '#',
        ),
        array(
            'desc' => esc_html__('Type your LinkedIn link here', 'educatito'),
            'id' => 'jrb_social_linkedin',
            'type' => 'text',
            'title' => esc_html__('LinkedIn', 'educatito'),
        ),
        array(
            'desc' => esc_html__('Type your Pinterest link here', 'educatito'),
            'id' => 'jrb_social_pinterest',
            'type' => 'text',
            'title' => esc_html__('Pinterest', 'educatito'),
            'default' => '#',
        ),
        array(
            'desc' => esc_html__('Type your Instagram link here', 'educatito'),
            'id' => 'jrb_social_instagram',
            'type' => 'text',
            'title' => esc_html__('Instagram', 'educatito'),
        ),
        array(
            'desc' => esc_html__('Type your slack link here', 'educatito'),
            'id' => 'jrb_social_slack', 'type' => 'text',
            'title' => esc_html__('Slack', 'educatito'),
        ),
    ),
);
/* Admin Font */
$this->sections[] = array(
    'title' => esc_html__('Font', 'educatito'),
    'icon' => 'fa fa-font',
    'fields' => array(
        array(
            'id' => 'jrb_body_font_options',
            'type' => 'typography',
            'title' => esc_html__('Body Font', 'educatito'),
            'custom_fonts' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output' => array(
                'body'
            ),
            'units' => 'px',
            'default' => array(
                'color' => '#636363',
                'font-style' => 'normal',
                'font-weight' => '400',
                'font-family' => 'Roboto Slab',
                'custom_fonts' => true,
                'font-size' => '14px',
                'line-height' => '26px',
                'text-align' => ''
            ),
            'subtitle' => esc_html__('Typography option with each property can be called individually.', 'educatito')
        ),
        array(
            'id' => 'font_h1',
            'type' => 'typography',
            'title' => esc_html__('H1', 'educatito'),
            'custom_fonts' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output' => array('h1'),
            'units' => 'px',
            'default' => array(
                'color' => '#1a1a23',
                'font-style' => 'normal',
                'font-weight' => '900',
                'font-family' => 'Roboto Slab',
                'custom_fonts' => true,
                'font-size' => '42px',
                'line-height' => '48px',
                'text-align' => ''
            ),
        ),
        array(
            'id' => 'font_h2',
            'type' => 'typography',
            'title' => esc_html__('H2', 'educatito'),
            'custom_fonts' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output' => array('h2'),
            'units' => 'px',
            'default' => array(
                'color' => '#1a1a23',
                'font-style' => 'normal',
                'font-weight' => '700',
                'font-family' => 'Roboto Slab',
                'custom_fonts' => true,
                'font-size' => '36px',
                'line-height' => '42px',
                'text-align' => ''
            ),
        ),
        array(
            'id' => 'font_h3',
            'type' => 'typography',
            'title' => esc_html__('H3', 'educatito'),
            'custom_fonts' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output' => array('h3'),
            'units' => 'px',
            'default' => array(
                'color' => '#1a1a23',
                'font-style' => 'normal',
                'font-weight' => '700',
                'font-family' => 'Roboto Slab',
                'custom_fonts' => true,
                'font-size' => '24px',
                'line-height' => '30px',
                'text-align' => ''
            ),
        ),
        array(
            'id' => 'font_h4',
            'type' => 'typography',
            'title' => esc_html__('H4', 'educatito'),
            'custom_fonts' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output' => array('h4'),
            'units' => 'px',
            'default' => array(
                'color' => '#1a1a23',
                'font-style' => 'normal',
                'font-weight' => '400',
                'font-family' => 'Roboto Slab',
                'custom_fonts' => true,
                'font-size' => '18px',
                'line-height' => '24px',
                'text-align' => ''
            ),
        ),
        array(
            'id' => 'font_h5',
            'type' => 'typography',
            'title' => esc_html__('H5', 'educatito'),
            'custom_fonts' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output' => array('h5'),
            'units' => 'px',
            'default' => array(
                'color' => '#1a1a23',
                'font-style' => 'normal',
                'font-weight' => '400',
                'font-family' => 'Roboto Slab',
                'custom_fonts' => true,
                'font-size' => '16px',
                'line-height' => '22px',
                'text-align' => ''
            ),
        ),
        array(
            'id' => 'font_h6',
            'type' => 'typography',
            'title' => esc_html__('H6', 'educatito'),
            'custom_fonts' => true,
            'font-backup' => true,
            'all_styles' => true,
            'output' => array('h6'),
            'units' => 'px',
            'default' => array(
                'color' => '#1a1a23',
                'font-style' => 'normal',
                'font-weight' => '300',
                'font-family' => 'Roboto Slab',
                'custom_fonts' => true,
                'font-size' => '14px',
                'line-height' => '18px',
                'text-align' => ''
            ),
        )
    ),
);

/**
 * Custom Post Type
 */
$this->sections[] = array(
    'title' => esc_html__('Custom Post Type', 'educatito'),
    'icon' => 'fa fa-tags',
    'fields' => array(
        array(
            'id' => 'jrb_custom_post_type_info',
            'icon' => true,
            'type' => 'info',
            'raw' => sprintf(__('<h3>If you do not want to use any of these Types, you can disable it</h3>', 'educatito')),
        ),
        array(
            //'desc' => esc_html__('Testimonial', 'educatito'),
            'id' => 'jrb_enable_testimonial',
            'on' => 'Yes',
            'off' => 'No',
            'type' => 'switch',
            'title' => esc_html__('Testimonial', 'educatito'),
            'default' => 1,
        ),
        array(
            'id' => 'jrb_enable_portfolio',
            'on' => 'Yes',
            'off' => 'No',
            'type' => 'switch',
            'title' => esc_html__('Portfolio', 'educatito'),
            'default' => 1,
        ),
        array(
            //'desc' => esc_html__('Team', 'educatito'),
            'id' => 'jrb_enable_team',
            'on' => 'Yes',
            'off' => 'No',
            'type' => 'switch',
            'title' => esc_html__('Team', 'educatito'),
            'default' => 1,
        ),
    ),
);


$this->sections[] = array(
    'title' => esc_html__('Premium Plugins', 'educatito'),
    'icon' => 'fa fa-diamond',
    'fields' => array(
        array(
            'id' => 'jrb_premium_info',
            'icon' => true,
            'type' => 'info',
            'raw' => sprintf(__('<h3>

	Below plugins came bundled with a theme.
	The use of these plugins is limited to this theme only.

	Hovewer if you have purchased an extra single license on CodeCanyon for any of these plugins you can disable \'bundled\' option for plugin you have purchased.
	After that you can enter your plugin purchase code on plugin options page to get Premium Support from Plugin Author and Auto Updates.</h3>', 'educatito')),
        ),
        array(
            'desc' => esc_html__('Revolution Slider', 'educatito'),
            'id' => 'jrb_enable_rev',
            'on' => 'Yes',
            'off' => 'No',
            'type' => 'switch',
            'title' => esc_html__('Revolution Slider', 'educatito'),
            'default' => 1,
        ),
        array(
            'desc' => esc_html__('Visual Composer', 'educatito'),
            'id' => 'jrb_enable_visual_composer',
            'on' => 'Yes',
            'off' => 'No',
            'type' => 'switch',
            'title' => esc_html__('Visual Composer', 'educatito'),
            'default' => 1,
        ),
    ),
);


