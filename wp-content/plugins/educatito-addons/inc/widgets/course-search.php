<?php
// Create Widget
add_action('widgets_init', 'register_course_search_widget');

function register_course_search_widget() {
    register_widget('Educatito_Course_Search_Widget');
}

/**
 * Create class
 */
class Educatito_Course_Search_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
                'educatito_course_search_widget', // Base ID  
                esc_html__('Course Search', 'educatito'), // Name  
                array(
            'classname' => 'course-search educatito-widget-course-search widget_search',
            'description' => esc_html__("Display a list of your most courses search on your site.", 'educatito'),
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
            'title' => '',
            'el_class' => '',
        );

        $instance = wp_parse_args((array) $instance, $default);
        $title = esc_attr($instance['title']);
        $el_class = esc_attr($instance['el_class']);

        $randomclass_ana = rand(100, 10000);

        ob_start();
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>" style="display:block;"><?php echo esc_html__('Title:', 'educatito'); ?></label> 
            <input class="widefat about-title" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
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
        $el_class = esc_attr($instance['el_class']);
        ?> 
        <?php if (isset($title) && $title != '') { ?>
            <h4><?php echo esc_attr($title); ?></h4>
        <?php } ?>
        <form method="get" name="search-course" class="learn-press-search-course-form searchform <?php echo esc_attr($title); ?>">
            <input type="text" name="s" class="search-course-input" value="" placeholder="<?php esc_html_e('Search courses name', 'educatito'); ?>" />
            <input type="hidden" name="ref" value="course" />
            <button class="search-course-button educatito-btn-search educatito_button"><i class="uk-icon-search"></i></button>
        </form>          
        <?php
        wp_reset_postdata();
        echo $after_widget;
    }

}
