<?php
// Create Widget
add_action('widgets_init', 'register_contact_widget_footer_template');

function register_contact_widget_footer_template() {
    register_widget('Educatito_Contact_us_Widget_footer_template');
}

/**
 * Create class Organian_Contact_us_Widget
 */
class Educatito_Contact_us_Widget_footer_template extends WP_Widget {

    function __construct() {
        parent::__construct(
                'educa_contact_widget_footer_template', // Base ID  
                esc_html__('Contact US Footer', 'educatito'), // Name  
                array(
            'classname' => 'contact-bottom-footer educatito-widget-contact-footer',
            'description' => esc_html__("Contact US Footer widget for theme.", 'educatito'),
                )
        );
    }

// end constructor 

    /**
     * create form option for widget
     */
    function form($instance) {
        parent::form($instance);

        $default = array(
            'template' => 'v1',
            'phone' => '(+88) 111 555 666',
            'location' => '155th West, 43rd Stress, New York',
            'email' => 'Educatitosupport@info.com',
            'el_class' => '',
        );

        $instance = wp_parse_args((array) $instance, $default);
        $template = esc_attr($instance['template']);
        $location = esc_attr($instance['location']);
        $email = esc_attr($instance['email']);
        $phone = esc_attr($instance['phone']);
        $el_class = esc_attr($instance['el_class']);

        $randomclass_ana = rand(100, 10000);
        ob_start();
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('template'); ?>" style="display:block;"><?php echo esc_html__('Template', 'educatito'); ?></label> 
            <select class="widefat mail"  id="<?php echo $this->get_field_id('template'); ?>" name="<?php echo $this->get_field_name('template'); ?>">
                <option value="v1" <?php if($template == 'v1'){echo 'selected="selected"';}?>><?php echo esc_html__('Template 1', 'educatito') ?></option>
                <option value="v2" <?php if($template == 'v2'){echo 'selected="selected"';}?>><?php echo esc_html__('Template 2', 'educatito') ?></option>
            </select>
            </br><i><?php echo esc_html__('Template of your site.', 'educatito'); ?></i>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('phone'); ?>" style="display:block;"><?php echo esc_html__('Phone', 'educatito'); ?></label> 
            <input class="widefat phone" id="<?php echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>" type="text" value="<?php echo esc_attr($phone); ?>" />
            </br><i><?php echo esc_html__('Enter phone of your site.', 'educatito'); ?></i>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('location'); ?>" style="display:block;"><?php echo esc_html__('Location', 'educatito'); ?></label> 
            <input class="widefat location" id="<?php echo $this->get_field_id('location'); ?>" name="<?php echo $this->get_field_name('location'); ?>" type="text" value="<?php echo esc_attr($location); ?>" />
            </br><i><?php echo esc_html__('Enter location of your site.', 'educatito'); ?></i>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('email'); ?>" style="display:block;"><?php echo esc_html__('Email', 'educatito'); ?></label> 
            <input class="widefat mail" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo esc_attr($email); ?>" />
            </br><i><?php echo esc_html__('Enter email of your site.', 'educatito'); ?></i>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('el_class'); ?>" style="display:block;"><?php echo esc_html__('Class', 'educatito'); ?></label> 
            <input class="widefat el_class" id="<?php echo $this->get_field_id('el_class'); ?>" name="<?php echo $this->get_field_name('el_class'); ?>" type="text" value="<?php echo esc_attr($el_class); ?>" />
        </p>

        <?php
        $content_wid = ob_get_contents();
        ob_clean();
        ob_end_flush();
        echo $content_wid;
    }

    /**
     * save widget form
     */
    function update($new_instance, $old_instance) {
        parent::update($new_instance, $old_instance);

        $instance = $old_instance;
        $instance['template'] = strip_tags($new_instance['template']);
        $instance['phone'] = strip_tags($new_instance['phone']);
        $instance['location'] = strip_tags($new_instance['location']);
        $instance['email'] = strip_tags($new_instance['email']);
        $instance['el_class'] = strip_tags($new_instance['el_class']);

        return $instance;
    }

    /**
     * Show widget
     */
    function widget($args, $instance) {
        extract($args);
        echo $before_widget;
        $location = $email = $phone = $template = '';
        $template = esc_attr($instance['template']);
        $phone = esc_attr($instance['phone']);
        $location = esc_attr($instance['location']);
        $email = esc_attr($instance['email']);
        $el_class = esc_attr($instance['el_class']);
        ?>
        <div class="widget-contact-footer <?php echo esc_attr($el_class); ?>">
            <div class="textwidget">
                <?php if ($template == 'v1') { ?>
                    <p class="note"><?php echo esc_html('Education Group', 'educatito') ?></p>
                    <ul class="contact">
                        <?php if (isset($location) && $location != '') { ?>
                            <li>
                                <span class="fa fa-map-marker"></span>
                                <p><?php echo esc_attr($location); ?></p>
                            </li>
                        <?php } ?>
                        <?php if (isset($email) && $email != '') { ?>
                            <li>
                                <a href="mailto:<?php echo esc_attr($email); ?>">
                                    <span class="fa fa-envelope"></span>
                                    <p class="educatito-hover-color-orange"><?php echo esc_attr($email); ?></p>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                    <p class="note"><?php echo esc_html('Call directly', 'educatito') ?></p>
                    <?php if (isset($phone) && $phone != '') { ?>
                        <div class="phone">
                            <?php echo esc_attr($phone); ?>
                        </div>
                        <?php
                    }
                } else {
                    ?>
                    <ul class="contact">
                        <?php if (isset($location) && $location != '') { ?>
                            <li>
                                <span class="ion-android-pin"></span>
                                <p><?php echo esc_attr($location); ?></p>
                            </li>
                        <?php } ?>
                        <?php if (isset($phone) && $phone != '') { ?>
                            <li>
                                <span class="ion-ios-telephone"></span>
                                <p><?php echo esc_attr($phone); ?></p>
                            </li>
                        <?php } ?>
                        <?php if (isset($email) && $email != '') { ?>
                            <li>
                                <a href="mailto:<?php echo esc_attr($email); ?>">
                                    <span class="ion-android-drafts"></span>
                                    <p class="educatito-hover-color-orange"><?php echo esc_attr($email); ?></p>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                <?php } ?>
            </div>
        </div>
        <?php
        echo $after_widget;
    }

}
