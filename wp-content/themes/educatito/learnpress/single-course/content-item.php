<?php
/**
 * @author   JRBthemes
 * @package  Learnpress/Templates
 * @version  3.0.9
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

$user        = LP_Global::user();
$course_item = LP_Global::course_item();
$course      = LP_Global::course();
?>

<div id="learn-press-content-item">

	<?php do_action( 'learn-press/course-item-content-header' ); ?>

    <div class="content-item-scrollable">

        <div class="content-item-wrap">

			<?php
			/**
			 * @deprecated
			 */
			do_action( 'learn_press_before_content_item' );

			/**
			 * @since 3.0.0
			 *
			 */
			do_action( 'learn-press/before-course-item-content' );

			if ( $user->can_view_item( $course_item->get_id(), $course->get_id() ) ) {
				/**
				 * @deprecated
				 */
				do_action( 'learn_press_course_item_content' );

				/**
				 * @since 3.0.0
				 */
				do_action( 'learn-press/course-item-content' );

			} else {
				learn_press_get_template( 'single-course/content-protected.php' );
			}

			/**
			 * @since 3.0.0
			 */
			do_action( 'learn-press/after-course-item-content' );

			/**
			 * @deprecated
			 */
			do_action( 'learn_press_after_content_item' );
			?>

        </div>

    </div>

	<?php do_action( 'learn-press/course-item-content-footer' ); ?>

</div>