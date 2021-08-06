<?php
// Create Widget
add_action('widgets_init', 'register_recent_post_2_widget');

function register_recent_post_2_widget() {
    register_widget('Educatito_recent_post_2_Widget');
}

/**
 * Create class
 */
class Educatito_recent_post_2_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
                'educatito_recent_post_2_widget', // Base ID  
                esc_html__('Recent Post Image', 'educatito'), // Name  
                array(
            'classname' => 'latest-post-widget educatito-widget-latest-post latest-post-image',
            'description' => esc_html__("Display a list of your most latest post on your site.", 'educatito'),
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
            'title' => 'Recent Post',
            'posts_per_page' => '3',
            'width' => '90',
            'height' => '90',
            'el_class' => '',
        );

        $instance = wp_parse_args((array) $instance, $default);
        $title = esc_attr($instance['title']);
        $width = esc_attr($instance['width']);
        $height = esc_attr($instance['height']);
        $posts_per_page = esc_attr($instance['posts_per_page']);
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
        $instance['el_class'] = strip_tags($new_instance['el_class']);

        return $instance;
    }

    /**
     * Show widget
     */
    function widget($args, $instance) {
        extract($args);
        echo $before_widget;
        $title = $posts_per_page = $el_class = '';
        $width = $height = '';
        //print_r($instance);
        $width = esc_attr($instance['width']);
        $height = esc_attr($instance['height']);
        $title = esc_attr($instance['title']);
        $posts_per_page = absint($instance['posts_per_page']);
        $posts_per_page = $posts_per_page > 0 ? $posts_per_page : -1;
        $el_class = esc_attr($instance['el_class']);

        $query_args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => $posts_per_page,
            'no_found_rows' => 1,
            'orderby' => 'date',
            'order' => 'DESC',
        );

        $the_query = new WP_Query($query_args);
        if ($the_query->have_posts()) :
            ?>          
            <h4 class="title"><?php echo esc_attr($title); ?></h4>
            <ol>
                <?php
                if ($the_query->have_posts()) :
                    while ($the_query->have_posts()) : $the_query->the_post();
                        $post_id = get_the_ID();
                        $thumb_id = get_post_thumbnail_id($post_id);
                        $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
                        $url = wp_get_attachment_url($thumb_id);
                        if (!empty($url)) {
                            $image_default = educatito_image_resize($url, 90, 90, true);
                            $image = educatito_image_resize($url, $width, $height, true);
                        }
                        ob_start();
                        ?>
                        <li>
                            <div class="box-sidebar uk-clearfix">
                                <div class="box-img educatito-hover-post">
                                    <a href="<?php echo esc_url(get_permalink()) ?>">
                                        <?php
                                        if (!empty($image)) {
                                            ?>
                                            <img src="<?php echo esc_url($image); ?>" alt="<?php if (count($alt)) echo esc_attr($alt); ?>">
                                            <?php
                                        }else {
                                            ?>
                                            <img src="<?php echo esc_url($image_default); ?>" alt="<?php if (count($alt)) echo esc_attr($alt); ?>">
                                            <?php
                                        }
                                        ?>
                                    </a>
                                </div>
                                <div class="box-meta">      
                                    <a href="<?php echo esc_url(get_permalink()) ?>"><h5><?php echo esc_attr(the_title()); ?></h5></a>
                                    <ul>
                                        <li>
                                            <?php echo esc_attr(get_the_date('M')); ?> <?php echo esc_attr(get_the_date('d')); ?>, <?php echo esc_attr(get_the_date('Y')); ?> 
                                        </li>
                                        <li>
                                            <?php educatito_comment_number() ?>
                                        </li>
                                    </ul>
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
            </ol>         
            <?php
        endif;
        wp_reset_postdata();
        echo $after_widget;
    }

}
