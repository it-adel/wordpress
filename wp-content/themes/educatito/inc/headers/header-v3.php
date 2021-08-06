<?php
/* * *****************************************************************************
 * Template Header V3.
 *
 * @package Educatito
 * @author JRBthemes
 * @link http://educa.jrbthemes.com
 * **************************************************************************** */

global $educatito_options;
?>
<header class="header-v3" <?php if (isset($educatito_options['jrb_header_sticky']) && $educatito_options['jrb_header_sticky'] == 1) {
    ?>
            data-uk-sticky="{top: -500, animation: 'uk-animation-slide-top'}"
        <?php }
        ?>>
    <div class="header-top">
        <div class="uk-container uk-container-center">
            <div class="uk-grid">
                <div class="uk-width-medium-1-2 uk-width-small-1-2 uk-width-1-1 educatito-welcome">
                    <ul class="address-phone">
                        <?php if (isset($educatito_options['jrb_info_header_address']) && $educatito_options['jrb_info_header_address'] != '') { ?>
                            <li class="address">
                                <span class="ion-ios-location"></span> <?php echo esc_attr($educatito_options['jrb_info_header_address']); ?>
                            </li>
                        <?php } ?>
                        <?php if (isset($educatito_options['jrb_info_header_phone']) && $educatito_options['jrb_info_header_phone'] != '') { ?>
                            <li class="phone">
                                <span class="ion-ios-telephone"></span> <?php echo esc_attr($educatito_options['jrb_info_header_phone']); ?>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="uk-width-medium-1-2 uk-width-small-1-2 uk-width-1-1 login-cart">
                    <?php if (isset($educatito_options['jrb_login_woo']) && $educatito_options['jrb_login_woo'] == 1) { ?>
                        <?php if (is_user_logged_in()) { ?>
                            <div class="uk-button-dropdown login" data-uk-dropdown="{pos:'bottom-left',mode:'click'}">
                                <a href="javascript:void(0)" class="uk-button"><i class="ion-person"></i><?php echo esc_html__('Account', 'educatito') ?></a>
                                <div class="uk-dropdown uk-dropdown-bottom">
                                    <?php educatito_show_login() ?>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="login">
                                <a class="popup-with-form button-login" href="#login-form"><?php echo esc_html__('Register Or Login', 'educatito'); ?></a>
                            </div>
                            <?php
                        }
                    }
                    ?>
                    <div class="cart-v3">
                        <?php
                        if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))):
                            if (function_exists('is_woocommerce')) {
                                do_action('educatito_woo_menu2');
                            }
                        endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header uk-clearfix">
        <div class="uk-container uk-container-center">
            <div class="header-center">
                <div class="logo educatito-flex-box educatito-flex-box-ai-center">
                    <?php educatito_show_logo(); ?>
                </div>
                <div class="menu-login-flex">
                    <div class="login-register">
                        <?php if (isset($educatito_options['jrb_display_button_header']) && $educatito_options['jrb_display_button_header'] == 1) { ?>
                            <a class="button-header hover-button" href="<?php
                            if (isset($educatito_options['jrb_link_button_header']) && $educatito_options['jrb_link_button_header'] != '') {
                                echo esc_attr($educatito_options['jrb_link_button_header']);
                            }
                            ?>">
                                   <?php
                                   if (isset($educatito_options['jrb_text_button_header']) && $educatito_options['jrb_text_button_header'] != '') {
                                       echo esc_attr($educatito_options['jrb_text_button_header']);
                                   }
                                   ?>
                                <span class="fa fa-pencil"></span>
                            </a>
                        <?php } ?>
                    </div>
                    <div class="main-menu educatito-flex-box educatito-flex-box-jc-end">
                        <?php
                        if (has_nav_menu('educatito-main-menu')) {
                            ?>
                            <ul id="nav" class="menu-primary">
                                <?php educatito_menu('educatito-main-menu'); ?>
                            </ul>
                            <?php
                        } else {
                            ?>
                            <div class="default-menu">
                                <a class="create-menu" href="<?php echo esc_url(home_url('/')) . 'wp-admin/nav-menus.php?action=locations'; ?>"><span><?php esc_html_e('Create a menu', 'educatito'); ?></span></a>
                            </div> 
                            <?php
                        }
                        ?>
                        <div class="menu-bars-mobi open">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="menu-mobi">
        <nav class="nav-holder">
            <?php
            if (has_nav_menu('educatito-main-menu')) {
                ?>
                <ul>
                    <?php educatito_menu('educatito-main-menu'); ?>
                </ul>
                <?php
            } else {
                ?>
                <div class="default-menu-mobile">
                    <a class="create-menu" href="<?php echo esc_url(home_url('/')) . 'wp-admin/nav-menus.php?action=locations'; ?>"><span><?php esc_html_e('Create a menu', 'educatito'); ?></span></a>
                </div> 
                <?php
            }
            ?>
        </nav>
    </div>
</header>