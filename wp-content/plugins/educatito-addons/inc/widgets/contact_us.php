<?php
// Create Widget
add_action('widgets_init', 'register_contact_widget');

function register_contact_widget() {
    register_widget('Educatito_Contact_us_Widget');
}

/**
 * Create class Organian_Contact_us_Widget
 */
class Educatito_Contact_us_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
                'educatito_contact_widget', // Base ID  
                esc_html__('Contact US Header', 'educatito'), // Name  
                array(
            'classname' => 'contact-top-header educatito-widget-contact-header',
            'description' => esc_html__("Contact US widget for theme.", 'educatito'),
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
            'location_title' => 'Location',
            'location' => 'Thomas Nolan Kaszas, 5322 Otter Ln',
            'email_title' => 'Email',
            'email' => 'support@jrbthemes.com',
            'phone_title' => 'Phone Number',
            'phone' => '(+544) 111 999',
            'el_class' => '',
        );

        $instance = wp_parse_args((array) $instance, $default);
        $location_title = esc_attr($instance['location_title']);
        $location = esc_attr($instance['location']);
        $email_title = esc_attr($instance['email_title']);
        $email = esc_attr($instance['email']);
        $phone_title = esc_attr($instance['phone_title']);
        $phone = esc_attr($instance['phone']);
        $el_class = esc_attr($instance['el_class']);

        $randomclass_ana = rand(100, 10000);

        ob_start();
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('location_title'); ?>" style="display:block;"><?php echo esc_html__('Location Title', 'educatito'); ?></label> 
            <input class="widefat location_title" id="<?php echo $this->get_field_id('location_title'); ?>" name="<?php echo $this->get_field_name('location_title'); ?>" type="text" value="<?php echo esc_attr($location_title); ?>" />
            </br><i><?php echo esc_html__('Enter location title of your site.', 'educatito'); ?></i>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('location'); ?>" style="display:block;"><?php echo esc_html__('Location Content', 'educatito'); ?></label> 
            <input class="widefat location" id="<?php echo $this->get_field_id('location'); ?>" name="<?php echo $this->get_field_name('location'); ?>" type="text" value="<?php echo esc_attr($location); ?>" />
            </br><i><?php echo esc_html__('Enter location of your site.', 'educatito'); ?></i>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('email_title'); ?>" style="display:block;"><?php echo esc_html__('Email Title', 'educatito'); ?></label> 
            <input class="widefat email_title" id="<?php echo $this->get_field_id('email_title'); ?>" name="<?php echo $this->get_field_name('email_title'); ?>" type="text" value="<?php echo esc_attr($email_title); ?>" />
            </br><i><?php echo esc_html__('Enter email title of your site.', 'educatito'); ?></i>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('email'); ?>" style="display:block;"><?php echo esc_html__('Email Content', 'educatito'); ?></label> 
            <input class="widefat mail" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo esc_attr($email); ?>" />
            </br><i><?php echo esc_html__('Enter email of your site.', 'educatito'); ?></i>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('phone_title'); ?>" style="display:block;"><?php echo esc_html__('Phone Title', 'educatito'); ?></label> 
            <input class="widefat phone_title" id="<?php echo $this->get_field_id('phone_title'); ?>" name="<?php echo $this->get_field_name('phone_title'); ?>" type="text" value="<?php echo esc_attr($phone_title); ?>" />
            </br><i><?php echo esc_html__('Enter phone title of your site.', 'educatito'); ?></i>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('phone'); ?>" style="display:block;"><?php echo esc_html__('Phone Content', 'educatito'); ?></label> 
            <input class="widefat phone" id="<?php echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>" type="text" value="<?php echo esc_attr($phone); ?>" />
            </br><i><?php echo esc_html__('Enter phone of your site.', 'educatito'); ?></i>
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

        $instance['location_title'] = strip_tags($new_instance['location_title']);
        $instance['location'] = strip_tags($new_instance['location']);
        $instance['email_title'] = strip_tags($new_instance['email_title']);
        $instance['email'] = strip_tags($new_instance['email']);
        $instance['phone_title'] = strip_tags($new_instance['phone_title']);
        $instance['phone'] = strip_tags($new_instance['phone']);
        $instance['el_class'] = strip_tags($new_instance['el_class']);

        return $instance;
    }

    /**
     * Show widget
     */
    function widget($args, $instance) {
        extract($args);
        echo $before_widget;
        $location_title = $location = $email_title = $email = $phone_title = $phone = '';
        $location_title = esc_attr($instance['location_title']);
        $location = esc_attr($instance['location']);
        $email_title = esc_attr($instance['email_title']);
        $email = esc_attr($instance['email']);
        $phone_title = esc_attr($instance['phone_title']);
        $phone = esc_attr($instance['phone']);
        $el_class = esc_attr($instance['el_class']);
        ?>
        <div class="widget-contact <?php echo esc_attr($el_class); ?>">
            <ul>
                <?php if ((isset($email) && $email != '') || (isset($email_title) && $email_title != '')) { ?>
                    <li>
                        <div class="educatito-flex-box">
                            <div class="box educatito-hover-full-color-primary">
                                <div class="box-icon">
                                    <span class="fa fa-envelope"></span>
                                </div>
                                <div class="box-text">
                                    <?php if (isset($email_title) && $email_title != '') { ?>
                                        <h5><?php echo esc_attr($email_title); ?></h5>
                                    <?php } ?>
                                    <?php if (isset($email) && $email != '') { ?>
                                        <a href="mailto:<?php echo esc_attr($email); ?>"><p><?php echo esc_attr($email); ?></p></a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php
                }
                ?>
                <?php if ((isset($phone) && $phone != '') || (isset($phone_title) && $phone_title != '')) { ?>
                    <li>
                        <div class="educatito-flex-box">
                            <div class="box educatito-hover-full-color-primary">
                                <div class="box-icon">
                                    <span class="fa fa-phone"></span>
                                </div>
                                <div class="box-text">
                                    <?php if (isset($phone_title) && $phone_title != '') { ?>
                                        <h5><?php echo esc_attr($phone_title); ?></h5>
                                    <?php } ?>
                                    <?php if (isset($phone) && $phone != '') { ?>
                                        <p><?php echo esc_attr($phone); ?></p>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </li>
                <?php } ?>
                <?php if ((isset($location) && $location != '') || (isset($location_title) && $location_title != '')) { ?>
                    <li>
                        <div class="educatito-flex-box">
                            <div class="box educatito-hover-full-color-primary">
                                <div class="box-icon">
                                    <span class="fa fa-map-marker"></span>
                                </div>
                                <div class="box-text">
                                    <?php if (isset($location_title) && $location_title != '') { ?>
                                        <h5><?php echo esc_attr($location_title); ?></h5>
                                    <?php } ?>
                                    <?php if (isset($location) && $location != '') { ?>
                                        <p><?php echo esc_attr($location); ?></p>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <?php
        echo $after_widget;
    }

}
