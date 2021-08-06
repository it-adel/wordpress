<?php
/**
 * Shortcode Team.
 *
 * @package Educatito
 * @author JRB Themes
 * @link http://educa.jrbthemes.com
 */
/* -------------------Team---------------------- */
if (!function_exists('educatito_our_team_template')):

    function educatito_our_team_template($attr) {
        ob_start();
        $template = '';
        extract(shortcode_atts(array(
            'template' => 'template_slider',
            'posts_per_page' => -1,
            'autoplay' => 'true',
            'el_class' => '',
                        ), $attr));
        $args = array(
            'post_type' => 'team',
            'post_status' => 'publish',
            'posts_per_page' => $posts_per_page,
            'orderby' => 'date',
            'order' => 'DESC',
        );
        $the_query = new WP_Query($args);
        $rand_grid = rand(5, 1231564613);
        $id_team = md5(time() . ' ' . $rand_grid);
        ?>
        <!-- BEGIN BLOCK OUR TEAM -->
        <div id="<?php echo "educatito_our_team_" . esc_attr($id_team); ?>" class="educatito-our-team <?php echo esc_attr($template) . " " . esc_attr($el_class); ?>">
            <div class="educatito-container uk-container-center">
                <div class="uk-slidenav-position" data-uk-slider="{center: true, autoplay: false, autoplayInterval: 4000}">
                    <div class="uk-slider-container">
                        <ul class="uk-slider uk-grid uk-grid-match uk-grid-width-large-1-5 uk-grid-width-medium-1-3 uk-grid-width-small-1-2 uk-grid-width-1-1">
                            <?php
                            if ($the_query->have_posts()) :
                                while ($the_query->have_posts()) : $the_query->the_post();
                                    $post_id = get_the_ID();
                                    $thumb_id = get_post_thumbnail_id($post_id);
                                    $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
                                    $url = wp_get_attachment_url($thumb_id);
                                    $position_team = get_post_meta($post_id, 'position_team', true);
                                    $facebook_team = get_post_meta($post_id, 'facebook_team', true);
                                    $google_team = get_post_meta($post_id, 'google_team', true);
                                    $twitter_team = get_post_meta($post_id, 'twitter_team', true);
                                    $instagram_team = get_post_meta($post_id, 'instagram_team', true);
                                    if (!empty($url)) {
                                        $image = educatito_image_resize($url, 270, 270, true);
                                    }
                                    ?>
                                    <li>  
                                        <div class="box-img ">
                                            <?php
                                            if (!empty($image)) {
                                                ?>
                                                <a href="#"><img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($alt); ?>"/></a>
                                                <?php
                                            }
                                            ?>
                                            <div class="box-content">
                                                <div class="box">
                                                    <h3><?php echo esc_attr(the_title()); ?></h3>
                                                    <p><?php echo esc_attr($position_team); ?></p>
                                                    <ul class="team-social">
                                                        <?php if (!empty($facebook_team)) { ?>
                                                            <li><a href="<?php echo esc_url($facebook_team); ?>" draggable="false"><span class="fa fa-facebook"></span></a></li>
                                                            <?php
                                                        }
                                                        if (!empty($google_team)) {
                                                            ?>
                                                            <li><a href="<?php echo esc_url($google_team); ?>" draggable="false"><span class="fa fa-google-plus"></span></a></li>
                                                            <?php
                                                        }
                                                        if (!empty($twitter_team)) {
                                                            ?>
                                                            <li><a href="<?php echo esc_url($twitter_team); ?>" draggable="false"><span class="fa fa-twitter"></span></a></li>
                                                            <?php
                                                        }
                                                        if (!empty($instagram_team)) {
                                                            ?>
                                                            <li><a href="<?php echo esc_url($instagram_team); ?>" draggable="false"><span class="fa fa-instagram"></span></a></li>
                                                            <?php
                                                        }
                                                        if (!empty($vimeo_team)) {
                                                            ?>
                                                            <li><a href="<?php echo esc_url($vimeo_team); ?>" draggable="false"><span class="fa fa-vimeo"></span></a></li>
                                                                <?php } ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </li>                   
                                    <?php
                                endwhile;
                            endif;
                            ?> 
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- END BEGIN BLOCK OUR TEAM -->
        <?php
        wp_reset_postdata();
        return ob_get_clean();
    }

endif;

if (!function_exists('educatito_our_team_admin')) {
    add_action('vc_before_init', 'educatito_our_team_admin');

    function educatito_our_team_admin() {
        vc_map(array(
            'name' => esc_html__('Our Team', 'educatito'),
            'base' => 'educatito_our_team',
            'icon' => get_template_directory_uri() . "/assets/images/icon/educatito-icon.png",
            'category' => esc_html__('JRB Themes', 'educatito'),
            'description' => esc_html__('Our team for theme.', 'educatito'),
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
                    'type' => 'dropdown',
                    'heading' => esc_html__('Template', 'educatito'),
                    "value" => array(
                        esc_html__('Template Slider', 'educatito') => "template_slider",
                    ),
                    "std" => "template_slider",
                    'param_name' => 'template',
                    'description' => esc_html__('Select template in our team.', 'educatito'),
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
    