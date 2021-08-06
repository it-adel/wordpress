<?php
/**
 * Shortcode Blog.
 *
 * @package Educatito
 * @author JRB Themes
 * @link http://educatito.jrbthemes.com
 */
/* -------------------blog---------------------- */
if (!function_exists('educatito_list_blog_template')):

    function educatito_list_blog_template($attr) {
        ob_start();
        $template = '';
        extract(shortcode_atts(array(
            'posts_per_page' => -1,
            'width_image' => '',
            'height_image' => '',
            'el_class' => '',
                        ), $attr));
        $args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => $posts_per_page,
            'orderby' => 'date',
            'order' => 'DESC',
        );
        $the_query = new WP_Query($args);
        $rand_grid = rand(5, 1231564613);
        $id_blog = md5(time() . ' ' . $rand_grid);
        ?>
        <!-- BEGIN BLOCK LIST BLOG -->
        <div id="<?php echo "educatito_list_blog_" . esc_attr($id_blog); ?>" class="educatito-list-blog <?php echo esc_attr($el_class); ?>">
            <ul class="box-blog-list">
                <?php
                if ($the_query->have_posts()) :
                    while ($the_query->have_posts()) : $the_query->the_post();
                        $post_id = get_the_ID();
                        $thumb_id = get_post_thumbnail_id($post_id);
                        $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
                        $url = wp_get_attachment_url($thumb_id);
                        $date = get_the_date();
                        if (!empty($url)) {
                            $image = educatito_image_resize($url, $width_image, $height_image, true);
                        }
                        ?>
                        <li class="uk-clearfix">  
                            <div class="box-img ">
                                <?php
                                if (!empty($image)) {
                                    ?>
                                    <a href="#"><img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($alt); ?>"/></a>
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
                                        <li class="comment">
                                            <a href="javascript:;"><?php educatito_comment_number() ?></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="box-content-p">
                                    <?php echo wp_trim_words(get_the_excerpt(), 20, '...') ?>
                                </div>
                            </div>
                        </li>                   
                        <?php
                    endwhile;
                endif;
                ?> 
            </ul>
        </div>
        <!-- END BEGIN BLOCK LIST BLOG -->
        <?php
        wp_reset_postdata();
        return ob_get_clean();
    }

endif;

if (!function_exists('educatito_list_blog_admin')) {
    add_action('vc_before_init', 'educatito_list_blog_admin');

    function educatito_list_blog_admin() {
        vc_map(array(
            'name' => esc_html__('List BLog', 'educatito'),
            'base' => 'educatito_list_blog',
            'icon' => get_template_directory_uri() . "/assets/images/icon/educatito-icon.png",
            'category' => esc_html__('JRB Themes', 'educatito'),
            'description' => esc_html__('List Blog for theme.', 'educatito'),
            'params' => array(
                array(
                    "type" => "textfield",
                    "class" => "",
                    "heading" => esc_html__("Post Count", 'educatito'),
                    "param_name" => "posts_per_page",
                    "value" => "-1",
                    "std" => "-1",
                    "description" => esc_html__("Please, enter number of post per page. Show all: -1. Ex: 10. Default: -1.", 'educatito')
                ),
                // Control Icons END
                array(
                    "type" => "number",
                    "class" => "",
                    "heading" => esc_html__("Width Image", 'educatito'),
                    "param_name" => "width_image",
                    "value" => "",
                ),
                array(
                    "type" => "number",
                    "class" => "",
                    "heading" => esc_html__("height Image", 'educatito'),
                    "param_name" => "height_image",
                    "value" => "",
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
    