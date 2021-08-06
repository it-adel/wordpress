<?php
/**
 * Shortcode Portfolio Grid.
 *
 * @package Educatito
 * @author JRB Themes
 * @link http://educa.jrbthemes.com
 */
/* -------------------Portfolio Grid---------------------- */

if (!function_exists('educatito_portfolio_grid_template')):

    function educatito_portfolio_grid_template($attr) {
        ob_start();
        $disable_load_more = $disable_filter = '';
        extract(shortcode_atts(array(
            'posts_per_page' => '10',
            'el_class' => '',
            'disable_load_more' => '',
            'disable_filter' => '',
            'column' => '5 column',
                        ), $attr));
        $paged = get_query_var('paged') ? get_query_var('paged') : 1;
        $args = array(
            'post_type' => 'portfolio',
            'post_status' => 'publish',
            'orderby' => 'date',
            'order' => 'DESC',
        );
        if (isset($posts_per_page) && is_numeric($posts_per_page)):
            $args['posts_per_page'] = $posts_per_page;
        endif;
        $the_query = new WP_Query($args);

        $max_paged = intval($the_query->max_num_pages);

        if ($column == "5 column") {
            $column = "grid-5-column";
        } elseif ($column == "4 column") {
            $column = "grid-4-column";
        } else {
            $column = "grid-3-column";
        }

        $rand_grid = rand(5, 1231564613);
        $id_portfolio_grid = md5(time() . ' ' . $rand_grid);
        ?>
        <!-- Begin Portfolio Grid -->
        <div id="<?php echo "educatito_portfolio_grid_" . esc_attr($id_portfolio_grid); ?>" class="educatito-portfolio_grid <?php echo esc_attr($el_class); ?>">
            <div class="portfolio-grid-wrap">
                <?php if(empty($disable_filter)): ?>
                <div class="educatito-portfolio-filter educatito-list-filter uk-clearfix">
                    <div class="filter-mobile hidden">
                        <a href="#"><span><?php echo esc_html__("Select Filter", "educa"); ?></span></a>
                    </div>
                    <ul class="educatito-filter-category portfolio-filter-cat button-group educatito-filters-button">
                        <li class="is-checked button-filter"><a href="#"><?php echo esc_html__("ALL","educa");?></a></li>
                        <?php
                        $terms = get_terms('portfolio-types');
                        foreach ($terms as $term) {
                            ?>
                            <li class="button-filter" data-filter="<?php echo '.filter-' . esc_attr($term->slug) . '_' . esc_attr($id_portfolio_grid); ?>"><a href="#"><?php echo esc_attr($term->name); ?></a></li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
                <?php endif; ?>
                <div class="portfolio-grid-content">
                    <ul id="portfolio-grid-<?php echo esc_attr($id_portfolio_grid); ?>" class="images_lightbox portfolio-grid portfolio-grid-hoverdir <?php echo esc_attr($column); ?>">
                        <?php
                        if ($the_query->have_posts()) :
                            while ($the_query->have_posts()) : $the_query->the_post();
                                $post_id = get_the_ID();

                                $thumb_id = get_post_thumbnail_id($post_id);
                                $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
                                $url = wp_get_attachment_url($thumb_id);
                                if (!empty($url)) {
                                $image = educatito_image_resize($url, 370, 370, true);
                                if ($column == "grid-5-column") {
                                    $image = educatito_image_resize($url, 320, 220, true);
                                } elseif ($column == "grid-4-column") {
                                    $image = educatito_image_resize($url, 338, 232, true);
                                } else {
                                    $image = educatito_image_resize($url, 370, 370, true);
                                }
                                }
                                $term_list = wp_get_post_terms($post_id, 'portfolio-types');
                                $id_cat = $term_list[0]->term_id;
                                $cat = $term_list[0]->name;
                                $slug = $term_list[0]->slug;
                                $link_cat = get_category_link($id_cat);
                                ?> 
                                <li  class="element-item <?php
                                foreach ($term_list as $term) {
                                    echo 'filter-' . esc_attr($term->slug) . '_' . esc_attr($id_portfolio_grid) . ' ';
                                }
                                ?>" data-src="<?php echo esc_url($url); ?>" >

                                    <div class="box hoverdir">
                                        <?php
                                        if (!empty($image)) {
                                            ?>
                                            <img src="<?php echo esc_url($image); ?>" alt="<?php if (count($alt)) echo esc_attr($alt); ?>">
                                            <?php
                                        }
                                        ?>
                                        <div class="educatito-flex-box overlay">
                                            <div class="box-text-overlay">
                                                <a href="<?php echo esc_url(get_permalink()) ?>" class="link-title"><h3 class="title"><?php echo esc_attr(the_title()); ?></h3></a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <?php
                            endwhile;
                        endif;
                        ?>
                    </ul>
                    <?php
                    if ($max_paged > 1 && empty($disable_load_more)) {
                        ?>
                        <div class="paging_more">
                            <div class="loader" style="display: none;"></div>
                            <a href="#" class="loadmore-portfolio educatito-button educatito-button-primary" data-max-paged="<?php echo esc_attr($max_paged); ?>" data-id="<?php echo esc_attr($id_portfolio_grid); ?>" data-posts-per-page="<?php echo esc_attr($posts_per_page); ?>" data-column="<?php echo esc_attr($column); ?>" data-paged="<?php echo esc_attr($paged); ?>"><?php echo esc_html__('LOAD MORE', 'educatito'); ?></a>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <!-- End Portfolio Grid -->
        <?php
        wp_reset_postdata();
        return ob_get_clean();
    }

endif;

if (!function_exists('educatito_portfolio_grid_admin')) {
    add_action('vc_before_init', 'educatito_portfolio_grid_admin');

    function educatito_portfolio_grid_admin() {
        vc_map(array(
            'name' => esc_html__('Portfolio Grid', 'educatito'),
            'base' => 'educatito_portfolio_grid',
            'icon' => get_template_directory_uri() . "/assets/images/icon/educatito-icon.png",
            'category' => esc_html__('JRB Themes', 'educatito'),
            'description' => esc_html__('Portfolio grid for theme', 'educatito'),
            'params' => array(
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Column', 'educatito'),
                    "value" => array(
                        esc_html__("3 column", 'educatito') => "3 column",
                        esc_html__("4 column", 'educatito') => "4 column",
                        esc_html__("5 column", 'educatito') => "5 column",
                    ),
                    "std" => "5 column",
                    'param_name' => 'column',
                    'description' => esc_html__('Select column in portfolio grid.', 'educatito'),
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
                    "type" => "checkbox",
                    "class" => "",
                    "heading" => esc_html__("Disble Filter", 'educatito'),
                    "param_name" => "disable_filter",
                    "value" => "",
                    "description" => esc_html__("Please using checkbox to disable a filter.", 'educatito')
                ),
                array(
                    "type" => "checkbox",
                    "class" => "",
                    "heading" => esc_html__("Disble Load More", 'educatito'),
                    "param_name" => "disable_load_more",
                    "value" => "",
                    "description" => esc_html__("Please using checkbox to disable a button load more.", 'educatito')
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Extra class name', 'educatito'),
                    'param_name' => 'el_class',
                    'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'educatito'),
                ),
            )
        ));
    }

}

//function ajax 
function educatito_add_new_portfolio() {
    $id = $_POST['id'];
    $paged = $_POST['paged'] + 1;
    $posts_per_page = $_POST['posts_per_page'];
    $column = $_POST['column'];
    $args = array(
        'post_type' => 'portfolio',
        'post_status' => 'publish',
        'paged' => $paged,
        'orderby' => 'date',
        'order' => 'DESC',
    );
    if (isset($posts_per_page) && is_numeric($posts_per_page)):
        $args['posts_per_page'] = $posts_per_page;
    endif;

    $the_query = new WP_Query($args);
    //print_r($the_query);
    ob_start();
    if ($the_query->have_posts()) :
        while ($the_query->have_posts()) : $the_query->the_post();
            $post_id = get_the_ID();

            $thumb_id = get_post_thumbnail_id($post_id);
            $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
            $url = wp_get_attachment_url($thumb_id);
            if (!empty($url)) {
            $image = educatito_image_resize($url, 370, 370, true);
            if ($column == "grid-5-column") {
                $image = educatito_image_resize($url, 320, 220, true);
            } elseif ($column == "grid-4-column") {
                $image = educatito_image_resize($url, 338, 232, true);
            } else {
                $image = educatito_image_resize($url, 370, 370, true);
            }
            }
            $term_list = wp_get_post_terms($post_id, 'portfolio-types');
            $id_cat = $term_list[0]->term_id;
            $cat = $term_list[0]->name;
            $slug = $term_list[0]->slug;
            $link_cat = get_category_link($id_cat);
            ?> 
            <li class="element-item <?php
            foreach ($term_list as $term) {
                echo 'filter-' . esc_attr($term->slug) . '_' . esc_attr($id) . ' ';
            }
            ?>" data-src="<?php echo esc_url($url); ?>">

                <div class="box hoverdir">
                    <?php
                    if (!empty($image)) {
                        ?>
                        <img src="<?php echo esc_url($image); ?>" alt="<?php if (count($alt)) echo esc_attr($alt); ?>">
                        <?php
                    }
                    ?>
                    <div class="educatito-flex-box">
                        <div class="box-text-overlay">
                            <a href="<?php echo esc_url(get_permalink()) ?>" class="link-title"><h3 class="title"><?php echo esc_attr(the_title()); ?></h3></a>
                        </div>
                    </div>
                </div>
            </li>

            <?php
        endwhile;
    endif;
    echo ob_get_clean();
    die();
}

add_action("wp_ajax_educatito_add_new_portfolio", "educatito_add_new_portfolio");
add_action("wp_ajax_nopriv_educatito_add_new_portfolio", "educatito_add_new_portfolio");
