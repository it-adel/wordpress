<?php
/**
 * Shortcode Our Blog Slider
 *
 * @package Educatito
 * @author JRB Themes
 * @link http://educa.jrbthemes.com
 */
/* -------------------Our Blog Slider---------------------- */
if (!function_exists('educatito_our_blog_slider_template')):

    function educatito_our_blog_slider_template($attr) {
        ob_start();
        extract(shortcode_atts(array(
            'template' => 'template1',
            'posts_per_page' => '10',
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
        $rand_grid = rand(5, 1231564613);
        $id = md5(time() . ' ' . $rand_grid);

        if ($template == "template1") {
            $class_t = "latest-news";
        } elseif ($template == "template2") {
            $class_t = "latest-news-v2";
        } elseif ($template == "template3") {
            $class_t = "latest-news-v3";
        } else {
            $class_t = "latest-news-v4";
        }
        ?>
        <!-- BEGIN BLOG OUR SLIDER -->
        <div id="<?php echo "blog_our_slider" . esc_attr($id); ?>" class="<?php echo esc_attr($class_t); ?> <?php echo esc_attr($el_class); ?>">
            <div class="bd-container uk-container-center">
                <div class="uk-slidenav-position" data-uk-slider="{autoplay: false}">
                    <div class="uk-slider-container">
                        <ul class="uk-slider uk-grid <?php if ($template == "template2") { ?> uk-grid-collapse <?php } else { ?> uk-grid-match <?php } if ($template != "template4") { ?>  uk-grid-width-medium-1-3 <?php } else { ?> uk-grid-width-medium-1-2 <?php } ?> uk-grid-width-small-1-2 uk-grid-width-1-1">
                            <?php
                            if ($the_query->have_posts()) :
                                while ($the_query->have_posts()) : $the_query->the_post();
                                    $post_id = get_the_ID();
                                    $thumb_id = get_post_thumbnail_id($post_id);
                                    $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
                                    $url = wp_get_attachment_url($thumb_id);
                                    $term_list = wp_get_post_terms($post_id, 'category');
                                    $date = get_the_date();

                                    if ($template == "template1") :
                                        if (!empty($url)) {
                                            $image = educatito_image_resize($url, 370, 230, true);
                                        }
                                        ?>
                                        <li>
                                            <div class="box">
                                                <div class="box-img">
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
                                                    <div class="box-content-title">
                                                        <a href="<?php echo esc_url(get_permalink($post_id)); ?>"><h3 class="title"><?php echo the_title(); ?></h3></a>
                                                    </div>
                                                    <div class="box-content-meta">
                                                        <ul>
                                                            <li class="date">
                                                                <a href="javascript:;"><?php echo esc_attr($date); ?></a>
                                                            </li>
                                                            <li class="cat primary-color">
                                                                <?php
                                                                $count = count($term_list);
                                                                $i = 1;
                                                                foreach ($term_list as $term) {
                                                                    echo '<a class="primary-color" href="' . esc_url(get_category_link($term->term_id)) . '">' . esc_attr($term->name) . '</a>';
                                                                    if ($i < $count)
                                                                        echo ', ';
                                                                    $i++;
                                                                }
                                                                ?>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="box-content-p">
                                                        <?php
                                                        the_excerpt();
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>                   
                                        <?php
                                    elseif ($template == "template2") :
                                       if (!empty($url)) {
                                           $image = educatito_image_resize($url, 390, 505, true);
                                       }
                                        ?>
                                        <li>
                                            <div class="box set-height-group">
                                                <div class="box-img">
                                                    <?php
                                                    if (!empty($image)) {
                                                        ?>
                                                        <a href="<?php echo esc_url(get_permalink($post_id)); ?>">
                                                            <img src="<?php echo esc_url($image); ?>" alt="<?php if (count($alt)) echo esc_attr($alt); ?>">
                                                        </a>
                                                        <?php
                                                    }else {
                                                        ?>
                                                        <a href="<?php echo esc_url(get_permalink($post_id)); ?>">
                                                            <img src="<?php echo esc_url($url); ?>" alt="<?php if (count($alt)) echo esc_attr($alt); ?>">
                                                        </a>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                                <div class="box-content">
                                                    <div class="box-content-meta">
                                                        <ul>
                                                            <li class="cat primary-color">
                                                                <?php
                                                                $count = count($term_list);
                                                                $i = 1;
                                                                foreach ($term_list as $term) {
                                                                    echo '<a class="primary-color" href="' . esc_url(get_category_link($term->term_id)) . '">' . esc_attr($term->name) . '</a>';
                                                                    if ($i < $count)
                                                                        echo ', ';
                                                                    $i++;
                                                                }
                                                                ?>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="box-content-title set-height">
                                                        <a href="<?php echo esc_url(get_permalink($post_id)); ?>"><h3 class="basic-height title"><?php echo the_title(); ?></h3></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <?php
                                    elseif ($template == "template3") :
                                        if (!empty($url)) {
                                            $image = educatito_image_resize($url, 371, 232, true);
                                        }
                                        ?>
                                        <li>
                                            <div class="box set-height-group">
                                                <div class="box-img uk-overlay uk-overlay-hover uk-animation-hover">
                                                    <?php
                                                    if (!empty($image)) {
                                                        ?>
                                                        <a href="<?php echo esc_url(get_permalink($post_id)); ?>">
                                                            <img src="<?php echo esc_url($image); ?>" alt="<?php if (count($alt)) echo esc_attr($alt); ?>">
                                                        </a>
                                                        <?php
                                                    }else {
                                                        ?>
                                                        <a href="<?php echo esc_url(get_permalink($post_id)); ?>">
                                                            <img src="<?php echo esc_url($url); ?>" alt="<?php if (count($alt)) echo esc_attr($alt); ?>">
                                                        </a>
                                                        <?php
                                                    }
                                                    ?>
                                                    <div class="uk-overlay-panel uk-overlay-background  uk-flex uk-flex-middle uk-flex-center uk-animation-scale-up">
                                                        <div class="box-img-icon">
                                                            <a href="<?php echo esc_url(get_permalink($post_id)); ?>" >
                                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="box-img-meta">
                                                        <ul>
                                                            <li class="cat">
                                                                <?php
                                                                $count = count($term_list);
                                                                $i = 1;
                                                                foreach ($term_list as $term) {
                                                                    echo '<a href="' . esc_url(get_category_link($term->term_id)) . '">' . esc_attr($term->name) . '</a>';
                                                                    if ($i < $count)
                                                                        echo ', ';
                                                                    $i++;
                                                                }
                                                                ?>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="box-content">
                                                    <div class="box-content-title set-height">
                                                        <a href="<?php echo esc_url(get_permalink($post_id)); ?>"><h3 class="basic-height title"><?php echo the_title(); ?></h3></a>
                                                    </div>
                                                    <div class="box-content-meta">
                                                        <ul>
                                                            <li class="date">
                                                                <a href="javascript:;"><span class="fa fa-file-text-o"></span><?php echo esc_attr($date); ?></a>
                                                            </li>
                                                            <li class="comments">
                                                                <span class="fa fa-comment"></span>
                                                                <span class="comments_number">
                                                                    <?php echo get_comments_number(get_the_ID()); ?>
                                                                </span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <?php
                                    else :
                                       if (!empty($url)) {
                                           $image = educatito_image_resize($url, 570, 324, true);
                                       }
                                        ?>
                                        <li>
                                            <div class="box">
                                                <div class="box-img educatito-hover-post uk-overlay uk-overlay-hover uk-animation-hover">
                                                    <?php
                                                    if (!empty($image)) {
                                                        ?>
                                                        <a href="<?php echo esc_url(get_permalink($post_id)); ?>">
                                                            <img src="<?php echo esc_url($image); ?>" alt="<?php if (count($alt)) echo esc_attr($alt); ?>">
                                                        </a>
                                                        <?php
                                                    }else {
                                                        ?>
                                                        <a href="<?php echo esc_url(get_permalink($post_id)); ?>">
                                                            <img src="<?php echo esc_url($url); ?>" alt="<?php if (count($alt)) echo esc_attr($alt); ?>">
                                                        </a>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                                <div class="box-content">
                                                    <div class="box-content-title">
                                                        <a href="<?php echo esc_url(get_permalink($post_id)); ?>"><h3 class="title"><?php echo the_title(); ?></h3></a>
                                                    </div>
                                                    <div class="box-content-meta">
                                                        <ul>
                                                            <li class="date">
                                                                <span class="tt"><?php echo esc_html__('On', 'educatito') ?></span>
                                                                <a href="javascript:;"><?php echo esc_attr($date); ?></a>
                                                            </li>
                                                            <li class="l-c"><span>/</span></li>
                                                            <li class="cat">
                                                                <span class="tt"><?php echo esc_html__('in', 'educatito') ?></span>
                                                                <?php
                                                                $count = count($term_list);
                                                                $i = 1;
                                                                foreach ($term_list as $term) {
                                                                    echo '<a href="' . esc_url(get_category_link($term->term_id)) . '">' . esc_attr($term->name) . '</a>';
                                                                    if ($i < $count)
                                                                        echo ', ';
                                                                    $i++;
                                                                }
                                                                ?>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="box-content-p">
                                                        <?php
                                                        the_excerpt();
                                                        ?>
                                                    </div>
                                                    <div class="mrt-btn">
                                                        <a class="button" href="<?php echo esc_url(get_permalink($post_id)); ?>"><?php echo esc_html__('READ MORE', 'educatito'); ?></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>

                                    <?php
                                    endif;
                                endwhile;
                            endif;
                            ?> 
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- END BEGIN BLOG OUR SLIDER -->
        <?php
        wp_reset_postdata();
        return ob_get_clean();
    }

endif;

add_action('vc_before_init', 'educatito_our_blog_slider_backend');
if (!function_exists('educatito_our_blog_slider_backend')) {

    function educatito_our_blog_slider_backend() {
        vc_map(array(
            'base' => 'educatito_our_blog_slider',
            'name' => esc_html__('Our Blog Slider', 'educatito'),
            'description' => esc_html__('Show our blog sider.', 'educatito'),
            'category' => esc_html__('JRB Themes', 'educatito'),
            'icon' => get_template_directory_uri() . "/assets/images/icon/educatito-icon.png",
            'params' => array(
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Template', 'educatito'),
                    "value" => array(
                        esc_html__('Template One', 'educatito') => "template1",
                        esc_html__('Template Two', 'educatito') => "template2",
                        esc_html__('Template Three', 'educatito') => "template3",
                        esc_html__('Template Four', 'educatito') => "template4",
                    ),
                    "std" => "template1",
                    'param_name' => 'template',
                    'description' => esc_html__('Select template in our blog slider.', 'educatito'),
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


