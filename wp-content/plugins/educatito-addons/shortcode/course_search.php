<?php
/**
 * Shortcode Course Search.
 *
 * @package Educatito
 * @author JRB Themes
 * @link http://educa.jrbthemes.com
 */
/* -------------------Course Search---------------------- */
if (!function_exists('educatito_course_search_template')):

    function educatito_course_search_template($atts) {
        ob_start();
        extract(shortcode_atts(array(
            'keyword' => '',
            'course_category' => '',
            '_lp_price' => '',
            'el_class' => '',
                        ), $atts));
        global $post;
        ?>
<div class="flat-form-keyword <?php echo esc_attr($el_class); ?>">
            <form class="form-search-course style2 bg-white " action="<?php echo esc_url(home_url('/course-search/')); ?>" method="post">
                <input type="hidden" name="search" value="advanced">
                <div class="field uk-clearfix">
                    <p class="field-search ">
                        <input type="text" size="30" placeholder="Keyword Search" name="keyword" id="keyword">
                    </p>
                    <p class="field-select-cate ">
                        <select class="select-category" name="course_category">
                            <option value="0"><?php echo esc_html__('Category Course','educatito') ?></option>
                            <?php
                            $terms = get_terms('course_category');
                            foreach ($terms as $term) {
                                ?>
                                <option value="<?php echo esc_attr($term->slug); ?>"><?php echo esc_attr($term->name); ?></option>
                            <?php } ?>
                        </select>
                    </p>
                    <p class="field-select-price">
                        <select class="select-price" name="_lp_price">
                            <option value="0"><?php echo esc_html__('Select Price Type','educatito') ?></option>
                            <?php
                            global $wpdb;
                            $results = $wpdb->get_results(
                                    "SELECT  p.ID,
                                                p.post_title,
                                                pm1.meta_value AS lp_price
                                            FROM    $wpdb->posts p 
                                             JOIN $wpdb->postmeta pm1 ON (
                                                pm1.post_id = p.ID  
                                            AND
                                                pm1.meta_key = '_lp_price'
                                            ) 
                                            WHERE  post_type = 'lp_course'
                                    ");
                            foreach ($results as $result) {
                                ?>
                                <option value="<?php echo esc_attr($result->lp_price); ?>"><?php echo esc_html__('$ ','educatito') . esc_attr($result->lp_price); ?></option>
                            <?php } ?>
                        </select>
                    </p>
                </div>
                <input class="comment-submit flat-button" type="submit" value="SEARCH">
            </form>
        </div>
        <?php
        $html_output = ob_get_contents();
        ob_end_clean();
        return $html_output;
    }

endif;

if (!function_exists('educatito_course_search_admin')) {
    add_action('vc_before_init', 'educatito_course_search_admin');

    function educatito_course_search_admin() {
        vc_map(array(
            'name' => esc_html__('Course Search', 'educatito'),
            'base' => 'educatito_course_search',
            'icon' => get_template_directory_uri() . "/assets/images/icon/educatito-icon.png",
            'category' => esc_html__('JRB Themes', 'educatito'),
            'description' => esc_html__('Course Search for theme.', 'educatito'),
            'params' => array(
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
    