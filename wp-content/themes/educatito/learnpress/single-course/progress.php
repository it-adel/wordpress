<?php
/**
 * @author        JRB Themes
 * @package       LearnPress/Templates
 * @version       3.0.0
 */
defined('ABSPATH') || exit();

$course = LP()->course;
if (!$course) {
    return;
}
$status = LP()->user->get('course-status', $course->id);
if (!$status) {
    return;
}

$num_of_decimal = 0;
$result = $course->evaluate_course_results();
$current = round($result * 100, $num_of_decimal);
$passing_condition = round($course->passing_condition, $num_of_decimal);
$passed = $current >= $passing_condition;
$heading = apply_filters('learn_press_course_progress_heading', $status == 'finished' ? esc_html__('Your result', 'educatito') : esc_html__('Learning progress', 'educatito'));
?>
<div class="lp-course-progress<?php echo wp_kses_post($passed) ? ' passed' : ''; ?>" data-value="<?php echo esc_attr($current); ?>" data-passing-condition="<?php echo wp_kses_post($passing_condition); ?>">
    <?php if ($heading !== false): ?>
        <?php /* translators: %s: result */ ?>
        <label class="lp-course-progress-heading"><?php echo wp_kses_post($heading); ?><span class="value result"><?php echo sprintf(wp_kses_post('%s%%', 'educatito'), esc_attr($current)); ?></span></label>
    <?php endif; ?>
    <div class="lp-progress-bar value">
        <div class="lp-progress-value" style="width: <?php echo esc_attr($result) * 100; ?>%;">
        </div>
    </div>
</div>