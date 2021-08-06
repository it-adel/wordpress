<?php

class Educatito_StaticCss {

    public $scss;

    function __construct() {
        global $educatito_options;
        $this->scss = new scssc();
        $this->scss->setImportPaths(get_template_directory() . '/assets/scss/');
        $this->generate_file();
    }
    public function generate_file() {
        global $educatito_options, $wp_filesystem;
        if (!class_exists('WP_Filesystem')) {
            require_once(ABSPATH . 'wp-admin/includes/file.php');
        }
        WP_Filesystem();

        if (!empty($educatito_options) && !empty($wp_filesystem)) {
            $options_scss = get_template_directory() . '/assets/scss/_options.scss';
            $wp_filesystem->delete($options_scss);
            $wp_filesystem->put_contents($options_scss, $this->css_render(), FS_CHMOD_FILE); 
            $this->scss->setFormatter('scss_formatter_compressed');
            $css = $this->scss_render();
            $file = "style.css";
            $file = get_template_directory() . '/assets/css/' . $file;
            $wp_filesystem->delete($file);
            $wp_filesystem->put_contents($file, $css, FS_CHMOD_FILE); // Save it
        }
    }

    /**
     * scss compile
     */
    public function scss_render() {
        /* compile scss to css */
        return $this->scss->compile('@import "master.scss"');
    }

    /**
     * main css
     */
    public function css_render() {
        global $educatito_options;

        ob_start();
        if (!empty($educatito_options['jrb_primary_color'])) {
            echo '$primary-color:' . esc_attr($educatito_options['jrb_primary_color']) . ';';
        }
        if (!empty($educatito_options['jrb_link_color'])) {
            echo '$link-color:' . esc_attr($educatito_options['jrb_link_color']) . ';';
        }
        if (!empty($educatito_options['jrb_link_hover_color'])) {
            echo '$link-color-hover:' . esc_attr($educatito_options['jrb_link_hover_color']) . ';';
        }
        if (!empty($educatito_options['jrb_button_text_color'])) {
            echo '$button-primary:' . esc_attr($educatito_options['jrb_button_text_color']) . ';';
        }
         if (!empty($educatito_options['background_page_loader']['background-color'])) {
            echo '$bg-loadpage:' . esc_attr($educatito_options['background_page_loader']['background-color']) . ';';
        }else{
             echo '$bg-loadpage: #fff;';
        }
        if (isset($educatito_options['jrb_menu_uppercase']) && $educatito_options['jrb_menu_uppercase'] == 1) {
            echo '$header-transform: uppercase;';
        }else{
            echo '$header-transform: none;';
        }
        if (!empty($educatito_options['jrb_menu_fontsize'])) {
            echo '$header-font-size:' . esc_attr($educatito_options['jrb_menu_fontsize']) . ';';
        }else{
            echo '$header-font-size: 14px;';
        }
        if (!empty($educatito_options['jrb_menu_color'])) {
            echo '$color-menu:' . esc_attr($educatito_options['jrb_menu_color']) . ';';
        }
        if (!empty($educatito_options['jrb_menu_hover_color'])) {
            echo '$color-hover-menu:' . esc_attr($educatito_options['jrb_menu_hover_color']) . ';';
        }
        if (!empty($educatito_options['jrb_menu_background_hover_color'])) {
            echo '$color-hover-background-menu:' . esc_attr($educatito_options['jrb_menu_background_hover_color']) . ';';
        }else{
            echo '$color-hover-background-menu: transparent;';
        }
        if (!empty($educatito_options['jrb_menu_acti_color'])) {
            echo '$color-active-menu:' . esc_attr($educatito_options['jrb_menu_acti_color']) . ';';
        }
        if (!empty($educatito_options['jrb_menu_background_acti_color'])) {
            echo '$color-active-background-menu:' . esc_attr($educatito_options['jrb_menu_background_acti_color']) . ';';
        }else{
            echo '$color-active-background-menu: transparent;';
        }
        if (!empty($educatito_options['jrb_submenu_color'])) {
            echo '$color-submenu:' . esc_attr($educatito_options['jrb_submenu_color']) . ';';
        }
        if (!empty($educatito_options['jrb_background_submenu'])) {
            echo '$submenu-background:' . esc_attr($educatito_options['jrb_background_submenu']) . ';';
        }
        if (!empty($educatito_options['jrb_sub_menu_acti_color'])) {
            echo '$color-active-submenu:' . esc_attr($educatito_options['jrb_sub_menu_acti_color']) . ';';
        }
        if (!empty($educatito_options['jrb_sub_menu_hover_color'])) {
            echo '$color-hover-submenu:' . esc_attr($educatito_options['jrb_sub_menu_hover_color']) . ';';
        }
        if (!empty($educatito_options['jrb_sub_menu_backgound_hover_color'])) {
            echo '$color-hover-background-submenu:' . esc_attr($educatito_options['jrb_sub_menu_backgound_hover_color']) . ';';
        }else{
            echo '$color-hover-background-submenu: transparent;';
        }
        if (!empty($educatito_options['jrb_sub_menu_backgound_acti_color'])) {
            echo '$color-active-background-submenu:' . esc_attr($educatito_options['jrb_sub_menu_backgound_acti_color']) . ';';
        }else{
            echo '$color-active-background-submenu: transparent;';
        } 

        return ob_get_clean();
    }

}

new Educatito_StaticCss();
