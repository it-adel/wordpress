<?php
// Create Widget
add_action('widgets_init', 'register_testimonial_widget');

function register_testimonial_widget() {
    register_widget('Educatito_Testimonial_Widget');
}

/**
 * Create class
 */
class Educatito_Testimonial_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
                'educatito_testimonial_widget', // Base ID  
                esc_html__('Testimonial', 'educatito'), // Name  
                array(
            'classname' => 'testimonial-widget educatito-widget-testimonial',
            'description' => esc_html__("Display a list of your most testimonial on your site.", 'educatito'),
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
            'title' => 'What’s Student Say ?',
            'width' => '91',
            'height' => '91',
            'posts_per_page' => '3',
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
        $el_class = esc_attr($instance['el_class']);

        $query_args = array(
            'post_type' => 'testimonial',
            'post_status' => 'publish',
            'posts_per_page' => '-1',
            'orderby' => 'date',
            'order' => 'DESC',
        );

        $the_query = new WP_Query($query_args);
        if ($the_query->have_posts()) :
            ?>
            <div class="educatito-testimonial-widget">
                <div class="uk-container-center uk-container">
                    <h4 class="title"><?php echo esc_attr($title); ?></h4>
                    <div class="testimonial-slick">
                        <ul class="slick-slider slick-testimonial">
                            <?php
                            if ($the_query->have_posts()) :
                                while ($the_query->have_posts()) : $the_query->the_post();
                                    $post_id = get_the_ID();
                                    $name_author = get_the_title();
                                    $url = wp_get_attachment_url(get_post_thumbnail_id($post_id));
                                    $position = get_post_meta($post_id, 'position', true);

                                    $thumb_id = get_post_thumbnail_id($post_id);
                                    $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
                                    ?> 
                                    <li>
                                        <div class="box">
                                            <div class="box-img">
                                                <img src="<?php echo esc_url($url); ?>" alt="<?php echo esc_attr($alt); ?>"/>
                                            </div>
                                            <div class="box-content">
                                                <div class="box-content-h3">
                                                    <a href="#" class="author title"><h3 ><?php echo esc_attr($name_author); ?></h3></a>
                                                </div>
                                                <div class="box-content-span">
                                                    <span class="primary-color"><?php echo esc_attr($position); ?></span>
                                                </div>
                                                <div class="box-content-p">
                                                    <?php echo wp_trim_words(get_the_excerpt(), 20, '...') ?>
                                                </div>
                                            </div>
                                        </div>
                                    </li>            
                                    <?php
                                endwhile;
                            endif;
                            ?> 
                        </ul>

                    </div>
                </div>
            </div>
            <?php
        endif;
        wp_reset_query();
        echo $after_widget;
    }

}
