<?php
// Create Widget
add_action('widgets_init', 'register_course_categories_widget');

function register_course_categories_widget() {
    register_widget('Educatito_Course_Categories_Widget');
}

/**
 * Create class
 */
class Educatito_Course_Categories_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
                'educatito_course_categories_widget', // Base ID  
                esc_html__('Course Categories', 'educatito'), // Name  
                array(
            'classname' => 'course-categories educatito-widget-course-categories',
            'description' => esc_html__("Display a list of your most courses categories on your site.", 'educatito'),
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
            'title' => 'All Courses',
            'number' => '10',
            'el_class' => '',
        );

        $instance = wp_parse_args((array) $instance, $default);
        $title = esc_attr($instance['title']);
        $number = esc_attr($instance['number']);
        $el_class = esc_attr($instance['el_class']);

        $randomclass_ana = rand(100, 10000);

        ob_start();
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>" style="display:block;"><?php echo esc_html__('Title:', 'educatito'); ?></label> 
            <input class="widefat about-title" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('number'); ?>" style="display:block;"><?php echo esc_html__('Limit categories:', 'educatito'); ?></label> 
            <input class="widefat about-title" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo esc_attr($number); ?>" />
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
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['number'] = strip_tags($new_instance['number']);
        $instance['el_class'] = strip_tags($new_instance['el_class']);

        return $instance;
    }

    /**
     * Show widget
     */
    function widget($args, $instance) {
        extract($args);
        echo $before_widget;
        $title = $el_class = $number = '';
        $title = esc_attr($instance['title']);
        $number = esc_attr($instance['number']);
        $el_class = esc_attr($instance['el_class']);
        $args_cat = array(
            'show_count' => $number,
            'number' => $number,
            'hierarchical' => false,
            'taxonomy' => 'course_category',
            'title_li' => '',
        );
        ?>          
        <h4><?php echo esc_attr($title); ?></h4>
        <ol>
            <?php wp_list_categories($args_cat); ?> 
        </ol>         
        <?php
                //var_dump(wp_list_categories($args_cat));
        wp_reset_postdata();
        echo $after_widget;
    }

}
