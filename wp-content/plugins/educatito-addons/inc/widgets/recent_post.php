<?php
// Create Widget
add_action('widgets_init', 'register_recent_post_widget');

function register_recent_post_widget() {
    register_widget('Educatito_Recent_Post_Widget');
}

/**
 * Create class
 */
class Educatito_Recent_Post_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
                'educatito_recent_post_widget', // Base ID  
                esc_html__('Recent Post 2', 'educatito'), // Name  
                array(
            'classname' => 'latest-post-widget educatito-widget-latest-post',
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
            'el_class' => '',
        );

        $instance = wp_parse_args((array) $instance, $default);
        $title = esc_attr($instance['title']);
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
        $title = $posts_per_page = $width = $height = $el_class = '';
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
                        ob_start();
                        ?>
                        <li>
                            <div class="box-sidebar uk-clearfix">
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
