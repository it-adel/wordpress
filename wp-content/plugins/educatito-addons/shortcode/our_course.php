<?php
/**
 * Shortcode Course Our.
 *
 * @package Educatito
 * @author JRB Themes
 * @link http://educatito.jrbthemes.com
 */
/* -------------------Course Our---------------------- */

if (!function_exists('educatito_our_course_template')):

    function educatito_our_course_template($attr) {
        ob_start();
        extract(shortcode_atts(array(
            'template' => 'template1',
            'disable_filter' => '',
            'per_number' => '-1',
            'course_cat' => '',
            'el_class' => '',
                        ), $attr));
        $args = array(
            'post_type' => 'lp_course',
            'post_status' => 'publish',
            'posts_per_page' => $per_number,
            'orderby' => 'date',
            'order' => 'DESC',
        );

        $category = array();
        if (isset($course_cat) && $course_cat != '') {
            $cats = explode(',', $course_cat);
            $course_cat = array();
            foreach ((array) $cats as $cat) :
                $category[] = intval($cat);
            endforeach;
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'course_category',
                    'terms' => $category,
                    'field' => 'id',
                    'operator' => 'IN'
                )
            );
        }
        $the_query = new WP_Query($args);

        $max_paged = intval($the_query->max_num_pages);


        $rand_grid = rand(5, 1231564613);
        $id_our_course = md5(time() . ' ' . $rand_grid);
        ?>
        <!-- Begin Course Our -->
        <div id="<?php echo "educatito_our_course_" . esc_attr($id_our_course); ?>" class="educatito-our_course <?php echo esc_attr($el_class) . ' ' . esc_attr($template); ?> ">
            <div class="our-course-wrap">
                <?php if (empty($disable_filter)) { ?>
                    <div class="educatito-course-filter educatito-list-filter uk-clearfix">
                        <div class="filter-mobile hidden">
                            <a href="#"><span><?php echo esc_html__("Select Filter", "educatito"); ?></span></a>
                        </div>
                        <ul class="educatito-filter-category course-filter-cat button-group educatito-filters-button">
                            <?php if ($template == 'template1') { ?>
                                <li id="all_<?php echo esc_attr($id_our_course); ?>" class="is-checked button-filter"><a href="#"><?php echo esc_html__("All Course", "educatito"); ?></a></li>
                            <?php } else { ?>
                                <li id="all_<?php echo esc_attr($id_our_course); ?>" class="is-checked button-filter"><a href="#"><?php echo esc_html__("All", "educatito"); ?></a></li>
                                <?php
                            }
                            foreach ($category as $term) {
                                ?>
                                <li class="button-filter" id="<?php echo esc_attr(get_term($term)->slug) . '_' . esc_attr($id_our_course); ?>" ><a href="#"><?php echo esc_attr(get_term($term)->name); ?></a></li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                <?php } ?>
                <div class="our-course-content">
                    <ul id="our-course-<?php echo esc_attr($id_our_course); ?>" class="our-course slick-slider our-course-hoverdir ">
                        <?php
                        if ($the_query->have_posts()) :
                            while ($the_query->have_posts()) : $the_query->the_post();
                                $post_id = get_the_ID();
                                $course = LP()->global['course'];
                                $_lp_students = get_post_meta($post_id, '_lp_students', true);
                                $_lp_students2 = get_post_meta($post_id, '_lp_max_students', true);
                                $thumb_id = get_post_thumbnail_id($post_id);
                                $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
                                $url = wp_get_attachment_url($thumb_id);
                                if (!empty($url)) {
                                    $image = educatito_image_resize($url, 370, 250, true);
                                }
                                $term_list = wp_get_post_terms($post_id, 'course_category');
                                ?> 
                                <li class="filter-all_<?php echo esc_attr($id_our_course); ?> <?php
                                foreach ($term_list as $term) {
                                    echo 'filter-' . esc_attr($term->slug) . '_' . esc_attr($id_our_course) . ' ';
                                }
                                ?>">
                                        <?php if ($template == 'template1') { ?> 
                                        <div class="course-item educatito-hover-icon">
                                            <div class="course-thumbnail">
                                                <?php if (!empty($image)) {
                                                    ?>
                                                    <img src="<?php echo esc_url($image); ?>" alt="<?php if (count($alt)) echo esc_attr($alt); ?>">
                                                <?php }
                                                ?>
                                                <div class="hover-border">
                                                    <a href="<?php echo esc_url(get_permalink()); ?>"><span class="fa fa-link"></span></a>
                                                </div>
                                            </div>
                                            <div class="educatito-course-content">
                                                <div class="author-price">
                                                    <?php
                                                    learn_press_course_instructor();
                                                    learn_press_course_price();
                                                    ?>
                                                </div>
                                                <div class="title">
                                                    <?php
                                                    do_action('learn_press_before_the_title');
                                                    the_title(sprintf('<h2 class="course-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>');
                                                    do_action('learn_press_after_the_title');
                                                    ?>
                                                </div>
                                                <div class="course-description">
                                                    <?php
                                                    echo the_excerpt(30);
                                                    ?>
                                                </div>
                                            </div> 
                                            <ul class="course-meta">
                                                <li>
                                                    <?php $user_count = $course->get_users_enrolled('append') ? $course->get_users_enrolled('append') : 0; ?>
                                                    <?php echo esc_attr($user_count) . '/' . esc_attr($_lp_students2); ?><span><?php echo esc_html__(' Student', 'educatito'); ?></span>
                                                </li>
                                                <li><?php echo get_the_date('j M, Y'); ?></li>
                                            </ul>
                                        </div>
                                        <?php
                                    }elseif ($template == 'template2') {
                                        $course = LP()->global['course'];
                                        ?>
                                        <div class="course-item">
                                            <div class="course-thumbnail">
                                                <?php if (!empty($image)) {
                                                    ?>
                                                    <img src="<?php echo esc_url($image); ?>" alt="<?php if (count($alt)) echo esc_attr($alt); ?>">
                                                <?php }
                                                ?>
                                                <div class="price">
                                                    <?php
                                                    learn_press_course_price();
                                                    ?>
                                                </div>
                                                <?php learn_press_course_instructor(); ?>
                                            </div>
                                            <div class="educatito-course-content">
                                                <div class="title">
                                                    <?php
                                                    do_action('learn_press_before_the_title');
                                                    the_title(sprintf('<h2 class="course-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>');
                                                    do_action('learn_press_after_the_title');
                                                    ?>
                                                </div>
                                                <div class="author-contain">
                                                    <div class="author">
                                                        <div class="value" itemprop="name">
                                                            <a href="<?php echo esc_url(learn_press_user_profile_link($course->post->post_author)); ?>">
                                                                <?php echo get_the_author(); ?>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <?php educatito_course_ratings(); ?>
                                                </div>
                                            </div> 
                                            <ul class="course-meta">
                                                <li>
                                                    <?php $user_count = $course->get_users_enrolled('append') ? $course->get_users_enrolled('append') : 0; ?>
                                                    <?php echo esc_attr($user_count) . '/' . esc_attr($_lp_students2); ?><span><?php echo esc_html__(' Student', 'educatito'); ?></span>
                                                </li>
                                                <li><?php echo get_the_date('j M, Y'); ?></li>
                                            </ul>
                                        </div>
                                    <?php }else { ?>
                                        <?php $course_id = get_the_ID(); ?>
                                        <div class="course-item">
                                            <div class="course-thumbnail">
                                                <?php if (!empty($image)) {
                                                    ?>
                                                    <img src="<?php echo esc_url($image); ?>" alt="<?php if (count($alt)) echo esc_attr($alt); ?>">
                                                <?php }
                                                ?>
                                                <div class="price">
                                                    <?php
                                                    learn_press_course_price();
                                                    ?>
                                                </div>
                                                <div class="box-duration">
                                                    <?php echo esc_html(get_post_meta($course_id, 'educatito_course_duration', true)); ?>
                                                </div>
                                            </div>
                                            <div class="educatito-course-content">
                                                <div class="title">
                                                    <?php
                                                    do_action('learn_press_before_the_title');
                                                    the_title(sprintf('<h2 class="course-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>');
                                                    do_action('learn_press_after_the_title');
                                                    ?>
                                                </div>
                                                <ul class="course-meta-kids">
                                                    <li><span><?php echo esc_html__(' Age : ', 'educatito'); ?></span><?php echo esc_html(get_post_meta($course_id, 'educatito_course_age', true)); ?></li>
                                                    <li>
                                                        <?php $user_count = $course->get_users_enrolled('append') ? $course->get_users_enrolled('append') : 0; ?>
                                                        <span><?php echo esc_html__(' Kids : ', 'educatito'); ?></span><?php echo esc_attr($user_count) . '/' . esc_attr($_lp_students2); ?>
                                                    </li>
                                                </ul>
                                            </div> 
                                            <div class="author-contain">
                                                <?php echo wp_kses_post($course->get_instructor()->get_profile_picture()); ?>
                                                <div class="author-ratings">
                                                    <div class="author">
                                                        <div class="value" itemprop="name">
                                                            <a href="<?php echo esc_url(learn_press_user_profile_link($course->post_author)); ?>">
                                                                <?php echo wp_kses_post($course->get_instructor_html()); ?>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <?php educatito_course_ratings(); ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </li>
                                <?php
                            endwhile;
                        endif;
                        ?>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Course Our -->
        <?php
        wp_reset_postdata();
        return ob_get_clean();
    }

endif;

if (!function_exists('educatito_our_course_admin')) {
    add_action('vc_before_init', 'educatito_our_course_admin');

    function educatito_our_course_admin() {
        vc_map(array(
            'name' => esc_html__('Course Our', 'educatito'),
            'base' => 'educatito_our_course',
            'icon' => get_template_directory_uri() . "/assets/images/icon/educatito-icon.png",
            'category' => esc_html__('JRB Themes', 'educatito'),
            'description' => esc_html__('Course grid for theme', 'educatito'),
            'params' => array(
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Template', 'educatito'),
                    "value" => array(
                        esc_html__('Template One', 'educatito') => "template1",
                        esc_html__('Template Two', 'educatito') => "template2",
                        esc_html__('Template Three', 'educatito') => "template3",
                    ),
                    "std" => "template1",
                    'param_name' => 'template',
                    'description' => esc_html__('Select template in our course gird.', 'educatito'),
                ),
                array(
                    "type" => "checkbox",
                    "class" => "",
                    "heading" => esc_html__("Disble Filter", 'educatito'),
                    "param_name" => "disable_filter",
                    "value" => "",
                    "description" => esc_html__("Please using checkbox to disable a filter.", 'educatito'),
                ),
                array(
                    "type" => "educatito_taxonomy",
                    "taxonomy" => "course_category",
                    "heading" => esc_html__("Categories", "educatito"),
                    "param_name" => "course_cat",
                    "class" => "",
                    "description" => __("Note: By default, all your projects will be displayed. <br>If you want to narrow output, select category(s) above. Only selected categories will be displayed.", "educatito")
                ),
                array(
                    "type" => "textfield",
                    "class" => "",
                    "heading" => esc_html__("Product Count", "educatito"),
                    "param_name" => "per_number",
                    "value" => "",
                    "group" => esc_html__("Build Query", "educatito"),
                    "description" => esc_html__('Please, enter number of post per page. Show all: -1.', "educatito")
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
