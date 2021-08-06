<?php
// Create Widget
add_action('widgets_init', 'register_course_megamenu_widget');

function register_course_megamenu_widget() {
    register_widget('Educatito_Course_Megamenu_Widget');
}

/**
 * Create class
 */
class Educatito_Course_Megamenu_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
                'educatito_course_megamenu_widget', // Base ID  
                esc_html__('Course Megamenu', 'educatito'), // Name  
                array(
            'classname' => 'course-megamenu-widget educatito-widget-course-megamenu',
            'description' => esc_html__("Display a list of your most latest course on your site.", 'educatito'),
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
            'width' => '91',
            'height' => '91',
            'posts_per_page' => '4',
            'orderby' => 'none',
            'order' => 'none',
            'el_class' => '',
        );

        $instance = wp_parse_args((array) $instance, $default);
        $title = esc_attr($instance['title']);
        $width = esc_attr($instance['width']);
        $height = esc_attr($instance['height']);
        $posts_per_page = esc_attr($instance['posts_per_page']);
        $orderby = esc_attr($instance['orderby']);
        $order = esc_attr($instance['order']);
        $el_class = esc_attr($instance['el_class']);

        $randomclass_ana = rand(100, 10000);
        ob_start();
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>" style="display:block;"><?php echo esc_html__('Title:', 'educatito'); ?></label> 
            <input class="widefat about-title" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('width'); ?>"><?php echo esc_html__('Width of thumbnail:', 'educatito'); ?></label> 
            <input class="widefat tiny-text width" id="<?php echo $this->get_field_id('width'); ?>" name="<?php echo $this->get_field_name('width'); ?>" type="number" min="1" max="" step="1" value="<?php echo esc_attr($width); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('height'); ?>"><?php echo esc_html__('Height of thumbnail:', 'educatito'); ?></label> 
            <input class="widefat tiny-text height" id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" type="number" min="1" max="" step="1" value="<?php echo esc_attr($height); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('posts_per_page'); ?>"><?php echo esc_html__('Number of posts to show:', 'educatito'); ?></label> 
            <input class="widefat tiny-text posts_per_page" id="<?php echo $this->get_field_id('posts_per_page'); ?>" name="<?php echo $this->get_field_name('posts_per_page'); ?>" type="number" min="1" max="" step="1" value="<?php echo esc_attr($posts_per_page); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('orderby'); ?>" style="display:block;"><?php
                echo esc_html__('Order by', 'educatito');
                echo $orderby;
                ?></label> 
            <select class="widefat mail"  id="<?php echo $this->get_field_id('orderby'); ?>" name="<?php echo $this->get_field_name('orderby'); ?>">
                <option value="none" <?php
                if ($orderby == 'none') {
                    echo 'selected="selected"';
                }
                ?>><?php echo esc_html__('None', 'educatito') ?></option>
                <option value="date" <?php
                if ($orderby == 'date') {
                    echo 'selected="selected"';
                }
                ?>><?php echo esc_html__('Date', 'educatito') ?></option>
                <option value="id" <?php
                if ($orderby == 'id') {
                    echo 'selected="selected"';
                }
                ?>><?php echo esc_html__('ID', 'educatito') ?></option>
            </select>
            </br><i><?php echo esc_html__('orderby of your site.', 'educatito'); ?></i>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('order'); ?>" style="display:block;"><?php
                echo esc_html__('Order', 'educatito');
                echo $order;
                ?></label> 
            <select class="widefat mail"  id="<?php echo $this->get_field_id('order'); ?>" name="<?php echo $this->get_field_name('order'); ?>">
                <option value="none" <?php
                if ($order == 'none') {
                    echo 'selected="selected"';
                }
                ?>><?php echo esc_html__('None', 'educatito') ?></option>
                <option value="asc" <?php
                if ($order == 'asc') {
                    echo 'selected="selected"';
                }
                ?>><?php echo esc_html__('ASC', 'educatito') ?></option>
                <option value="desc" <?php
                if ($order == 'desc') {
                    echo 'selected="selected"';
                }
                ?>><?php echo esc_html__('DESC', 'educatito') ?></option>
            </select>
            </br><i><?php echo esc_html__('order of your site.', 'educatito'); ?></i>
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
        $instance['width'] = strip_tags($new_instance['width']);
        $instance['height'] = strip_tags($new_instance['height']);
        $instance['posts_per_page'] = strip_tags($new_instance['posts_per_page']);
        $instance['orderby'] = strip_tags($new_instance['orderby']);
        $instance['order'] = strip_tags($new_instance['order']);
        $instance['el_class'] = strip_tags($new_instance['el_class']);

        return $instance;
    }

    /**
     * Show widget
     */
    function widget($args, $instance) {
        extract($args);
        echo $before_widget;
        $title = $posts_per_page = $width = $height = $el_class = '';

        $title = esc_attr($instance['title']);
        $width = absint($instance['width']);
        $height = absint($instance['height']);
        $orderby = esc_attr($instance['orderby']);
        $order = esc_attr($instance['order']);
        $posts_per_page = absint($instance['posts_per_page']);
        $posts_per_page = $posts_per_page > 0 ? $posts_per_page : -1;
        $el_class = esc_attr($instance['el_class']);

        $query_args = array(
            'post_type' => 'lp_course',
            'post_status' => 'publish',
            'posts_per_page' => $posts_per_page,
            'no_found_rows' => 1,
        );
        if (isset($orderby) && $orderby != 'none'):
            $args['orderby'] = $orderby;
        endif;
        if (isset($order) && $order != 'none'):
            $args['order'] = $order;
        endif;
        $the_query_couses = new WP_Query($query_args);
        if ($the_query_couses->have_posts()) :
            ?>
            <h4 class="title"><?php echo esc_attr($title); ?></h4>
            <ul>
                <?php
                if ($the_query_couses->have_posts()) :
                    while ($the_query_couses->have_posts()) : $the_query_couses->the_post();
                        $post_id = get_the_ID();
                        $thumb_id = get_post_thumbnail_id($post_id);
                        $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
                        $url = wp_get_attachment_url($thumb_id);
                        $image = educatito_image_resize($url, $width, $height, true);
                        ob_start();
                        ?>
                        <li>
                            <div class="educatito-mega-box">
                                <div class="box-img">
                                    <a href="<?php echo esc_url(get_permalink()) ?>">
                                        <div class="new"><?php echo esc_html__('New','educatito') ?></div>
                                        <?php
                                        if (!empty($image)) {
                                            ?>
                                            <img src="<?php echo esc_url($image); ?>" alt="<?php if (count($alt)) echo esc_attr($alt); ?>">
                                            <?php
                                        }else {
                                            ?>
                                            <img src="<?php echo esc_url($url); ?>" alt="<?php if (count($alt)) echo esc_attr($alt); ?>">
                                            <?php
                                        }
                                        ?>
                                    </a>
                                </div>
                                <div class="box-course-info">
                                    <a href="<?php echo esc_url(get_permalink()) ?>" class="link-title"><h5 class="title"><?php echo esc_attr(the_title()); ?></h5></a>
                                    <div class="course-price">
                                        <?php learn_press_course_price(); ?>
                                    </div>
                                </div>
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
