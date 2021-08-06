<?php
/**
 * Shortcode Event.
 *
 * @package Educatito
 * @author JRB Themes
 * @link http://educatito.jrbthemes.com
 */
/* -------------------Event---------------------- */
if (!function_exists('educatito_list_event_template')):

    function educatito_list_event_template($attr) {
        ob_start();
        extract(shortcode_atts(array(
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
        <!-- BEGIN BLOCK LIST Event -->
        <div id="<?php echo "educatito_list_event_" . esc_attr($id_event); ?>" class="educatito-list-event <?php echo esc_attr($el_class); ?>">
            <ul class="box-event-list educatito-accordion">
                <?php
                $i = 1;
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
                            $image = educatito_image_resize($url, 200, 135, true);
                        }
                        ?>
                        <li class="educatito-toggle <?php if ($i == 1) { ?> defaul <?php } ?>">  
                            <div class="toggle-header box-item <?php if ($i == 1) { ?> active <?php } ?>">
                                <div class="box-content-title">
                                    <a href="<?php echo esc_url(get_permalink($post_id)); ?>"><h3 class="title"><?php echo the_title(); ?></h3></a>
                                </div>
                                <ul class="meta-post uk-clearfix">
                                    <li class="date">
                                        <?php echo esc_html($date_show) . ' ' . esc_html($month_show); ?>
                                    </li>
                                    <li class="time">
                                        <?php echo esc_html($time_start) . ' - ' . esc_html($time_end); ?>
                                    </li>
                                    <li class="address">
                                        <?php echo ent2ncr($location); ?>
                                    </li>
                                </ul>
                            </div>
                            <div class="toggle-info">
                                <div class="box-img educatito-img-hvr-shin">
                                    <?php
                                    if (!empty($image)) {
                                        ?>
                                        <a href="<?php echo esc_url(get_permalink($post_id)); ?>">
                                            <img src="<?php echo esc_url($image); ?>" alt="<?php if (count($alt)) echo esc_attr($alt); ?>">
                                        </a>
                                        <?php
                                    }
                                    ?>

                                </div>
                                <div class="box-content">
                                    <ul class="meta-post uk-clearfix">
                                        <li class="date">
                                            <?php echo esc_html($date_show) . ' ' . esc_html($month_show); ?>
                                        </li>
                                        <li class="time">
                                            <?php echo esc_html($time_start) . ' - ' . esc_html($time_end); ?>
                                        </li>
                                        <li class="address">
                                            <?php echo ent2ncr($location); ?>
                                        </li>
                                    </ul>
                                    <div class="box-content-p">
                                        <?php echo wp_trim_words(get_the_excerpt(), 15, '...') ?>
                                    </div>
                                </div>
                            </div>
                        </li>                   
                        <?php
                        $i ++;
                    endwhile;
                endif;
                ?> 
            </ul>
        </div>
        <!-- END BEGIN BLOCK LIST Event -->
        <?php
        wp_reset_postdata();
        return ob_get_clean();
    }

endif;

if (!function_exists('educatito_list_event_admin')) {
    add_action('vc_before_init', 'educatito_list_event_admin');

    function educatito_list_event_admin() {
        vc_map(array(
            'name' => esc_html__('List Event', 'educatito'),
            'base' => 'educatito_list_event',
            'icon' => get_template_directory_uri() . "/assets/images/icon/educatito-icon.png",
            'category' => esc_html__('JRB Themes', 'educatito'),
            'description' => esc_html__('List Event for theme.', 'educatito'),
            'params' => array(
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
    