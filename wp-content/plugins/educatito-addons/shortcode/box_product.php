<?php
/**
 * Shortcode Box Product.
 *
 * @package Educatito
 * @author JRB Themes
 * @link http://jrbthemes.com/
 */
/* -------------------Box Product---------------------- */
if (!function_exists('educatito_box_product_template')):
    $icon_margin = '';
    $main_heading_style = $main_heading_color = $content_style = $content_color = '';
    $main_heading_style_inline = $icon_inline = $order_list_title = $order_list_content = $content_style_inline = '';
    $line_heading_style = $wrapper_style = '';
    $sub_heading = $sub_heading_style_inline = '';

    function educatito_box_product_template($attr, $content = null) {
        extract(shortcode_atts(array(
            'image' => '',
            'order_list_title' => '',
            'order_list_content' => '',
            "main_heading_font_size" => "",
            "main_heading_line_height" => "",
            "main_heading_font_family" => "",
            "main_heading_style" => "",
            "main_heading_color" => "",
            "content_font_size" => "",
            "content_line_height" => "",
            "content_font_family" => "",
            "content_style" => "",
            "content_color" => "",
            "sub_heading" => "",
            "sub_heading_font_size" => "",
            "sub_heading_line_height" => "",
            "sub_heading_font_family" => "",
            "sub_heading_style" => "",
            "sub_heading_color" => "",
            "spacer" => "no_line",
            "line_style" => "solid",
            "line_width" => "auto",
            "line_height" => "1",
            "line_color" => "#9d9d9d",
            'line_alignment' => 'left',
            'wrapper_style' => '',
            'main_heading_style_inline' => '',
            'line_heading_style' => '',
            'sub_heading_style_inline' => '',
            'content_style_inline' => '',
            'button_text' => '',
            'button_link' => '',
            'button_color' => '',
            'button_color_hover' => '',
            'button_line_height' => '',
            'button_border_radius' => '',
            'button_border_color' => '',
            'button_border_color_hover' => '',
            'button_border_width' => '',
            'button_text_color' => '',
            'button_text_hover_color' => '',
            'background_color' => '',
            'el_class' => '',
                        ), $attr));


        $output = $content_style = $link = '';

        $link = apply_filters('ult_get_img_single', $image, 'url');

        /* ---- main heading styles ---- */
        if ($main_heading_font_family != '') {
            $mhfont_family = get_ultimate_font_family($main_heading_font_family);
            if ($mhfont_family)
                $main_heading_style_inline .= 'font-family:\'' . $mhfont_family . '\';';
        }
        // main heading font style
        if ($main_heading_style != '')
            $main_heading_style_inline .= get_ultimate_font_style($main_heading_style);
        //attach font size if set
        //attach font color if set
        if ($main_heading_color != '')
            $main_heading_style_inline .= 'color:' . $main_heading_color . ';';

        if (is_numeric($main_heading_font_size) && $main_heading_font_size != '') {
            $main_heading_style_inline .= 'font-size:' . $main_heading_font_size . 'px;';
        }
        if (is_numeric($main_heading_line_height) && $main_heading_line_height != '') {
            $main_heading_style_inline .= 'line-height:' . $main_heading_line_height . 'px;';
        }
        /* ---- Line heading styles ---- */
        if ($spacer != 'line_only') {
            $wrapper_style .= 'display:none;';
        } else {
            $line_heading_style .= 'border-style:' . $line_style . ';';
            $line_heading_style .= 'border-bottom-width:' . $line_height . 'px;';
            $line_heading_style .= 'border-color:' . $line_color . ';';
            $line_heading_style .= 'width:' . $line_width . 'px;';
            $wrapper_style .= 'height:' . $line_height . 'px;';
            if ($line_alignment != 'left') {
                if ($line_alignment != 'right') {
                    $line_heading_style .= 'margin: 0 auto;';
                } else {
                    $line_heading_style .= 'float:right;';
                }
            }
        }
        /* ---- Sub heading styles ---- */
        if ($sub_heading_font_family != '') {
            $sufont_family = get_ultimate_font_family($sub_heading_font_family);
            if ($sufont_family)
                $sub_heading_style_inline .= 'font-family:\'' . $sufont_family . '\';';
        }

        if ($sub_heading_style != '')
            $sub_heading_style_inline .= get_ultimate_font_style($sub_heading_style);

        if ($sub_heading_color != '')
            $sub_heading_style_inline .= 'color:' . $sub_heading_color . ';';

        if (is_numeric($sub_heading_font_size) && $sub_heading_font_size != '') {
            $sub_heading_style_inline .= 'font-size:' . $sub_heading_font_size . 'px;';
        }
        if (is_numeric($sub_heading_line_height) && $sub_heading_line_height != '') {
            $sub_heading_style_inline .= 'line-height:' . $sub_heading_line_height . 'px;';
        }
        /* ----- Content heading styles ----- */
        if ($content_font_family != '') {
            $shfont_family = get_ultimate_font_family($content_font_family);
            if ($shfont_family != '')
                $content_style_inline .= 'font-family:\'' . $shfont_family . '\';';
        }
        //sub heaing font style
        if ($content_style != '')
            $content_style_inline .= get_ultimate_font_style($content_style);

        //attach font color if set
        if ($content_color != '')
            $content_style_inline .= 'color:' . $content_color . ';';

        if (is_numeric($content_font_size) && $content_font_size != '') {
            $content_style_inline .= 'font-size:' . $content_font_size . 'px;';
        }
        if (is_numeric($content_line_height) && $content_line_height != '') {
            $content_style_inline .= 'line-height:' . $content_line_height . 'px;';
        }
        $btn_style = '';
        if ($button_color != '') {
            $btn_style .= 'background:' . $button_color . ';';
        }
        if ($button_line_height != '') {
            $btn_style .= 'line-height:' . $button_line_height . ';';
        }
        if ($button_border_radius != '') {
            $btn_style .= 'border-radius:' . $button_border_radius . ';';
        }
        if ($button_border_color != '') {
            $btn_style .= 'border-color:' . $button_border_radius . ';';
        }
        if ($button_border_width != '') {
            $btn_style .= 'border-width:' . $button_border_width . ';';
        }
        if ($button_text_color != '') {
            $btn_style .= 'color:' . $button_text_color . ';';
        }

        $button_link_main = $title_link = $target = '';

        if ($button_link != '') {
            $button_link_temp = vc_build_link($button_link);
            $button_link_main = $button_link_temp['url'];
            $title_link = $button_link_temp['title'];
            $target = $button_link_temp['target'];
        }
        if ($button_link_main == '')
            $button_link_main = 'javascript:void(0);';


        $micro = rand(0000, 9999);
        $id = uniqid('faq-' . $micro);
        $uid = 'uvc-' . rand(0000, 9999);

        $list_icon_id = 'list-icon-wrap-' . rand(1000, 9999);

        $output .= '<div id="' . esc_attr($list_icon_id) . '" class="educatito-box-product uk-clearfix ' . esc_attr($el_class) . '">';

        $output .= ' <div class="box-content-left">
                                <div class="flex-box">
                                    <div class="content">';
        $output .= '<div class = "box-body">';
        if ($button_text != '') {
            if ($target != '')
                $target = 'target="' . $target . '"';
            $output .= '<div class="box-link">';
            $output .= '<a href="' . $button_link_main . '" style="' . $btn_style . '" class="btn" ' . $target . '>' . $button_text . '</a>';
            $output .= '</div>';
        }
        $output .= '<h3 class="title" style="' . $main_heading_style_inline . '">' . esc_attr($order_list_title) . '</h3>';
        $output .= '<div class="uvc-heading-spacer" style="' . $wrapper_style . '">';
        $output .= '<span class="uvc-headings-line" style="' . $line_heading_style . '"></span>';
        $output .= '</div>';
        $output .= '<div class="sub-heading" style="' . $sub_heading_style_inline . '">' . esc_attr($sub_heading) . '</div>';
        $output .= '<div class="content-p" style="' . $content_style_inline . '">' . wpb_js_remove_wpautop(apply_filters('the_content', $order_list_content), true) . '</div>';
        $output .= '</div>';
        $output .= '</div>';
        $output .= '</div>';
        $output .= '</div>';

        $output .= '<div class="box-content-right">';
        $output .= '<div class="box-image educatito-img-hvr-shin" >';
        $output .= '<img class="image" src="' . esc_url($link) . '" alt="' . esc_attr($order_list_title) . '">';
        $output .= '</div>';
        $output .= '</div>';
        $output .= '</div>';

        if ($button_text_hover_color != '' || $button_color_hover != '') {
            ?>
            <style type="text/css">
                <?php echo "#" . $list_icon_id ?>.educatito-box-product .flex-box .box-body .box-link .btn:hover{
                    color: <?php echo $button_text_hover_color; ?> !important;
                    background: <?php echo $button_color_hover; ?> !important;
                }
            </style>
            <?php
        }
        if ($background_color != '') {
            ?>
            <style type="text/css">
                <?php echo "#" . $list_icon_id ?>.educatito-box-product{
                    background: <?php echo $background_color; ?> !important;
                }
            </style>
            <?php
        }
        return $output;
    }

endif;

if (!function_exists('educatito_box_product_admin')) {
    add_action('vc_before_init', 'educatito_box_product_admin');

    function educatito_box_product_admin() {
        vc_map(array(
            'name' => esc_html__('Box Product', 'educatito'),
            'base' => 'educatito_box_product',
            'icon' => get_template_directory_uri() . "/assets/images/icon/educatito-icon.png",
            'category' => esc_html__('JRB Themes', 'educatito'),
            'description' => esc_html__('Info box for theme.', 'educatito'),
            'params' => array(
                array(
                    "type" => "ult_img_single",
                    "heading" => esc_html__("Image Intro", 'educatito'),
                    "param_name" => "image",
                    'value' => '',
                    "description" => esc_html__("Either upload a new, or choose an existing image from your media library", 'educatito')
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Heading', 'educatito'),
                    'param_name' => 'order_list_title',
                    'holder' => 'div',
                    'value' => ''
                ),
                array(
                    "type" => "ult_param_heading",
                    "text" => esc_html__("Background Settings", 'educatito'),
                    "param_name" => "background_typograpy",
                    "group" => "Typography",
                    "class" => "ult-param-heading",
                    'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
                ),
                array(
                    "type" => "colorpicker",
                    "class" => "",
                    "heading" => esc_html__("Background Color", 'educatito'),
                    "param_name" => "background_color",
                    "value" => "",
                    "group" => "Typography"
                ),
                array(
                    "type" => "ult_param_heading",
                    "text" => esc_html__("Heading Settings", 'educatito'),
                    "param_name" => "main_heading_typograpy",
                    //"dependency" => Array("element" => "main_heading", "not_empty" => true),
                    "group" => "Typography",
                    "class" => "ult-param-heading",
                    'edit_field_class' => 'ult-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
                ),
                array(
                    "type" => "ultimate_google_fonts",
                    "heading" => esc_html__("Font Family", 'educatito'),
                    "param_name" => "main_heading_font_family",
                    "description" => esc_html__("Select the font of your choice.", 'educatito') . " " . esc_html__("You can", 'educatito') . " <a target='_blank' href='" . admin_url('admin.php?page=bsf-google-font-manager') . "'>" . esc_html__("add new in the collection here", 'educatito') . "</a>.",
                    //"dependency" => Array("element" => "main_heading", "not_empty" => true),
                    "group" => "Typography"
                ),
                array(
                    "type" => "ultimate_google_fonts_style",
                    "heading" => esc_html__("Font Style", 'educatito'),
                    "param_name" => "main_heading_style",
                    //"description"	=>	__("Main heading font style", "smile"),
                    //"dependency" => Array("element" => "main_heading", "not_empty" => true),
                    "group" => "Typography"
                ),
                // Responsive Param
                array(
                    "type" => "number",
                    //"class" => "font-size",
                    "heading" => esc_html__("Font size", 'educatito'),
                    "param_name" => "main_heading_font_size",
                    "value" => '',
                    "min" => 0,
                    "max" => 100,
                    "suffix" => "px",
                    "group" => "Typography"
                ),
                array(
                    "type" => "colorpicker",
                    "class" => "",
                    "heading" => esc_html__("Font Color", 'educatito'),
                    "param_name" => "main_heading_color",
                    "value" => "",
                    //"description" => __("Main heading color", "smile"),
                    //"dependency" => Array("element" => "main_heading", "not_empty" => true),
                    "group" => "Typography"
                ),
                // responsive
                array(
                    "type" => "number",
                    //"class" => "font-size",
                    "heading" => esc_html__("Line Height", 'educatito'),
                    "param_name" => "main_heading_line_height",
                    "value" => '',
                    "min" => 0,
                    "max" => 100,
                    "suffix" => "px",
                    "group" => "Typography"
                ),
                //------------------------------------------//
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Sub Heading', 'educatito'),
                    'param_name' => 'sub_heading',
                    'value' => ''
                ),
                array(
                    "type" => "ult_param_heading",
                    "text" => esc_html__("Sub Heading Settings", 'educatito'),
                    "param_name" => "sub_heading_typograpy",
                    //"dependency" => Array("element" => "content", "not_empty" => true),
                    "group" => "Typography",
                    "class" => "ult-param-heading",
                    'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
                ),
                array(
                    "type" => "ultimate_google_fonts",
                    "heading" => esc_html__("Font Family", 'educatito'),
                    "param_name" => "sub_heading_font_family",
                    "description" => esc_html__("Select the font of your choice.", 'educatito') . " " . esc_html__("You can", 'educatito') . " <a target='_blank' href='" . admin_url('admin.php?page=bsf-google-font-manager') . "'>" . esc_html__("add new in the collection here", 'educatito') . "</a>.",
                    //"dependency" => Array("element" => "content", "not_empty" => true),
                    "group" => "Typography",
                ),
                array(
                    "type" => "ultimate_google_fonts_style",
                    "heading" => esc_html__("Font Style", 'educatito'),
                    "param_name" => "sub_heading_style",
                    //"description"	=>	__("Sub heading font style", "smile"),
                    //"dependency" => Array("element" => "content", "not_empty" => true),
                    "group" => "Typography",
                ),
                // responsive font size
                array(
                    "type" => "number",
                    //"class" => "font-size",
                    "heading" => esc_html__("Font size", 'educatito'),
                    "param_name" => "sub_heading_font_size",
                    "value" => '',
                    "min" => 0,
                    "max" => 100,
                    "suffix" => "px",
                    "group" => "Typography"
                ),
                array(
                    "type" => "colorpicker",
                    "class" => "",
                    "heading" => esc_html__("Font Color", 'educatito'),
                    "param_name" => "sub_heading_color",
                    "value" => "",
                    //"description" => esc_html__("Sub heading color", 'educatito'),
                    //"dependency" => Array("element" => "content", "not_empty" => true),
                    "group" => "Typography",
                ),
                array(
                    "type" => "number",
                    //"class" => "font-size",
                    "heading" => esc_html__("Line Height", 'educatito'),
                    "param_name" => "sub_heading_line_height",
                    "value" => '',
                    "min" => 0,
                    "max" => 100,
                    "suffix" => "px",
                    "group" => "Typography"
                ),
                //-----------------------------------------//
                array(
                    "type" => "textarea_html",
                    "edit_field_class" => "ult_hide_editor_fullscreen vc_col-xs-12 vc_column wpb_el_type_textarea_html vc_wrapper-param-type-textarea_html vc_shortcode-param",
                    "heading" => esc_html__("Content (Optional)", 'educatito'),
                    "param_name" => "order_list_content",
                    "value" => "",
                //"description" => __("Sub heading text", "smile"),
                ),
                array(
                    "type" => "ult_param_heading",
                    "text" => esc_html__("Content Settings", 'educatito'),
                    "param_name" => "content_typograpy",
                    //"dependency" => Array("element" => "content", "not_empty" => true),
                    "group" => "Typography",
                    "class" => "ult-param-heading",
                    'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
                ),
                array(
                    "type" => "ultimate_google_fonts",
                    "heading" => esc_html__("Font Family", 'educatito'),
                    "param_name" => "content_font_family",
                    "description" => esc_html__("Select the font of your choice.", 'educatito') . " " . __("You can", 'educatito') . " <a target='_blank' href='" . admin_url('admin.php?page=bsf-google-font-manager') . "'>" . __("add new in the collection here", 'educatito') . "</a>.",
                    //"dependency" => Array("element" => "content", "not_empty" => true),
                    "group" => "Typography",
                ),
                array(
                    "type" => "ultimate_google_fonts_style",
                    "heading" => esc_html__("Font Style", 'educatito'),
                    "param_name" => "content_style",
                    //"description"	=>	__("Sub heading font style", "smile"),
                    //"dependency" => Array("element" => "content", "not_empty" => true),
                    "group" => "Typography",
                ),
                // responsive font size
                array(
                    "type" => "number",
                    "class" => "",
                    "heading" => esc_html__("Font Size", 'educatito'),
                    "param_name" => "content_font_size",
                    "value" => '',
                    "min" => 0,
                    "max" => 100,
                    "suffix" => "px",
                    "group" => "Typography"
                ),
                array(
                    "type" => "colorpicker",
                    "class" => "",
                    "heading" => esc_html__("Font Color", 'educatito'),
                    "param_name" => "content_color",
                    "value" => "",
                    //"description" => __("Sub heading color", "smile"),
                    //"dependency" => Array("element" => "content", "not_empty" => true),
                    "group" => "Typography",
                ),
                // responsive
                array(
                    "type" => "number",
                    "class" => "",
                    "heading" => esc_html__("Line Height", 'educatito'),
                    "param_name" => "content_line_height",
                    "value" => '',
                    "min" => 0,
                    "max" => 100,
                    "suffix" => "px",
                    "group" => "Typography"
                ),
                array(
                    "type" => "dropdown",
                    "class" => "",
                    "heading" => esc_html__("Seperator", 'educatito'),
                    "param_name" => "spacer",
                    "value" => array(
                        esc_html__("No Line", 'educatito') => "no_line",
                        esc_html__("Line", 'educatito') => "line_only",
                    ),
                    "description" => esc_html__("Line bottom", 'educatito'),
                ),
                array(
                    "type" => "dropdown",
                    "class" => "",
                    "heading" => esc_html__("Line Style", 'educatito'),
                    "param_name" => "line_style",
                    "value" => array(
                        esc_html__("Solid", 'educatito') => "solid",
                        esc_html__("Dashed", 'educatito') => "dashed",
                        esc_html__("Dotted", 'educatito') => "dotted",
                        esc_html__("Double", 'educatito') => "double",
                        esc_html__("Inset", 'educatito') => "inset",
                        esc_html__("Outset", 'educatito') => "outset",
                    ),
                    //"description" => esc_html__("Select the line style.",'educatito'),
                    "dependency" => Array("element" => "spacer", "value" => "line_only"),
                ),
                array(
                    "type" => "number",
                    "class" => "",
                    "heading" => esc_html__("Line Width (optional)", 'educatito'),
                    "param_name" => "line_width",
                    //"value" => 250,
                    //"min" => 150,
                    //"max" => 500,
                    "suffix" => "px",
                    //"description" => esc_html__("Set line width", 'educatito'),
                    "dependency" => Array("element" => "spacer", "value" => "line_only"),
                ),
                array(
                    "type" => "number",
                    "class" => "",
                    "heading" => esc_html__("Line Height", 'educatito'),
                    "param_name" => "line_height",
                    "value" => 1,
                    "min" => 1,
                    "max" => 500,
                    "suffix" => "px",
                    //"description" => esc_html__("Set line height", 'educatito'),
                    "dependency" => Array("element" => "spacer", "value" => "line_only"),
                ),
                array(
                    "type" => "colorpicker",
                    "class" => "",
                    "heading" => esc_html__("Line Color", 'educatito'),
                    "param_name" => "line_color",
                    "value" => "#333333",
                    //"description" => esc_html__("Select color for line.", 'educatito'),
                    "dependency" => Array("element" => "spacer", "value" => "line_only"),
                ),
                array(
                    "type" => "dropdown",
                    "class" => "",
                    "heading" => esc_html__("Alignment", 'educatito'),
                    "param_name" => "line_alignment",
                    "value" => array(
                        esc_html__("Left", 'educatito') => "left",
                        esc_html__("Center", 'educatito') => "center",
                        esc_html__("Right", 'educatito') => "right"
                    ),
                    "dependency" => Array("element" => "spacer", "value" => "line_only"),
                ),
                array(
                    "type" => "checkbox",
                    "class" => "",
                    "heading" => __("Show button", "educatito"),
                    "param_name" => "show_button",
                    "value" => '',
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Button text', 'educatito'),
                    'param_name' => 'button_text',
                    'value' => '',
                    //'admin_label' => true,
                    'dependency' => array(
                        'element' => 'show_button',
                        'value' => 'true',
                    ),
                ),
                array(
                    "type" => "vc_link",
                    "class" => "",
                    "heading" => __("Link ", "educatito"),
                    "param_name" => "button_link",
                    "value" => "",
                    "description" => __("Add link / select existing page to link to this banner", "educatito"),
                    'dependency' => array(
                        'element' => 'show_button',
                        'value' => 'true',
                    ),
                ),
                array(
                    "type" => "ult_param_heading",
                    "param_name" => "title_text_typography",
                    "heading" => __("Button settings", "educatito"),
                    "value" => "",
                    "group" => "Custom Style",
                    'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
                    'dependency' => array(
                        'element' => 'show_button',
                        'value' => 'true',
                    ),
                ),
                array(
                    "type" => "colorpicker",
                    "heading" => __("Button Color", "educatito"),
                    "param_name" => "button_color",
                    "value" => "",
                    "group" => "Custom Style",
                    'dependency' => array(
                        'element' => 'show_button',
                        'value' => 'true',
                    ),
                ),
                array(
                    "type" => "colorpicker",
                    "heading" => __("Button Color Hover", "educatito"),
                    "param_name" => "button_color_hover",
                    "value" => "",
                    "group" => "Custom Style",
                    'dependency' => array(
                        'element' => 'show_button',
                        'value' => 'true',
                    ),
                ),
                array(
                    "type" => "colorpicker",
                    "class" => "",
                    "heading" => __("Text Color", "educatito"),
                    "param_name" => "button_text_color",
                    "value" => "",
                    "group" => "Custom Style",
                    'dependency' => array(
                        'element' => 'show_button',
                        'value' => 'true',
                    ),
                ),
                array(
                    "type" => "colorpicker",
                    "class" => "",
                    "heading" => __("Text Hover Color", "educatito"),
                    "param_name" => "button_text_hover_color",
                    "value" => "",
                    "group" => "Custom Style",
                    'dependency' => array(
                        'element' => 'show_button',
                        'value' => 'true',
                    ),
                ),
                array(
                    "type" => "number",
                    "heading" => __("Border Width", "educatito"),
                    "param_name" => "button_border_width",
                    "value" => "",
                    "suffix" => "px",
                    "group" => "Custom Style",
                    'dependency' => array(
                        'element' => 'show_button',
                        'value' => 'true',
                    ),
                ),
                array(
                    "type" => "colorpicker",
                    "class" => "",
                    "heading" => __("Border Color", "educatito"),
                    "param_name" => "button_border_color",
                    "value" => "",
                    "group" => "Custom Style",
                    'dependency' => array(
                        'element' => 'show_button',
                        'value' => 'true',
                    ),
                ),
                array(
                    "type" => "colorpicker",
                    "class" => "",
                    "heading" => __("Border Hover Color", "educatito"),
                    "param_name" => "button_border_hover_color",
                    "value" => "",
                    "group" => "Custom Style",
                    'dependency' => array(
                        'element' => 'show_button',
                        'value' => 'true',
                    ),
                ),
                array(
                    "type" => "number",
                    "heading" => __("Border Radius", "educatito"),
                    "param_name" => "button_border_radius",
                    "value" => "",
                    "suffix" => "px",
                    "group" => "Custom Style",
                    'dependency' => array(
                        'element' => 'show_button',
                        'value' => 'true',
                    ),
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
    