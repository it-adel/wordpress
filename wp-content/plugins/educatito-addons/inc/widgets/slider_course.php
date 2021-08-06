<?php
// Create Widget
add_action('widgets_init', 'register_slider_course_widget');

function register_slider_course_widget() {
    register_widget('Educatito_Slider_Course_Widget');
}

/**
 * Create class
 */
class Educatito_Slider_Course_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
                'educatito_slider_course_widget', // Base ID  
                esc_html__('Slider Course', 'educatito'), // Name  
                array(
            'classname' => 'slider-course-widget educatito-widget-slider-course',
            'description' => esc_html__("Display a list of your most slider course on your site.", 'educatito'),
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
            'title' => 'Slider Course',
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
        $title = $el_class = '';

        $title = esc_attr($instance['title']);
        $posts_per_page = $posts_per_page > 0 ? $posts_per_page : -1;
        $el_class = esc_attr($instance['el_class']);

        $query_args = array(
            'post_type' => 'lp_course',
            'post_status' => 'publish',
            'posts_per_page' => $posts_per_page,
            'no_found_rows' => 1,
            'orderby' => 'date',
            'order' => 'DESC',
        );

        $the_query_couses_1 = new WP_Query($query_args);
        if ($the_query_couses_1->have_posts()) :
            ?>
            <h4 class="title"><?php echo esc_attr($title); ?></h4>
            <ul class="slider-course">
                <?php
                if ($the_query_couses_1->have_posts()) :
                    while ($the_query_couses_1->have_posts()) : $the_query_couses_1->the_post();
                        $post_id = get_the_ID();
                        $thumb_id = get_post_thumbnail_id($post_id);
                        $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
                        $url = wp_get_attachment_url($thumb_id);
                        ob_start();
                        ?>
                        <li class="course-item educatito-hover-icon">
                            <div class="course-thumbnail box-img">
                                <?php if (!empty($url)) {
                                    ?>
                                    <img src="<?php echo esc_url($url); ?>" alt="<?php if (count($alt)) echo esc_attr($alt); ?>">
                                <?php }
                                ?>
                                <div class="hover-border">
                                    <a href="<?php echo esc_url(get_permalink()); ?>"><span class="fa fa-link"></span></a>
                                </div>
                            </div>
                            <div class="educatito-course-content">
                                <div class="author-price">
                                    <?php
                                    learn_press_course_instructor();
                                    learn_press_course_price();
                                    ?>
                                </div>
                                <div class="title">
                                    <?php
                                    do_action('learn_press_before_the_title');
                                    the_title(sprintf('<h2 class="course-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>');
                                    do_action('learn_press_after_the_title');
                                    ?>
                                </div>
                                <div class="course-description">
                                    <?php
                                    echo the_excerpt(30);
                                    ?>
                                </div>
                        </li>                   
                        <?php
                        $content_show = ob_get_contents();
                        ob_clean();
                        ob_end_flush();
                        echo $content_show;
                    endwhile;
                endif;
                ?> 
            </ul>
            <?php
        endif;
        wp_reset_postdata();
        echo $after_widget;
    }

}
