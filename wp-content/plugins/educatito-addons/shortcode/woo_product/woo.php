<?php
/**
 * Shortcode Woo Slider
 *
 * @package Educatito
 * @author JRB Themes
 * @link http://educatito.jrbthemes.com
 */
/* -------------------Woo Slider---------------------- */
if (!function_exists('educatito_woo_slider_template')):

    function educatito_woo_slider_template($attr) {
        ob_start();
        extract(shortcode_atts(array(
            'posts_per_page' => '10',
            'el_class' => '',
            'orderby' => 'date',
            'order' => 'DESC',
                        ), $attr));
        $args = array(
            'post_type' => 'product',
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
        ?>
        <!-- BEGIN WOO SLIDER -->
        <div id="<?php echo "woo_our_slider" . esc_attr($id); ?>" class="<?php echo esc_attr($el_class); ?>">
            <div class="bd-container uk-container-center">
                <div class="uk-slidenav-position" data-uk-slider="{autoplay: false}">
                    <div class="uk-slider-container product-box">
                        <ul class="uk-slider uk-grid uk-grid-width-large-1-4 uk-grid-width-medium-1-3 uk-grid-width-small-1-2 uk-grid-width-1-1">
                            <?php
                            if ($the_query->have_posts()) :
                                while ($the_query->have_posts()) : $the_query->the_post();
                                    $post_id = get_the_ID();
                                    $thumb_id = get_post_thumbnail_id($post_id);
                                    $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
                                    $url = wp_get_attachment_url($thumb_id);
                                    if (!empty($url)) {
                                        $image = educatito_image_resize($url, 270, 270, true);
                                    }
                                    $term_list = get_the_terms($post_id, 'product_cat');
                                    ?>
                                    <div class="product-item-wrap">
                                        <div <?php post_class('product-item'); ?>>
                                            <div class="box-img">
                                                <?php
                                                do_action('woocommerce_show_product_loop_sale_flash');
                                                $postDate = strtotime(get_the_date('j F Y'));
                                                $todaysDate = time() - (7 * 86400); // publish < current time 1 week
                                                if ($postDate >= $todaysDate)
                                                    echo '<span class="new">' . esc_html__('New', 'educatito') . '</span>';
                                                ?>
                                                <?php
                                                if (!empty($image)) {
                                                    ?>
                                                    <a href="<?php echo esc_url(the_permalink()); ?>">
                                                        <img src="<?php echo esc_url($image); ?>" alt="<?php if (count($alt)) echo esc_attr($alt); ?>">
                                                    </a>
                                                    <?php
                                                }
                                                ?>
                                                <div class="product-options">
                                                    <div class="box-icon">
                                                        <?php
                                                        do_action('woocommerce_template_loop_add_to_cart');
                                                        educatito_add_quick_view_button();
                                                        ?> 
                                                    </div>
                                                    <div class="box-content div-center uk-clearfix">
                                                        <div class="box-title">
                                                            <h3 class="title"><a href="<?php echo esc_url(the_permalink()); ?>"><?php echo esc_attr(the_title()); ?></a></h3>
                                                            <p>
                                                                <span><?php echo esc_html__('by', 'educatito'); ?></span>
                                                                <?php
                                                                $count = count($term_list);
                                                                $i = 1;
                                                                foreach ($term_list as $term) {
                                                                    echo '<a class="link-cat" href="' . esc_url(get_category_link($term->term_id)) . '">' . esc_attr($term->name) . '</a>';
                                                                    if ($i < $count)
                                                                        echo ', ';
                                                                    $i++;
                                                                }
                                                                ?>
                                                            </p>
                                                        </div>
                                                        <div class="product-price">
                                                            <?php
                                                            do_action('woocommerce_template_loop_price');
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                
                                    <?php
                                endwhile;
                            endif;
                            ?> 
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- END BEGIN WOO SLIDER -->
        <?php
        wp_reset_postdata();
        return ob_get_clean();
    }

endif;

add_action('vc_before_init', 'educatito_woo_slider_backend');
if (!function_exists('educatito_woo_slider_backend')) {

    function educatito_woo_slider_backend() {
        vc_map(array(
            'base' => 'educatito_woo_slider',
            'name' => esc_html__('Woo Slider', 'educatito'),
            'description' => esc_html__('Show our woo sider.', 'educatito'),
            'category' => esc_html__('JRB Themes', 'educatito'),
            'icon' => get_template_directory_uri() . "/assets/images/icon/educatito-icon.png",
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


