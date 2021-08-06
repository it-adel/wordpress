<?php

/**
 * options
 * 
 * @author Educatito
 * @since 1.0.0
 */
class EducatitoOptions {

    public function __construct() {
        add_action('admin_enqueue_scripts', array($this, 'admin_script_loader'));
    }

    /* add script */

    function admin_script_loader() {
        wp_enqueue_style('educatito-option-css', EDUCATITO_OPTION_URL . 'options/css/option.css');
        wp_enqueue_style('font-awesome-option', EDUCATITO_OPTION_URL . 'options/css/font-awesome.min.css');
      //  wp_enqueue_script('educatito-option-js', EDUCATITO_OPTION_URL . 'assets/js/option.js', false, 'all');
    }

}

new EducatitoOptions();

