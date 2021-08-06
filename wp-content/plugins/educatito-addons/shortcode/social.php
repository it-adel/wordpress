<?php
/**
 * Shortcode Social.
 *
 * @package Educatito
 * @author JRB Themes
 * @link http://educa.jrbthemes.com
 */
/* -------------------Social---------------------- */
if (!function_exists('educatito_social_template')):

    function educatito_social_template($attr) {
        global $educatito_options;
        ob_start();
        extract(shortcode_atts(array(
            'google' => '',
            'twitter' => '',
            'linkedin' => '',
            'pinterest' => '',
            'facebook' => '',
            'instagram' => '',
            'el_class' => '',
                        ), $attr));

        $rand_grid = rand(5, 1231564613);
        $id_social = md5(time() . ' ' . $rand_grid);
        ?>
        <!-- BEGIN BLOCK OUR SOCIAL -->
        <ul class="social <?php echo esc_attr($el_class); ?>">
            <?php if ($google != '') { ?>
            <li><a href="<?php echo esc_attr($google); ?>"><span class="uk-icon uk-icon-google"></span></a></li>
            <?php } ?>
            <?php if ($twitter != '') { ?>
                <li><a href="<?php echo esc_attr($twitter); ?>"><span class="uk-icon uk-icon-twitter"></span></a></li>
            <?php } ?>
            <?php if ($linkedin != '') { ?>
                <li><a href="<?php echo esc_attr($linkedin); ?>"><span class="uk-icon uk-icon-linkedin"></span></a></li>
            <?php } ?>
            <?php if ($pinterest != '') { ?>
                <li><a href="<?php echo esc_attr($pinterest); ?>"><span class="uk-icon uk-icon-pinterest-p"></span></a></li>
            <?php } ?>
            <?php if ($facebook != '') { ?>
                <li><a href="<?php echo esc_attr($facebook); ?>"><span class="uk-icon uk-icon-facebook"></span></a></li>
                    <?php } ?>
            <?php if ($instagram != '') { ?>
                <li><a href="<?php echo esc_attr($instagram); ?>"><span class="uk-icon uk-icon-instagram"></span></a></li>
                    <?php } ?>
        </ul>
        <!-- END BEGIN BLOCK OUR SOCIAL -->
        <?php
        return ob_get_clean();
    }

endif;

if (!function_exists('educatito_social_admin')) {
    add_action('vc_before_init', 'educatito_social_admin');

    function educatito_social_admin() {
        vc_map(array(
            'name' => esc_html__('Social', 'educatito'),
            'base' => 'educatito_social',
            'icon' => get_template_directory_uri() . "/assets/images/icon/educatito-icon.png",
            'category' => esc_html__('JRB Themes', 'educatito'),
            'description' => esc_html__('Social for theme.', 'educatito'),
            'params' => array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Google +', 'educatito'),
                    'param_name' => 'google',
                    'description' => esc_html__('', 'educatito'),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Twitter', 'educatito'),
                    'param_name' => 'twitter',
                    'description' => esc_html__('', 'educatito'),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Skype', 'educatito'),
                    'param_name' => 'linkedin',
                    'description' => esc_html__('', 'educatito'),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Pinterest', 'educatito'),
                    'param_name' => 'pinterest',
                    'description' => esc_html__('', 'educatito'),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Facebook', 'educatito'),
                    'param_name' => 'facebook',
                    'description' => esc_html__('', 'educatito'),
                ),
                 array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Instagram', 'educatito'),
                    'param_name' => 'instagram',
                    'description' => esc_html__('', 'educatito'),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Extra class name', 'educatito'),
                    'param_name' => 'el_class',
                    'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'educatito'),
                ),
            )
        ));
    }

}
    