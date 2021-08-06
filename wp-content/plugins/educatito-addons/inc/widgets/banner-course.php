<?php
// Create Widget
add_action('widgets_init', 'register_banner_course_widget');

function register_banner_course_widget() {
    register_widget('Educatito_Banner_course_Widget');
}

/**
 * Create class Organian_Banner_course_Widget
 */
class Educatito_Banner_course_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
                'educatito_banner_course_widget', // Base ID  
                esc_html__('Banner Course', 'educatito'), // Name  
                array(
            'classname' => 'banner-course educatito-widget-banner-course',
            'description' => esc_html__("Banner US widget for theme.", 'educatito'),
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
            'textbtn' => 'Visit store',
            'link' => '#',
            'title' => 'Book Store',
            'content' => 'Buy Book Online Now!',
            'el_class' => '',
        );

        $instance = wp_parse_args((array) $instance, $default);
        $textbtn = esc_attr($instance['textbtn']);
        $title = esc_attr($instance['title']);
        $content = esc_attr($instance['content']);
        $link = esc_attr($instance['link']);
        $el_class = esc_attr($instance['el_class']);

        $randomclass_ana = rand(100, 10000);

        ob_start();
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('link'); ?>" style="display:block;"><?php echo esc_html__('Link', 'educatito'); ?></label> 
            <input class="widefat link" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="text" value="<?php echo esc_attr($link); ?>" />
            </br><i><?php echo esc_html__('Enter link of your site.', 'educatito'); ?></i>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('textbtn'); ?>" style="display:block;"><?php echo esc_html__('textbtn', 'educatito'); ?></label> 
            <input class="widefat link" id="<?php echo $this->get_field_id('textbtn'); ?>" name="<?php echo $this->get_field_name('textbtn'); ?>" type="text" value="<?php echo esc_attr($textbtn); ?>" />
            </br><i><?php echo esc_html__('Enter textbtn of your site.', 'educatito'); ?></i>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>" style="display:block;"><?php echo esc_html__('Title', 'educatito'); ?></label> 
            <input class="widefat title" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
            </br><i><?php echo esc_html__('Enter title of your site.', 'educatito'); ?></i>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('content'); ?>" style="display:block;"><?php echo esc_html__('Content', 'educatito'); ?></label> 
            <input class="widefat mail" id="<?php echo $this->get_field_id('content'); ?>" name="<?php echo $this->get_field_name('content'); ?>" type="text" value="<?php echo esc_attr($content); ?>" />
            </br><i><?php echo esc_html__('Enter content of your site.', 'educatito'); ?></i>
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
        $instance['textbtn'] = strip_tags($new_instance['textbtn']);
        $instance['link'] = strip_tags($new_instance['link']);
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['content'] = strip_tags($new_instance['content']);
        $instance['el_class'] = strip_tags($new_instance['el_class']);

        return $instance;
    }

    /**
     * Show widget
     */
    function widget($args, $instance) {
        extract($args);
        echo $before_widget;
        $title = $content = $link = $textbtn = '';
        $textbtn = esc_attr($instance['textbtn']);
        $link = esc_attr($instance['link']);
        $title = esc_attr($instance['title']);
        $content = esc_attr($instance['content']);
        $el_class = esc_attr($instance['el_class']);
        ?>
        <div class="widget-banner-course <?php echo esc_attr($el_class); ?>">
            <div class="box-title">
                <?php if (isset($title) && $title != '') { ?>
                    <h3><?php echo esc_attr($title); ?></h3>
                <?php } ?>
            </div>
            <div class="box-content">
                <div class="box-background">
                    <?php if (isset($content) && $content != '') { ?>
                        <h5><?php echo esc_attr($content); ?></h5>
                    <?php } ?>
                    <div class="banner-button">
                        <a href="<?php
                        if (isset($link) && $link != '') {
                            echo esc_attr($link);
                        } else {
                            echo "#";
                        }
                        ?>" class="button ">
                            <?php echo esc_attr($textbtn); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php
        echo $after_widget;
    }

}
