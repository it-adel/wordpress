<?php
$wp_query = $GLOBALS["educatito_happening_events"];
?>
<li class="content-inner post-event-page" id="tab-happening">
   
	<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

		<?php get_template_part( 'wp-events-manager/content', 'event' ); ?>

	<?php endwhile; ?>
	<?php wp_reset_postdata(); ?>
        
</li>
