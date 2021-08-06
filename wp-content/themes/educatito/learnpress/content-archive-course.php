<?php
/**
 * Template for displaying archive course content
 *
 * @author  JRB Themes
 * @package LearnPress/Templates
 * @version 3.0.0
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
global $post, $wp_query, $lp_tax_query, $educatito_options;
$course_layout = (isset($educatito_options['jrb_courses_templates']) && $educatito_options['jrb_courses_templates'] != '') ? $educatito_options['jrb_courses_templates'] : 'list';
$course_class = '';
if ($course_layout == 'list') {
    $course_class = 'course-list';
}else {
    $course_class = 'course-grid';
}
if (isset($_GET['layout']) && $_GET['layout'] == 'list') {
    $course_layout = 'list';
    $course_class = 'course-list';
} else if (isset($_GET['layout']) && $_GET['layout'] == 'grid') {
    $course_layout = 'grid';
    $course_class = 'course-grid';
}
$edu_content = 'uk-width-large-1-1 uk-width-medium-1-1 uk-width-small-1-1 uk-width-1-1 educatito-content archive-content archive-course';
$col_sidebar = '';
$sidebar_display = '';
if (is_active_sidebar('educatito_sidebar_lp_course') && ($educatito_options['jrb_courses_layout'] != 'full' )) {

    $edu_content = 'uk-width-large-2-3 uk-width-medium-2-3 uk-width-small-1-1 uk-width-1-1 educatito-content archive-content archive-course';
    $col_sidebar = 'uk-width-large-1-3 uk-width-medium-1-3 uk-width-small-1-1 uk-width-1-1 course-sidebar';
    if (!empty($educatito_options['jrb_courses_layout']) && $educatito_options['jrb_courses_layout'] == 'left') {
        $col_sidebar .= ' sidebar-left';
        $edu_content .= ' content-right';
        $sidebar_display = 'sidebar_display';
    } else {
        $col_sidebar .= ' sidebar-right';
        $edu_content .= ' content-left';
    }
}
?>
<div class="uk-container uk-container-center educatito_layout_content <?php echo esc_attr($course_class); ?>">
    <div class="uk-grid <?php echo esc_attr($sidebar_display); ?>">
        <div class="<?php echo esc_attr($edu_content); ?>">
            <div class="educatito-course-wrap">
                <?php if (LP()->wp_query->have_posts()) : ?>

                    <?php do_action('learn_press_before_courses_loop'); ?>

                    <div class="uk-grid">
                        <?php while ( LP()->wp_query->have_posts() ) : LP()->wp_query->the_post(); ?>

                            <?php learn_press_get_template_part('content', 'course-' . $course_layout); ?>

                        <?php endwhile; ?>

                    </div>
                    <?php
                    if (!empty($educatito_options)) {
                        if (isset($educatito_options['jrb_archive_courses_show_pagination']) && $educatito_options['jrb_archive_courses_show_pagination'] == 1) {
                            educatito_pagination_2(LP()->wp_query);
                        }
                    } else {
                        educatito_pagination_2(LP()->wp_query);
                    }
                     ?>
                <?php else: ?>
                    <?php learn_press_display_message(__('No course found.', 'educatito'), 'error'); ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="educatito_sidebar <?php echo esc_attr($col_sidebar); ?>">
            <div id="secondary" class="widget-area">
                <div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
                    <?php educatito_dynamic_sidebar('educatito_sidebar_lp_course'); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php do_action('learn_press_after_main_content'); ?>
<?php 
if (is_active_sidebar('educatito_testimonial_footer')) :
    educatito_dynamic_sidebar('educatito_testimonial_footer');
endif;
?>








