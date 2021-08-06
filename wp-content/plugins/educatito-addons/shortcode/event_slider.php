<?php
/**
 * Shortcode Event Slider
 *
 * @package Educatito
 * @author JRB Themes
 * @link http://educatito.jrbthemes.com
 */
/* -------------------Event Slider---------------------- */
if (!function_exists('educatito_event_slider_template')):

    function educatito_event_slider_template($attr) {
        ob_start();
        extract(shortcode_atts(array(
            'template' => 'template1',
            'posts_per_page' => '10',
            'el_class' => '',
            'time_event' => '',
            'orderby' => 'date',
            'order' => 'DESC',
                        ), $attr));
        $args = array(
            'post_type' => 'tp_event',
            'post_status' => $time_event,
                // 'post_status' => 'publish',
        );
        if (isset($posts_per_page) && is_numeric($posts_per_page)):
            $args['posts_per_page'] = $posts_per_page;
        endif;
        if (isset($orderby) && $orderby != 'none'):
            $args['orderby'] = $orderby;
        endif;
        if (isset($order) && $order != 'none'):
            $args['order'] = $order;
        endif;
        $the_query = new WP_Query($args);
        $rand_grid = rand(5, 1231564613);
        $id = md5(time() . ' ' . $rand_grid);
        ?>
        <!-- BEGIN EVENT OUR SLIDER -->
        <div id="<?php echo "event_slider" . esc_attr($id); ?>" class="event-slider <?php echo esc_attr($el_class) . ' ' . esc_attr($template); ?>">
            <div class="bd-container uk-container-center">
                <?php if ($template == 'template1') { ?> 
                    <div class="uk-slidenav-position" data-uk-slider="{autoplay: false}">
                        <div class="uk-slider-container">
                            <ul class="uk-slider uk-grid uk-grid-width-medium-1-3 uk-grid-width-small-1-2 uk-grid-width-1-1">
                            <?php } else { ?>
                                <div data-uk-slideset="{duration: 200,small: 2,medium: 3,large: 4}">
                                    <div class="uk-slidenav-position event-slider-v2">
                                        <ul class="uk-grid uk-slideset">        
                                            <?php
                                        }
                                        if ($the_query->have_posts()) :
                                            while ($the_query->have_posts()) : $the_query->the_post();
                                                $post_id = get_the_ID();
                                                $thumb_id = get_post_thumbnail_id($post_id);
                                                $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
                                                $url = wp_get_attachment_url($thumb_id);
                                                $term_list = wp_get_post_terms($post_id, 'category');
                                                $date_show = tp_event_get_time('d');
                                                $month_show = tp_event_get_time('F');
                                                $time_format = get_option('time_format');
                                                $time_start = tp_event_start($time_format);
                                                $time_end = tp_event_end($time_format);
                                                $location = tp_event_location();
                                                if (!empty($url)) {
                                                    $image = educatito_image_resize($url, 370, 250, true);
                                                }
                                                ?>
                                                <?php if ($template == 'template1') { ?> 
                                                    <li>
                                                        <div class="box">
                                                            <div class="box-img ">
                                                                <?php
                                                                if (!empty($image)) {
                                                                    ?>
                                                                    <a href="<?php echo esc_url(get_permalink($post_id)); ?>">
                                                                        <img src="<?php echo esc_url($image); ?>" alt="<?php if (count($alt)) echo esc_attr($alt); ?>">
                                                                    </a>
                                                                    <?php
                                                                }
                                                                ?>
                                                                <div class="day">
                                                                    <?php echo esc_html($date_show); ?>
                                                                    <span><?php echo esc_html($month_show); ?></span>
                                                                </div>
                                                            </div>
                                                            <div class="box-content">
                                                                <ul class="meta-post uk-clearfix">
                                                                    <li class="time">
                                                                        <?php echo esc_html($time_start) . ' - ' . esc_html($time_end); ?>
                                                                    </li>
                                                                    <li class="address">
                                                                        <?php echo ent2ncr($location); ?>
                                                                    </li>
                                                                </ul>
                                                                <div class="box-content-title">
                                                                    <a href="<?php echo esc_url(get_permalink($post_id)); ?>"><h3 class="title"><?php echo the_title(); ?></h3></a>
                                                                </div>
                                                                <div class="box-content-p">
                                                                    <?php echo wp_trim_words(get_the_excerpt(), 12, '...') ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>     
                                                <?php }else { ?>
                                                    <li>
                                                        <div class="box">
                                                            <div class="box-img ">
                                                                <?php
                                                                if (!empty($image)) {
                                                                    ?>
                                                                    <a href="<?php echo esc_url(get_permalink($post_id)); ?>">
                                                                        <img src="<?php echo esc_url($image); ?>" alt="<?php if (count($alt)) echo esc_attr($alt); ?>">
                                                                    </a>
                                                                    <?php
                                                                }
                                                                ?>
                                                                <div class="day">
                                                                    <?php echo esc_html($date_show); ?>
                                                                    <span><?php echo esc_html(substr($month_show, 0, 3)); ?></span>
                                                                </div>
                                                            </div>
                                                            <div class="box-content">
                                                                <div class="box-content-title">
                                                                    <a href="<?php echo esc_url(get_permalink($post_id)); ?>"><h3 class="title"><?php echo the_title(); ?></h3></a>
                                                                </div>
                                                                <ul class="meta-post uk-clearfix">
                                                                    <li class="time">
                                                                        <?php echo esc_html($time_start) . ' - ' . esc_html($time_end); ?>
                                                                    </li>
                                                                    <li class="address">
                                                                        <?php echo ent2ncr($location); ?>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </li>   
                                                    <?php
                                                }
                                            endwhile;
                                        endif;
                                        ?> 
                                    </ul>
                                    <?php if ($template == 'template2') { ?> 
                                        <a href="#" class="uk-slidenav uk-slidenav-previous" data-uk-slideset-item="previous"></a>
                                        <a href="#" class="uk-slidenav uk-slidenav-next" data-uk-slideset-item="next"></a>
                                    <?php } ?>
                                </div>
                            </div>
                    </div>
                </div>
                <!-- END BEGIN EVENT OUR SLIDER -->
                <?php
                wp_reset_postdata();
                return ob_get_clean();
            }

        endif;

        add_action('vc_before_init', 'educatito_event_slider_backend');
        if (!function_exists('educatito_event_slider_backend')) {

            function educatito_event_slider_backend() {
                vc_map(array(
                    'base' => 'educatito_event_slider',
                    'name' => esc_html__('Event Slider', 'educatito'),
                    'description' => esc_html__('Show our event sider.', 'educatito'),
                    'category' => esc_html__('JRB Themes', 'educatito'),
                    'icon' => get_template_directory_uri() . "/assets/images/icon/educatito-icon.png",
                    'params' => array(
                        array(
                            'type' => 'dropdown',
                            'heading' => esc_html__('Template', 'educatito'),
                            "value" => array(
                                esc_html__('Template One', 'educatito') => "template1",
                                esc_html__('Template Two', 'educatito') => "template2",
                            ),
                            "std" => "template1",
                            'param_name' => 'template',
                            'description' => esc_html__('Select template in our event slider.', 'educatito'),
                        ),
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Post Count", 'educatito'),
                            "param_name" => "posts_per_page",
                            "value" => "10",
                            "std" => "10",
                            "description" => esc_html__("Please, enter number of post per page. Show all: -1. Default: 10.", 'educatito')
                        ),
                        array(
                            "type" => "dropdown",
                            "heading" => esc_html__('Time Event', 'educatito'),
                            "param_name" => "time_event",
                            "value" => Array(
                                esc_html__("ALL", 'educatito') => "",
                                esc_html__("Happening", 'educatito') => "tp-event-happenning",
                                esc_html__("Expired", 'educatito') => "tp-event-expired",
                                esc_html__("Upcoming", 'educatito') => "tp-event-upcoming"
                            ),
                            "std" => "",
                            "description" => esc_html__('Time Event ("Happening", "Expired", "Upcoming").', 'educatito')
                        ),
                        array(
                            "type" => "dropdown",
                            "heading" => esc_html__('Order by', 'educatito'),
                            "param_name" => "orderby",
                            "value" => array(
                                esc_html__("None", 'educatito') => "none",
                                esc_html__('Template', 'educatito') => "title",
                                esc_html__("Date", 'educatito') => "date",
                                esc_html__("ID", 'educatito') => "ID"
                            ),
                            "std" => "none",
                            "description" => esc_html__('Order by ("none", "title", "date", "ID").', 'educatito')
                        ),
                        array(
                            "type" => "dropdown",
                            "heading" => esc_html__('Order', 'educatito'),
                            "param_name" => "order",
                            "value" => Array(
                                esc_html__("None", 'educatito') => "none",
                                esc_html__("ASC", 'educatito') => "ASC",
                                esc_html__("DESC", 'educatito') => "DESC"
                            ),
                            "std" => "none",
                            "description" => esc_html__('Order ("None", "Asc", "Desc").', 'educatito')
                        ),
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => esc_html__("Extra Class", 'educatito'),
                            "param_name" => "el_class",
                            "value" => "",
                        ),
                    )
                ));
            }

        } 


