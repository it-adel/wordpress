<?php
/**
 * Shortcode Testimonial.
 *
 * @package Educatito
 * @author JRB Themes
 * @link http://educa.jrbthemes.com
 */
/* -------------------Testimonial---------------------- */

if (!function_exists('educatito_testimonial_template')):

    function educatito_testimonial_template($attr) {
        ob_start();
        $title_color = $content_color = $bg_color = '';
        extract(shortcode_atts(array(
            'template' => 'template1',
            'title_color' => '',
            'content_color' => '',
            'bg_color' => '',
            'autoplay' => 'true',
            //'show_image' => 1,
            'el_class' => '',
                        ), $attr));
        $args = array(
            'post_type' => 'testimonial',
            'post_status' => 'publish',
            'posts_per_page' => '-1',
            'orderby' => 'date',
            'order' => 'DESC',
        );
        $the_query = new WP_Query($args);
        $rand_grid = rand(5, 1231564613);
        $id_testimonial = md5(time() . ' ' . $rand_grid);

        if ($title_color != '')
            $title_color = 'style=color:' . $title_color . ';';
        if ($content_color != '')
            $content_color = 'style=color:' . $content_color . ';';
        if ($bg_color != '')
            $bg_color = 'style=background:' . $bg_color . ';';
        ?>
        <!-- Begin Testimonial -->
        <div id="<?php echo "educatito_testimonial_" . esc_attr($id_testimonial); ?>" class="educatito-testimonial <?php echo esc_attr($template) . " " . esc_attr($el_class); ?>" <?php if ($template == 'template2') echo esc_attr($bg_color); ?> >
            <div class="bd-container uk-container-center <?php if ($template == 'template7') { ?> uk-container <?php } ?> ">
                <?php if ($template == 'template7') { ?> <div class="uk-grid box-testimonial"> <?php } ?>
                <?php
                if ($template == 'template1') {
                    ?>
                        <div class="testimonial-slick">
                            <ul class="slick-slider slick-testimonial">
                                <?php
                                if ($the_query->have_posts()) :
                                    while ($the_query->have_posts()) : $the_query->the_post();
                                        $post_id = get_the_ID();
                                        $name_author = get_the_title();
                                        $url = wp_get_attachment_url(get_post_thumbnail_id($post_id));
                                        $position = get_post_meta($post_id, 'position', true);

                                        $thumb_id = get_post_thumbnail_id($post_id);
                                        $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
                                        ?> 
                                        <li>
                                            <div class="box">
                                                <div class="box-img">
                                                    <img src="<?php echo esc_url($url); ?>" alt="<?php echo esc_attr($alt); ?>"/>
                                                </div>
                                                <div class="box-content" <?php echo esc_attr($bg_color); ?>>
                                                    <div class="box-content-h3">
                                                        <a href="#" class="author title"><h3 <?php echo esc_attr($content_color); ?>><?php echo esc_attr($name_author); ?></h3></a>
                                                    </div>
                                                    <div class="box-content-span">
                                                        <span class="primary-color"><?php echo esc_attr($position); ?></span>
                                                    </div>
                                                    <div class="box-content-p" <?php echo esc_attr($content_color); ?>>
                                                        <?php echo wp_trim_words(get_the_excerpt(), 20, '...') ?>
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
                        <?php
                    }elseif ($template == 'template2') {
                        ?>
                        <div class="group-testimonial">
                            <ul id="testimonial-slider">
                                <?php
                                if ($the_query->have_posts()) :
                                    while ($the_query->have_posts()) : $the_query->the_post();
                                        $post_id = get_the_ID();
                                        $name_author = get_the_title();
                                        $position = get_post_meta($post_id, 'position', true);
                                        ?> 
                                        <li>
                                            <div class="box-content" <?php echo esc_attr($content_color); ?>><?php the_content(); ?></div>
                                            <div class="box-author">
                                                <a href="#"><h3 class="author title" <?php echo esc_attr($title_color); ?>><?php echo esc_attr($name_author); ?></h3></a>
                                                <span class="box-position"><?php echo esc_attr($position); ?></span>
                                            </div>
                                        </li>
                                        <?php
                                    endwhile;
                                endif;
                                ?>
                            </ul>
                            <ul id="testimonial-carousel">
                                <?php
                                if ($the_query->have_posts()) :
                                    while ($the_query->have_posts()) : $the_query->the_post();
                                        $post_id = get_the_ID();
                                        $url = wp_get_attachment_url(get_post_thumbnail_id($post_id));
                                        $thumb_id = get_post_thumbnail_id($post_id);
                                        $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
                                        ?> 
                                        <li>
                                            <img src="<?php echo esc_url($url); ?>" alt="<?php echo esc_attr($alt); ?>">
                                        </li>  
                                        <?php
                                    endwhile;
                                endif;
                                ?>                          
                            </ul>
                        </div>
                        <?php
                    }elseif ($template == 'template3') {
                        ?>
                        <div class="testimonial-slick-v2">
                            <ul class="slick-slider slick-testimonial-v2">
                                <?php
                                if ($the_query->have_posts()) :
                                    while ($the_query->have_posts()) : $the_query->the_post();
                                        $post_id = get_the_ID();
                                        $name_author = get_the_title();
                                        $url = wp_get_attachment_url(get_post_thumbnail_id($post_id));
                                        $position = get_post_meta($post_id, 'position', true);
                                        $thumb_id = get_post_thumbnail_id($post_id);
                                        $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
                                        ?> 
                                        <li>
                                            <div class="box">
                                                <div class="box-content" <?php echo esc_attr($content_color); ?>>
                                                    <?php the_content() ?>
                                                </div>
                                                <div class="box-img">
                                                    <a href="#"><img src="<?php echo esc_url($url); ?>" alt="<?php echo esc_attr($alt); ?>"></a>
                                                </div>
                                            </div>
                                        </li>
                                        <?php
                                    endwhile;
                                endif;
                                ?>
                            </ul>
                        </div>
                        <?php
                    }elseif ($template == 'template6') {
                        ?>
                        <div class="testimonial-slick-v2">
                            <ul class="slick-slider slick-slider-tmp6 slick-testimonial-v2">
                                <?php
                                if ($the_query->have_posts()) :
                                    while ($the_query->have_posts()) : $the_query->the_post();
                                        $post_id = get_the_ID();
                                        $name_author = get_the_title();
                                        $url = wp_get_attachment_url(get_post_thumbnail_id($post_id));
                                        $position = get_post_meta($post_id, 'position', true);
                                        $thumb_id = get_post_thumbnail_id($post_id);
                                        $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
                                        ?> 
                                        <li>
                                            <div class="box">
                                                <div class="box-content" <?php echo esc_attr($content_color); ?>>
                                                    <?php the_content() ?>
                                                </div>
                                                <a href="#"><h3 class="author title" <?php echo esc_attr($title_color); ?>><?php echo esc_attr($name_author); ?></h3></a>
                                                <span class="box-position" <?php echo esc_attr($title_color); ?>><?php echo esc_attr($position); ?></span>
                                            </div>
                                        </li>
                                        <?php
                                    endwhile;
                                endif;
                                ?>
                            </ul>
                        </div>
                        <?php
                    }elseif ($template == 'template4') {
                        ?>
                        <div class="uk-slidenav-position" data-uk-slider="{autoplay: true, Interval: 4000}">
                            <div class="uk-slider-container">
                                <ul class="uk-slider uk-grid uk-grid-match uk-grid-width-medium-1-3 uk-grid-width-small-1-2 uk-grid-width-1-1">
                                    <?php
                                    if ($the_query->have_posts()) :
                                        while ($the_query->have_posts()) : $the_query->the_post();
                                            $post_id = get_the_ID();
                                            $name_author = get_the_title();
                                            $position = get_post_meta($post_id, 'position', true);
                                            $thumb_id = get_post_thumbnail_id($post_id);
                                            $url = wp_get_attachment_url($thumb_id);
                                            $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
                                            ?> 

                                            <li>
                                                <div class="box" <?php echo esc_attr($bg_color); ?>>
                                                    <i class="icon fa fa-quote-left" <?php echo esc_attr($title_color); ?>></i>
                                                    <div class="box-content" <?php echo esc_attr($content_color); ?>><?php the_content(); ?></div>
                                                    <div class="box-img">
                                                        <a href="#"><img src="<?php echo esc_url($url); ?>" alt="<?php echo esc_attr($alt); ?>"></a>
                                                    </div>
                                                    <a href="#"><h3 class="author title" <?php echo esc_attr($title_color); ?>><?php echo esc_attr($name_author); ?></h3></a>
                                                    <span class="box-position"><?php echo esc_attr($position); ?></span>
                                                </div>
                                            </li>
                                            <?php
                                        endwhile;
                                    endif;
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <?php
                    }elseif ($template == 'template5') {
                        ?>
                        <div class="testimonial-slick-v4 " >
                            <ul class="slick-slider slick-testimonial-v4">
                                <?php
                                if ($the_query->have_posts()) :
                                    while ($the_query->have_posts()) : $the_query->the_post();
                                        $post_id = get_the_ID();
                                        $name_author = get_the_title();
                                        $url = wp_get_attachment_url(get_post_thumbnail_id($post_id));
                                        $position = get_post_meta($post_id, 'position', true);

                                        $thumb_id = get_post_thumbnail_id($post_id);
                                        $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
                                        ?> 
                                        <li>
                                            <div class="box" <?php echo esc_attr($bg_color); ?>>
                                                <div class="box-content" <?php echo esc_attr($content_color); ?>>
                                                    <?php the_content() ?>
                                                </div>
                                                <div class="box-title">
                                                    <div class="box-title-img">
                                                        <img src="<?php echo esc_url($url); ?>" alt="<?php echo esc_attr($alt); ?>"/>
                                                    </div>
                                                    <h4 class="box-title-h4" <?php echo esc_attr($title_color); ?>><?php echo esc_attr($name_author); ?><span> / <?php echo esc_attr($position); ?></span></h4>
                                                </div>
                                            </div>
                                        </li>
                                        <?php
                                    endwhile;
                                endif;
                                ?>
                            </ul>
                        </div>
                        <?php
                    }else {
                        $item = 1;
                        if ($the_query->have_posts()) :
                            while ($the_query->have_posts()) : $the_query->the_post();
                                $post_id = get_the_ID();
                                $name_author = get_the_title();
                                $url = wp_get_attachment_url(get_post_thumbnail_id($post_id));
                                $position = get_post_meta($post_id, 'position', true);
                                $thumb_id = get_post_thumbnail_id($post_id);
                                $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
                                if (!empty($url)) {
                                    $image = educatito_image_resize($url, 273, 254, true);
                                }
                                ?>
                                <?php
                                if ($item == 3 || $item == 4) {
                                    ?>
                                    <div class="box uk-width-medium-1-2 uk-width-small-1-1 uk-width-1-1">
                                        <div class="uk-grid">
                                            <div class="uk-push-1-2 uk-width-medium-1-2 uk-width-small-1-2 uk-width-1-1 border-img">
                                                <div class="box-img educatito-hover-post">
                                                    <img src ="<?php echo esc_url($image); ?>" alt="<?php echo esc_url($alt); ?>">  
                                                </div> 
                                            </div>
                                            <div class="uk-pull-1-2 uk-width-medium-1-2 uk-width-small-1-2 uk-width-1-1 text-right">
                                                <div class="box-flex">
                                                    <div class="box-content">
                                                        <div class="box-content-text" <?php echo esc_attr($content_color); ?>>
                                                            <?php the_content() ?>
                                                        </div>
                                                        <div class="box-title" >
                                                            <span class="box-position"><?php echo esc_attr($position); ?></span>
                                                            <a href="#"><h3 class="author title" <?php echo esc_attr($title_color); ?>><?php echo esc_attr($name_author); ?></h3></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                } else {
                                    ?>
                                    <div class="box uk-width-medium-1-2 uk-width-small-1-1 uk-width-1-1">
                                        <div class="uk-grid">
                                            <div class="uk-width-medium-1-2 uk-width-small-1-2 uk-width-1-1">
                                                <div class="box-img educatito-hover-post">
                                                    <img src ="<?php echo esc_url($image); ?>" alt="<?php echo esc_url($alt); ?>">  
                                                </div>
                                            </div>
                                            <div class="uk-width-medium-1-2 uk-width-small-1-2 uk-width-1-1 box-flex">
                                                <div class="box-content">
                                                    <div class="box-content-text" <?php echo esc_attr($content_color); ?>>
                                                        <?php the_content() ?>
                                                    </div>
                                                    <div class="box-title" >
                                                        <span class="box-position"><?php echo esc_attr($position); ?></span>
                                                        <a href="#"><h3 class="author title" <?php echo esc_attr($title_color); ?>><?php echo esc_attr($name_author); ?></h3></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                $item++;
                            endwhile;
                        endif;
                        ?>
                    <?php } ?>
                    <?php if ($template == 'template7') { ?> </div> <?php } ?>
            </div>
        </div>
        <!-- End Testimonial -->
        <?php
        wp_reset_postdata();
        return ob_get_clean();
    }

endif;

if (!function_exists('educatito_testimonial_admin')) {
    add_action('vc_before_init', 'educatito_testimonial_admin');

    function educatito_testimonial_admin() {
        vc_map(array(
            'name' => esc_html__('Testimonial', 'educatito'),
            'base' => 'educatito_testimonial',
            'icon' => get_template_directory_uri() . "/assets/images/icon/educatito-icon.png",
//            'is_container' => true,
//            'show_settings_on_create' => false,
//            'as_parent' => array(
//                'only' => 'vc_tta_section',
//            ),
            'category' => esc_html__('JRB Themes', 'educatito'),
            'description' => esc_html__('Testimonial for theme', 'educatito'),
            'params' => array(
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Template', 'educatito'),
                    "value" => array(
                        esc_html__("Template 1", 'educatito') => "template1",
                        esc_html__("Template 2", 'educatito') => "template2",
                        esc_html__("Template 3", 'educatito') => "template3",
                        esc_html__("Template 4", 'educatito') => "template4",
                        esc_html__("Template 5", 'educatito') => "template5",
                        esc_html__("Template 6", 'educatito') => "template6",
                        esc_html__("Template 7", 'educatito') => "template7",
                    ),
                    "std" => "template1",
                    'param_name' => 'template',
                    'description' => esc_html__('Select template in testimonial.', 'educatito'),
                ),
                array(
                    "type" => "colorpicker",
                    "class" => "",
                    "heading" => esc_html__("Title Color", 'educatito'),
                    "param_name" => "title_color",
                    "value" => "",
                ),
                array(
                    "type" => "colorpicker",
                    "class" => "",
                    "heading" => esc_html__("Content Color", 'educatito'),
                    "param_name" => "content_color",
                    "value" => "",
                ),
                array(
                    "type" => "colorpicker",
                    "class" => "",
                    "heading" => esc_html__("Background Color", 'educatito'),
                    "param_name" => "bg_color",
                    "value" => "",
                ),
//                array(
//                    'type' => 'dropdown',
//                    'param_name' => 'autoplay',
//                    'value' => array(
//                        esc_html__('Yes', 'educatito') => 'true',
//                        esc_html__('No', 'educatito') => 'false',
//                    ),
//                    'std' => 'Yes',
//                    'heading' => esc_html__('Autoplay', 'educatito'),
//                    'description' => esc_html__('Select auto rotate for accordion in seconds (Note: disabled by default).', 'educatito'),
//                ),
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
    