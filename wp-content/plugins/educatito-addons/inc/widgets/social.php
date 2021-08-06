<?php
// Create Widget
add_action('widgets_init', 'register_social_widget');

function register_social_widget() {
    register_widget('Educatito_Social_Widget');
}

/**
 * Create class Organian_Social_Widget
 */
class Educatito_Social_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
                'educatito_social_widget', // Base ID  
                esc_html__('Social', 'educatito'), // Name  
                array(
            'classname' => 'social-footer educatito-widget-social-list',
            'description' => esc_html__("Social widget for theme.", 'educatito'),
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
            'margin' => '0',
            'el_class' => '',
        );

        $instance = wp_parse_args((array) $instance, $default);
        $margin = esc_attr($instance['margin']);
        $el_class = esc_attr($instance['el_class']);

        $randomclass_ana = rand(100, 10000);

        ob_start();
        ?>

        <p>
            <label for="<?php echo $this->get_field_id('margin'); ?>" style="display:block;"><?php echo esc_html__('Margin Bottom', 'educatito'); ?></label> 
            <input class="widefat margin" id="<?php echo $this->get_field_id('margin'); ?>" name="<?php echo $this->get_field_name('margin'); ?>" type="text" value="<?php echo esc_attr($margin); ?>" />
            </br><i><?php echo esc_html__('Examples: 25px, 15px 0, 5px 10px 5px 15px, 10%...', 'educatito'); ?></i>
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

        $instance['margin'] = strip_tags($new_instance['margin']);
        $instance['el_class'] = strip_tags($new_instance['el_class']);

        return $instance;
    }

    /**
     * Show widget
     */
    function widget($args, $instance) {
        extract($args);
        echo $before_widget;
        $style = '';

        if ($instance['margin'] != '') {
            $style .= 'margin:' . $instance['margin'] . ';';
        }
        $el_class = esc_attr($instance['el_class']);

            ?>
            <div class="widget-social <?php echo esc_attr($el_class); ?>" style="<?php echo esc_attr($style); ?>">
                <?php echo do_shortcode('[educatito_social_site]'); ?>
            </div>
            <?php
        echo $after_widget;
    }

}
