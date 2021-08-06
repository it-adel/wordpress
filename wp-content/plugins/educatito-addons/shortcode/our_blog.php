<?php
/**
 * Shortcode Our Blog
 *
 * @package Educatito
 * @author JRB Themes
 * @link http://educa.jrbthemes.com
 */
/* -------------------Our Blog---------------------- */
if (!function_exists('educatito_our_blog_template')):

    function educatito_our_blog_template($attr) {
        ob_start();
        extract(shortcode_atts(array(
            'template' => 'template1',
            'posts_per_page' => '3',
            'el_class' => '',
            'orderby' => 'date',
            'order' => 'DESC',
                        ), $attr));
        $args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
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
        ?>
        <div class="our-blog <?php echo esc_attr($template); ?>">
            <div class="bd-container uk-container-center">
                <div class="uk-grid">
                    <?php
                    $item = 1;
                    if ($the_query->have_posts()) :
                        while ($the_query->have_posts()) : $the_query->the_post();
                            $post_id = get_the_ID();
                            $thumb_id = get_post_thumbnail_id($post_id);
                            $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
                            $url = wp_get_attachment_url($thumb_id);
                            $term_list = wp_get_post_terms($post_id, 'category');
                            $date = get_the_date();
                            if ($item == 1) {
                                if (!empty($url)) {
                                    $image = educatito_image_resize($url, 570, 330, true);
                                    $image2 = educatito_image_resize($url, 750, 435, true);
                                }
                            } else {
                                if (!empty($url)) {
                                    $image = educatito_image_resize($url, 180, 130, true);
                                    $image2 = educatito_image_resize($url, 435, 252, true);
                                }
                            }
                            ?>
                            <?php if ($item == 1) { ?>
                                <div class="uk-width-medium-1-2 uk-width-small-1-1 uk-width-1-1 our-blog-left">
                                    <div class="box left">
                                        <div class="box-img">
                                            <a href="<?php echo esc_url(get_permalink($post_id)); ?>">
                                                <picture>
                                                    <source srcset="<?php echo esc_url($image2); ?>" media="(max-width: 991px)">
                                                    <img src="<?php echo esc_url($image); ?>" alt="">
                                                </picture>
                                            </a>
                                        </div>
                                        <div class="box-content">
                                            <div class="box-content-title">
                                                <a href="<?php echo esc_url(get_permalink($post_id)); ?>"><h3 class="title"><?php echo the_title(); ?></h3></a>
                                            </div>
                                            <div class="box-content-meta">
                                                <ul>
                                                    <li class="author">
                                                        <a href="<?php echo get_author_posts_url(get_the_author_meta('ID'), get_the_author_meta('user_nicename')); ?>"><?php echo educatito_get_author_name(); ?></a>
                                                    </li>
                                                    <li class="date">
                                                        <a href="javascript:;"><?php echo esc_attr($date); ?></a>
                                                    </li>
                                                    <li class="comment">
                                                        <?php educatito_comment_number() ?>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="box-content-p">
                                                <?php echo wp_trim_words(get_the_excerpt(), 20, '...') ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="uk-width-medium-1-2 uk-width-small-1-1 uk-width-1-1 our-blog-right">
                                <?php } else { ?>
                                    <div class="box uk-clearfix right">
                                        <div class="box-img">
                                            <a href="<?php echo esc_url(get_permalink($post_id)); ?>">
                                                <picture>
                                                    <source srcset="<?php echo esc_url($image2); ?>" media="(max-width: 480px)">
                                                    <img src="<?php echo esc_url($image); ?>" alt="">
                                                </picture>
                                            </a>
                                        </div>
                                        <div class="box-content">
                                            <div class="box-content-title">
                                                <a href="<?php echo esc_url(get_permalink($post_id)); ?>"><h3 class="title"><?php echo the_title(); ?></h3></a>
                                            </div>
                                            <div class="box-content-meta">
                                                <ul>
                                                    <li class="author">
                                                        <a href="<?php echo get_author_posts_url(get_the_author_meta('ID'), get_the_author_meta('user_nicename')); ?>"><?php echo educatito_get_author_name(); ?></a>
                                                    </li>
                                                    <li class="date">
                                                        <a href="javascript:;"><?php echo esc_attr($date); ?></a>
                                                    </li>
                                                    <li class="comment">
                                                        <a href="javascript:;"><?php educatito_comment_number() ?></a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="box-content-p">
                                                <?php echo wp_trim_words(get_the_excerpt(), 17, '...') ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                $item ++;
                            endwhile;
                        endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
        wp_reset_postdata();
        return ob_get_clean();
    }

endif;

add_action('vc_before_init', 'educatito_our_blog_backend');
if (!function_exists('educatito_our_blog_backend')) {

    function educatito_our_blog_backend() {
        vc_map(array(
            'base' => 'educatito_our_blog',
            'name' => esc_html__('Our Blog Grid', 'educatito'),
            'description' => esc_html__('Show our blog grid.', 'educatito'),
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
                    'description' => esc_html__('Select template in our blog gird.', 'educatito'),
                ),
                array(
                    "type" => "textfield",
                    "class" => "",
                    "heading" => esc_html__("Post Count", 'educatito'),
                    "param_name" => "posts_per_page",
                    "value" => "3",
                    "std" => "3",
                    "description" => esc_html__("Please, enter number of post per page. Show all: -1. Default: 2.", 'educatito')
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


