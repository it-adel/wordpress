<?php
/**
 * Shortcode Contact US.
 *
 * @package Educatito
 * @author JRB Themes
 * @link http://educa.jrbthemes.com
 */
/* -------------------Contact US---------------------- */
if (!function_exists('educatito_contact_us_template')):

    function educatito_contact_us_template($attr) {
        global $educatito_options;
        ob_start();
        extract(shortcode_atts(array(
            'phone' => '',
            'location' => '',
            'email' => '',
            'location2' => '',
            'el_class' => '',
                        ), $attr));

        $rand_grid = rand(5, 1231564613);
        $id_contact_us = md5(time() . ' ' . $rand_grid);
        ?>
        <!-- BEGIN BLOCK OUR CLIENTS -->
        <div id="<?php echo "educatito_contact_us_" . esc_attr($id_contact_us); ?>" class="educatito-contact_us <?php echo esc_attr($el_class); ?>">
            <h3><?php echo esc_html__('Contact', 'educatito'); ?></h3>
            <ul>
                <?php if ($location != '') { ?>
                    <li>
                        <div class="educatito-flex-box">
                            <h4 class="title"><?php echo esc_html__('Adrress 1 :', 'educatito'); ?></h4>
                            <p><?php echo esc_attr($location); ?></p>
                        </div>
                    </li>
                <?php } ?>
                <?php if ($location2 != '') { ?>
                    <li>
                        <div class="educatito-flex-box">
                            <h4 class="title"><?php echo esc_html__('Adrress 2 :', 'educatito'); ?></h4>
                            <p><?php echo esc_attr($location2); ?></p>
                        </div>
                    </li>
                <?php } ?>
            </ul>
            <?php if ($phone != '') { ?>
                <div class="phone">
                        <h4 class="title"><?php echo esc_html__('Call directly:', 'educatito'); ?></h4>
                        <p><?php echo esc_attr($phone); ?></p>
                </div>
            <?php } ?>
            <div class="contact_to">
                    <h4 class="title"><?php echo esc_html__('Connect to', 'educatito'); ?></h4>
                    <?php echo do_shortcode('[educatito_social_site]'); ?>
            </div>
            <?php if ($email != '') { ?>
                <div class="email">
                    <div class="educatito-flex-box">
                        <a href="#"><p><?php echo esc_attr($email); ?></p></a>
                    </div>
                </div>
            <?php } ?>
        </div>
        <!-- END BEGIN BLOCK OUR CLIENTS -->
        <?php
        return ob_get_clean();
    }

endif;

if (!function_exists('educatito_contact_us_admin')) {
    add_action('vc_before_init', 'educatito_contact_us_admin');

    function educatito_contact_us_admin() {
        vc_map(array(
            'name' => esc_html__('Contact us', 'educatito'),
            'base' => 'educatito_contact_us',
            'icon' => get_template_directory_uri() . "/assets/images/icon/educatito-icon.png",
            'category' => esc_html__('JRB Themes', 'educatito'),
            'description' => esc_html__('Contact us for theme.', 'educatito'),
            'params' => array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Phone Number', 'educatito'),
                    'param_name' => 'phone',
                    'description' => esc_html__('', 'educatito'),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Location', 'educatito'),
                    'param_name' => 'location',
                    'description' => esc_html__('', 'educatito'),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Location 2', 'educatito'),
                    'param_name' => 'location2',
                    'description' => esc_html__('', 'educatito'),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Email', 'educatito'),
                    'param_name' => 'email',
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
    