<?php

/*

 * Taxonomy checkbox list field

 */
function educatito_taxonomy_settings_field($settings, $value) {
    //$dependency = vc_generate_dependencies_attributes($settings);
    $terms_fields = array();
    $value_arr = $value;
    if (!is_array($value_arr)) {
        $value_arr = array_map('trim', explode(',', $value_arr));
    }

    if (!empty($settings['taxonomy'])) {
        $terms = get_terms($settings['taxonomy'], 'orderby=count&hide_empty=0');
        if ($terms && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                $terms_fields[] = sprintf(
                        '<label><input onclick="changeCategory(this);" id="%s" class="educatito_check_taxonomy %s" type="checkbox" name="%s" value="%s" %s/>%s</label>', $settings['param_name'] . '-' . $term->slug, $settings['param_name'] . ' ' . $settings['type'], $settings['param_name'], $term->term_id, checked(in_array($term->term_id, $value_arr), true, false), $term->name
                );
            }
        }
    }
    return '<div class="educatito_taxonomy_block">'
            . '<input type="hidden" name="' . $settings['param_name'] . '" class="wpb_vc_param_value wpb-checkboxes ' . $settings['param_name'] . ' ' . $settings['type'] . '_field" value="' . $value . '" />'
            . '<div class="educatito_taxonomy_terms">'
            . implode($terms_fields)
            . '</div>'
            . '</div>';
    
    
}
//WpbakeryShortcodeParams::addField('educatito_taxonomy', 'educatito_taxonomy_settings_field', EDUCATITO_PLUGIN_URL . '/meta-options/js/custom_checkbox_vc.js');
//WpbakeryShortcodeParams::addField('educatito_taxonomy', 'educatito_taxonomy_settings_field');
vc_add_shortcode_param( 'educatito_taxonomy', 'educatito_taxonomy_settings_field', EDUCATITO_PLUGIN_URL . '/inc/meta-options/js/custom_checkbox_vc.js' );