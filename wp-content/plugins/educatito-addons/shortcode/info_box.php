<?php
/**
 * Shortcode Info Box.
 *
 * @package Educatito
 * @author JRB Themes
 * @link http://jrbthemes.com/
 */
/* -------------------Info Box---------------------- */
if (!function_exists('educatito_info_box_template')):

    function educatito_info_box_template($attr, $content = null) {
        $title_style = $desc_style = $output = $pos = '';
        extract(shortcode_atts(array(
            'icon' => 'none',
            'icon_sized' => '28',
            'icon_color' => '',
            'icon_hover_color' => '',
            'pos' => 'left',
            'icon_style' => 'none',
            'icon_color_bg' => '',
            'icon_color_bg_hover' => '',
            'icon_color_border' => '',
            'icon_color_hover_border' => '',
            'icon_border_style' => '',
            'icon_border_size' => '1',
            'icon_border_radius' => '',
            'icon_border_spacing' => '',
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
            'box_border' => '',
            'padding_left_right' => '',
            'padding_top_bottom' => '',
            'box_border_style' => '',
            'box_color_border' => '',
            'box_border_size' => 1,
            'box_radius' => 3,
            'title' => '',
            'title_font' => '',
            'title_font_style' => '',
            'title_font_size' => '',
            'title_font_line_height' => '',
            'title_font_color' => '',
            'desc_font' => '',
            'desc_font_style' => '',
            'desc_font_size' => '',
            'desc_font_color' => '',
            'desc_font_line_height' => '',
            'el_class' => '',
                        ), $attr));


        $style_icon = $style_icon_1 = $style_icon_2 = $style_box_icon_1 = $style_box_icon_2 = $style_box_icon_3 = '';
        if (!empty($icon_sized)) {
            $style_icon .= 'font-size: ' . $icon_sized . 'px;';
        }
        if (!empty($icon_color)) {
            $style_icon .= 'color: ' . $icon_color . ';';
        }

        if (!empty($icon_color_bg)) {
            $style_box_icon_1 .= 'background: ' . $icon_color_bg . ';';
            $style_box_icon_3 .= 'background: ' . $icon_color_bg . ';';
            $style_icon_2 .= 'background: ' . $icon_color_bg . ';';
        }
        if (!empty($icon_border_spacing)) {
            $style_box_icon_1 .= 'width: ' . $icon_border_spacing . 'px;';
            $style_box_icon_1 .= 'height: ' . $icon_border_spacing . 'px;';
            $line_height_1 = (int) $icon_border_spacing - 10 - ((int) $icon_border_size * 2);
            $style_box_icon_1 .= 'line-height: ' . $line_height_1 . 'px;';
            $style_box_icon_2 .= 'width: ' . $icon_border_spacing . 'px;';
            $style_box_icon_2 .= 'height: ' . $icon_border_spacing . 'px;';
            $style_box_icon_3 .= 'width: ' . $icon_border_spacing . 'px;';
            $style_box_icon_3 .= 'height: ' . $icon_border_spacing . 'px;';
            $style_box_icon_3 .= 'line-height: ' . $icon_border_spacing . 'px;';
        }
        if (!empty($icon_border_radius)) {
            $style_box_icon_1 .= 'border-radius: ' . $icon_border_radius . 'px;';
            $style_box_icon_2 .= 'border-radius: ' . $icon_border_radius . 'px;';
            $style_box_icon_3 .= 'border-radius: ' . $icon_border_radius . 'px;';
            $style_icon_1 .= 'border-radius: ' . $icon_border_radius . 'px;';
            $style_icon_2 .= 'border-radius: ' . $icon_border_radius . 'px;';
        }

        if (!empty($icon_border_size)) {
            $style_icon_1 .= 'border-width: ' . $icon_border_size . 'px;';
            $style_box_icon_2 .= 'border-width: ' . $icon_border_size . 'px;';
            $style_box_icon_3 .= 'border-width: ' . $icon_border_size . 'px;';
        }
        if (!empty($icon_border_style)) {
            $style_icon_1 .= 'border-style: ' . $icon_border_style . ';';
            $style_box_icon_2 .= 'border-style: ' . $icon_border_style . ';';
            $style_box_icon_3 .= 'border-style: ' . $icon_border_style . ';';
        }
        if (!empty($icon_color_border)) {
            $style_icon_1 .= 'border-color: ' . $icon_color_border . ';';
            $style_box_icon_2 .= 'border-color: ' . $icon_color_border . ';';
            $style_box_icon_3 .= 'border-color: ' . $icon_color_border . ';';
        }


        /* title */
        if ($title_font != '') {
            $font_family = get_ultimate_font_family($title_font);
            if ($font_family != '')
                $title_style .= 'font-family:\'' . $font_family . '\';';
            //array_push($font_args, $title_font);
        }
        if ($title_font_style != '')
            $title_style .= get_ultimate_font_style($title_font_style);
        // if($title_font_size != '')
        // 	$title_style .= 'font-size:'.$title_font_size.'px;';
        // if($title_font_line_height != '')
        // 	$title_style .= 'line-height:'.$title_font_line_height.'px;';

        if (is_numeric($title_font_size)) {
            $title_font_size = 'desktop:' . $title_font_size . 'px;';
        }
        if (is_numeric($title_font_line_height)) {
            $title_font_line_height = 'desktop:' . $title_font_line_height . 'px;';
        }
        $info_box_id = 'Info-box-wrap-' . rand(1000, 9999);
        $info_box_args = array(
            'target' => '#' . $info_box_id . ' .box-title', // set targeted element e.g. unique class/id etc.
            'media_sizes' => array(
                'font-size' => $title_font_size, // set 'css property' & 'ultimate_responsive' sizes. Here $title_responsive_font_size holds responsive font sizes from user input.
                'line-height' => $title_font_line_height
            ),
        );
        $info_box_data_list = get_ultimate_vc_responsive_media_css($info_box_args);

        if ($title_font_color != '')
            $title_style .= 'color:' . $title_font_color . ';';

        /* description */
        if ($desc_font != '') {
            $font_family = get_ultimate_font_family($desc_font);
            if ($font_family !== '')
                $desc_style .= 'font-family:\'' . $font_family . '\';';
            //array_push($font_args, $desc_font);
        }
        if ($desc_font_style != '')
            $desc_style .= get_ultimate_font_style($desc_font_style);
        // if($desc_font_size != '')
        // 	$desc_style .= 'font-size:'.$desc_font_size.'px;';
        // if($desc_font_line_height != '')
        // 	$desc_style .= 'line-height:'.$desc_font_line_height.'px;';

        if (is_numeric($desc_font_size)) {
            $desc_font_size = 'desktop:' . $desc_font_size . 'px;';
        }
        if (is_numeric($desc_font_line_height)) {
            $desc_font_line_height = 'desktop:' . $desc_font_line_height . 'px;';
        }

        $info_box_desc_args = array(
            'target' => '#' . $info_box_id . ' .box-description', // set targeted element e.g. unique class/id etc.
            'media_sizes' => array(
                'font-size' => $desc_font_size, // set 'css property' & 'ultimate_responsive' sizes. Here $title_responsive_font_size holds responsive font sizes from user input.
                'line-height' => $desc_font_line_height
            ),
        );
        $info_box_desc_data_list = get_ultimate_vc_responsive_media_css($info_box_desc_args);
        if ($desc_font_color != '')
            $desc_style .= 'color:' . $desc_font_color . ';';


        $ex_class = $ic_class = '';
        if ($pos != '') {
            $ex_class .= $pos . '-icon';
            $ic_class = 'box-icon-' . $pos;
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


        $class_box_border = $style_box_border = '';
        if ($box_border != '') {
            $class_box_border = 'box_border_flex';

            if (!empty($padding_left_right)) {
                $style_box_border .= 'padding-left:' . $padding_left_right . 'px;';
                $style_box_border .= 'padding-right:' . $padding_left_right . 'px;';
            }
            if (!empty($padding_top_bottom)) {
                $style_box_border .= 'padding-top:' . $padding_top_bottom . 'px;';
                $style_box_border .= 'padding-bottom:' . $padding_top_bottom . 'px;';
            }
            if (!empty($box_border_style)) {
                $style_box_border .= 'border-style:' . $box_border_style . ';';
            }
            if (!empty($box_color_border)) {
                $style_box_border .= 'border-color:' . $box_color_border . ';';
            }
            if (!empty($box_border_size)) {
                $style_box_border .= 'border-width:' . $box_border_size . 'px;';
            }
            if (!empty($box_radius)) {
                $style_box_border .= 'border-radius:' . $box_radius . 'px;';
            }
        }

        $output = '<div id="' . esc_attr($info_box_id) . '" class="educatito-info-box ' . esc_attr($class_box_border) . ' ' . esc_attr($el_class) . '" style="' . $style_box_border . '">';
        $output .= '<div class="bd-info-box ' . esc_attr($ex_class) . '">';
        if ($pos == 'left' || $pos == 'top') {
            if ($icon_style == 'style_1') {

                $output .= '<div class="' . $ic_class . '">';
                $output .= '<div class="box-icon-wrapper">';
                $output .= '<div class="box-icon ' . $icon_style . '" style="' . $style_box_icon_1 . '">';
                $output .= '<span class="icon ' . $icon . '" style="' . $style_icon . ' ' . $style_icon_1 . '"></span>';
                $output .= '</div>';
                if ($title != '') {
                    $output .= '<h3 class="box-title ult-responsive" ' . $info_box_data_list . ' style="' . $title_style . '">' . $title . '</h3>';
                }
                $output .= '</div>';
                $output .= '</div>';
            } elseif ($icon_style == 'style_2') {

                $output .= '<div class="' . $ic_class . '">';
                $output .= '<div class="box-icon-wrapper">';
                $output .= '<div class="box-icon ' . $icon_style . '" style="' . $style_box_icon_2 . '">';
                $output .= '<span class="icon ' . $icon . '" style="' . $style_icon . ' ' . $style_icon_2 . '"></span>';
                $output .= '</div>';
                if ($title != '') {
                    $output .= '<h3 class="box-title ult-responsive" ' . $info_box_data_list . ' style="' . $title_style . '">' . $title . '</h3>';
                }
                $output .= '</div>';
                $output .= '</div>';
            } elseif ($icon_style == 'style_3') {

                $output .= '<div class="' . $ic_class . '">';
                $output .= '<div class="box-icon-wrapper">';
                $output .= '<div class="box-icon ' . $icon_style . '" style="' . $style_box_icon_3 . '">';
                $output .= '<span class="icon ' . $icon . '" style="' . $style_icon . '"></span>';
                $output .= '</div>';
                if ($title != '') {
                    $output .= '<h3 class="box-title ult-responsive" ' . $info_box_data_list . ' style="' . $title_style . '">' . $title . '</h3>';
                }
                $output .= '</div>';
                $output .= '</div>';
            } else {

                $output .= '<div class="' . $ic_class . '">';
                $output .= '<div class="box-icon-wrapper">';
                $output .= '<div class="box-icon ' . $icon_style . '">';
                $output .= '<span class="icon ' . $icon . '" style="' . $style_icon . '"></span>';
                $output .= '</div>';
                if ($title != '') {
                    $output .= '<h3 class="box-title ult-responsive" ' . $info_box_data_list . ' style="' . $title_style . '">' . $title . '</h3>';
                }
                $output .= '</div>';
                $output .= '</div>';
            }


            $output .= '<div class="box-content">';
            $output .= '<div class="box-header">';

            if ($content != '') {
                $output .= '<div class="box-description ult-responsive" ' . $info_box_desc_data_list . ' style="' . $desc_style . '">' . do_shortcode($content) . '</div>';
            }

            if ($button_text != '') {
                if ($target != '')
                    $target = 'target="' . $target . '"';
                $output .= '<div class="box-link">';
                $output .= '<a href="' . $button_link_main . '" style="' . $btn_style . '" class="btn" ' . $target . '>' . $button_text . '</a>';
                $output .= '</div>';
            }

            $output .= '</div>';
            $output .= '</div>';
        } else {
            $output .= '<div class="box-content">';
            $output .= '<div class="box-header">';

            if ($title != '') {
                $output .= '<h3 class="box-title ult-responsive" ' . $info_box_data_list . ' style="' . $title_style . '">' . $title . '</h3>';
            }
            if ($content != '') {
                $output .= '<div class="box-description ult-responsive" ' . $info_box_desc_data_list . ' style="' . $desc_style . '">' . do_shortcode($content) . '</div>';
            }

            if ($button_text != '') {
                if ($target != '')
                    $target = 'target="' . $target . '"';
                $output .= '<div class="box-link">';
                $output .= '<a href="' . $button_link_main . '" style="' . $btn_style . '" class="btn" ' . $target . '>' . $button_text . '</a>';
                $output .= '</div>';
            }

            $output .= '</div>';
            $output .= '</div>';

            if ($icon_style == 'style_1') {

                $output .= '<div class="' . $ic_class . '">';
                $output .= '<div class="box-icon-wrapper">';
                $output .= '<div class="box-icon ' . $icon_style . '" style="' . $style_box_icon_1 . '">';
                $output .= '<span class="icon ' . $icon . '" style="' . $style_icon . ' ' . $style_icon_1 . '"></span>';
                $output .= '</div>';
                $output .= '</div>';
                $output .= '</div>';
            } elseif ($icon_style == 'style_2') {

                $output .= '<div class="' . $ic_class . '">';
                $output .= '<div class="box-icon-wrapper">';
                $output .= '<div class="box-icon ' . $icon_style . '" style="' . $style_box_icon_2 . '">';
                $output .= '<span class="icon ' . $icon . '" style="' . $style_icon . ' ' . $style_icon_2 . '"></span>';
                $output .= '</div>';
                $output .= '</div>';
                $output .= '</div>';
            } elseif ($icon_style == 'style_3') {

                $output .= '<div class="' . $ic_class . '">';
                $output .= '<div class="box-icon-wrapper">';
                $output .= '<div class="box-icon ' . $icon_style . '" style="' . $style_box_icon_3 . '">';
                $output .= '<span class="icon ' . $icon . '" style="' . $style_icon . '"></span>';
                $output .= '</div>';
                $output .= '</div>';
                $output .= '</div>';
            } else {

                $output .= '<div class="' . $ic_class . '">';
                $output .= '<div class="box-icon-wrapper">';
                $output .= '<div class="box-icon ' . $icon_style . '">';
                $output .= '<span class="icon ' . $icon . '" style="' . $style_icon . '"></span>';
                $output .= '</div>';
                $output .= '</div>';
                $output .= '</div>';
            }
        }
        $output .= '</div>';
        $output .= '</div>';
        $is_preset = false; //Display settings for Preset
        if (isset($_GET['preset'])) {
            $is_preset = true;
        }
        if ($is_preset) {
            $text = 'array ( ';
            foreach ($atts as $key => $att) {
                $text .= '<br/>	\'' . $key . '\' => \'' . $att . '\',';
            }
            if ($content != '') {
                $text .= '<br/>	\'content\' => \'' . $content . '\',';
            }
            $text .= '<br/>)';
            $output .= '<pre>';
            $output .= $text;
            $output .= '</pre>';
        }
        ?>

        <?php
        if ($button_text_hover_color != '' || $button_color_hover != '') {
            ?>
            <style type="text/css">
                <?php echo "#" . $info_box_id ?>.educatito-info-box .bd-info-box .box-content .box-link .btn:hover{
                    color: <?php echo $button_text_hover_color; ?> !important;
                    background: <?php echo $button_color_hover; ?> !important;
                }
            </style>
            <?php
        }
        if ($icon_hover_color != '' || $icon_color_bg_hover != '' || $icon_color_hover_border != '') {
            ?>
            <style type="text/css">
                <?php echo "#" . $info_box_id ?>.educatito-info-box .bd-info-box:hover .box-icon.style_3{

                    background: <?php echo $icon_color_bg_hover; ?> !important;
                    border-color: <?php echo $icon_color_hover_border; ?> !important;
                }
                <?php echo "#" . $info_box_id ?>.educatito-info-box .bd-info-box:hover .box-icon.style_3 .icon{
                    color: <?php echo $icon_hover_color; ?> !important;
                }
            </style>
            <?php
        }
        ?>

        <?php
        return $output;
    }

endif;

if (!function_exists('educatito_info_box_admin')) {
    add_action('vc_before_init', 'educatito_info_box_admin');

    function educatito_info_box_admin() {
        vc_map(array(
            'name' => esc_html__('Info Box', 'educatito'),
            'base' => 'educatito_info_box',
            'icon' => get_template_directory_uri() . "/assets/images/icon/educatito-icon.png",
            'category' => esc_html__('JRB Themes', 'educatito'),
            'description' => esc_html__('Info box for theme.', 'educatito'),
            'params' => array(
                array(
                    "type" => "icon_manager",
                    "class" => "",
                    "heading" => __("Select Icon ", "educa"),
                    "param_name" => "icon",
                    "value" => "",
                    "description" => __("Click and select icon of your choice. If you can't find the one that suits for your purpose", "educa") . ", " . __("you can", "educa") . " <a href='admin.php?page=bsf-font-icon-manager' target='_blank'>" . __("add new here", "educa") . "</a>.",
                //"dependency" => Array("element" => "icon_type", "value" => array("selector")),
                ),
                array(
                    "type" => "number",
                    "class" => "",
                    "heading" => __("Size of Icon", "educa"),
                    "param_name" => "icon_sized",
                    "value" => 28,
                    "min" => 12,
                    "suffix" => "px",
                    "description" => __("How big would you like it?", "educa"),
                //"dependency" => Array("element" => "icon_type", "value" => array("selector")),
                ),
                array(
                    "type" => "ult_param_heading",
                    "param_name" => "title_text_typography",
                    "heading" => __("Icon settings", "educa"),
                    "value" => "",
                    "group" => "Custom Style",
                    'edit_field_class' => 'ult-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
                ),
                array(
                    "type" => "colorpicker",
                    "class" => "",
                    "heading" => __("Icon Color", "educa"),
                    "param_name" => "icon_color",
                    "value" => "",
                    "group" => "Custom Style",
                    "description" => __("Give it a nice paint!", "educa"),
                ),
                array(
                    "type" => "colorpicker",
                    "class" => "",
                    "heading" => __("Icon Hover Color", "educa"),
                    "param_name" => "icon_hover_color",
                    "value" => "",
                    "group" => "Custom Style",
                    "description" => __("Give it a nice paint!", "educa"),
                ),
                // Position the icon box
                array(
                    "type" => "dropdown",
                    "class" => "",
                    "heading" => __("Box Style", "educa"),
                    "param_name" => "pos",
                    "value" => array(
                        __("Icon at Left", "educa") => "left",
                        __("Icon at Right", "educa") => "right",
                        __("Icon at Top", "educa") => "top",
                    ),
                    "description" => __("Select icon position. Icon box style will be changed according to the icon position.", "educa")
                ),
                array(
                    "type" => "dropdown",
                    "class" => "",
                    "heading" => __("Icon Style", "educa"),
                    "param_name" => "icon_style",
                    "value" => array(
                        __("Simple", "educa") => "none",
                        __("Style 1", "educa") => "style_1",
                        __("Style 2", "educa") => "style_2",
                        __("Style 3", "educa") => "style_3",
                    ),
                    "description" => __("We have given three quick preset if you are in a hurry. Otherwise, create your own with various options.", "educa"),
                ),
                // Info Box Heading
                array(
                    "type" => "textfield",
                    "class" => "",
                    "heading" => __("Title", "educa"),
                    "param_name" => "title",
                    "admin_label" => true,
                    "value" => "",
                    "description" => __("Provide the title for this icon box.", "educa"),
                ),
                // Add some description
                array(
                    "type" => "textarea_html",
                    "class" => "",
                    "heading" => __("Description", "educa"),
                    "param_name" => "content",
                    "value" => "",
                    "description" => __("Provide the description for this icon box.", "educa"),
                    "edit_field_class" => "ult_hide_editor_fullscreen vc_col-xs-12 vc_column wpb_el_type_textarea_html vc_wrapper-param-type-textarea_html vc_shortcode-param",
                ),
                array(
                    "type" => "colorpicker",
                    "class" => "",
                    "heading" => __("Icon Background Color", "educa"),
                    "param_name" => "icon_color_bg",
                    "value" => "",
                    "group" => "Custom Style",
                    "description" => __("Select background color for icon.", "educa"),
                    "dependency" => Array("element" => "icon_style", "value" => array("style_1", "style_2", "style_3")),
                ),
                array(
                    "type" => "colorpicker",
                    "class" => "",
                    "heading" => __("Icon Background Hover Color", "educa"),
                    "param_name" => "icon_color_bg_hover",
                    "value" => "",
                    "group" => "Custom Style",
                    "description" => __("Select background hover color for icon.", "educa"),
                    "dependency" => Array("element" => "icon_style", "value" => array("style_1", "style_2", "style_3")),
                ),
                array(
                    "type" => "dropdown",
                    "class" => "",
                    "heading" => __("Icon Border Style", "educa"),
                    "param_name" => "icon_border_style",
                    "value" => array(
                        __("None", "educa") => "",
                        __("Solid", "educa") => "solid",
                        __("Dashed", "educa") => "dashed",
                        __("Dotted", "educa") => "dotted",
                        __("Double", "educa") => "double",
                        __("Inset", "educa") => "inset",
                        __("Outset", "educa") => "outset",
                    ),
                    "group" => "Custom Style",
                    "description" => __("Select the border style for icon.", "educa"),
                    "dependency" => Array("element" => "icon_style", "value" => array("style_1", "style_2", "style_3")),
                ),
                array(
                    "type" => "colorpicker",
                    "class" => "",
                    "heading" => __("Icon Border Color", "educa"),
                    "param_name" => "icon_color_border",
                    "value" => "",
                    "group" => "Custom Style",
                    "description" => __("Select border color for icon.", "educa"),
                    "dependency" => Array("element" => "icon_border_style", "not_empty" => true),
                ),
                array(
                    "type" => "colorpicker",
                    "class" => "",
                    "heading" => __("Icon Border Hover Color", "educa"),
                    "param_name" => "icon_color_hover_border",
                    "value" => "",
                    "group" => "Custom Style",
                    "description" => __("Select border color for icon.", "educa"),
                    "dependency" => Array("element" => "icon_border_style", "not_empty" => true),
                ),
                array(
                    "type" => "number",
                    "class" => "",
                    "heading" => __("Icon Border Width", "educa"),
                    "param_name" => "icon_border_size",
                    "value" => 1,
                    "min" => 1,
                    "max" => 10,
                    "suffix" => "px",
                    "group" => "Custom Style",
                    "description" => __("Thickness of the border.", "educa"),
                    "dependency" => Array("element" => "icon_border_style", "not_empty" => true),
                ),
                array(
                    "type" => "number",
                    "class" => "",
                    "heading" => __("Icon Border Radius", "educa"),
                    "param_name" => "icon_border_radius",
                    "value" => '',
                    "min" => 1,
                    "max" => 500,
                    "suffix" => "px",
                    "group" => "Custom Style",
                    "description" => __("0 pixel value will create a square border. As you increase the value, the shape convert in circle slowly. (e.g 500 pixels).", "educa"),
                    "dependency" => Array("element" => "icon_border_style", "not_empty" => true),
                ),
                array(
                    "type" => "number",
                    "class" => "",
                    "heading" => __("Icon Background Size", "educa"),
                    "param_name" => "icon_border_spacing",
                    "value" => '',
                    "min" => 30,
                    "max" => 500,
                    "suffix" => "px",
                    "group" => "Custom Style",
                    "description" => __("Spacing from center of the icon till the boundary of border / background", "educa"),
                    "dependency" => Array("element" => "icon_style", "value" => array("style_1", "style_2", "style_3")),
                ),
                array(
                    "type" => "checkbox",
                    "class" => "",
                    "heading" => __("Show button", "educa"),
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
                    "heading" => __("Link ", "educa"),
                    "param_name" => "button_link",
                    "value" => "",
                    "description" => __("Add link / select existing page to link to this banner", "educa"),
                    'dependency' => array(
                        'element' => 'show_button',
                        'value' => 'true',
                    ),
                ),
                array(
                    "type" => "ult_param_heading",
                    "param_name" => "title_text_typography",
                    "heading" => __("Button settings", "educa"),
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
                    "heading" => __("Button Color", "educa"),
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
                    "heading" => __("Button Color Hover", "educa"),
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
                    "heading" => __("Text Color", "educa"),
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
                    "heading" => __("Text Hover Color", "educa"),
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
                    "heading" => __("Border Width", "educa"),
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
                    "heading" => __("Border Color", "educa"),
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
                    "heading" => __("Border Hover Color", "educa"),
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
                    "heading" => __("Border Radius", "educa"),
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
                    "type" => "checkbox",
                    "class" => "",
                    "heading" => __("Box Border", "educa"),
                    "param_name" => "box_border",
                    "value" => '',
                ),
                array(
                    "type" => "ult_param_heading",
                    "param_name" => "title_text_typography",
                    "heading" => __("Box settings", "educa"),
                    "value" => "",
                    "group" => "Custom Style",
                    'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
                    'dependency' => array(
                        'element' => 'box_border',
                        'value' => 'true',
                    ),
                ),
                array(
                    "type" => "number",
                    "class" => "",
                    "heading" => __("Box Left / Right Padding", "educa"),
                    "param_name" => "padding_left_right",
                    "value" => '',
                    "min" => 1,
                    "max" => 500,
                    "suffix" => "px",
                    "group" => "Custom Style",
                    'dependency' => array(
                        'element' => 'box_border',
                        'value' => 'true',
                    ),
                ),
                array(
                    "type" => "number",
                    "class" => "",
                    "heading" => __("Box Top / Bottom Padding", "educa"),
                    "param_name" => "padding_top_bottom",
                    "value" => '',
                    "min" => 1,
                    "max" => 500,
                    "suffix" => "px",
                    "group" => "Custom Style",
                    'dependency' => array(
                        'element' => 'box_border',
                        'value' => 'true',
                    ),
                ),
                array(
                    "type" => "dropdown",
                    "class" => "",
                    "heading" => __("Box Border Style", "educa"),
                    "param_name" => "box_border_style",
                    "value" => array(
                        "None" => "",
                        "Solid" => "solid",
                        "Dashed" => "dashed",
                        "Dotted" => "dotted",
                        "Double" => "double",
                        "Inset" => "inset",
                        "Outset" => "outset",
                    ),
                    "description" => "",
                    "group" => "Custom Style",
                    'dependency' => array(
                        'element' => 'box_border',
                        'value' => 'true',
                    ),
                ),
                array(
                    "type" => "colorpicker",
                    "class" => "",
                    "heading" => __("Border Color", "educa"),
                    "param_name" => "box_color_border",
                    "value" => "",
                    "description" => "",
                    "group" => "Custom Style",
                    'dependency' => array(
                        'element' => 'box_border',
                        'value' => 'true',
                    ),
                ),
                array(
                    "type" => "number",
                    "class" => "",
                    "heading" => __("Border Width", "educa"),
                    "param_name" => "box_border_size",
                    "value" => 1,
                    "min" => 1,
                    "max" => 10,
                    "suffix" => "px",
                    "description" => "",
                    "group" => "Custom Style",
                    'dependency' => array(
                        'element' => 'box_border',
                        'value' => 'true',
                    ),
                ),
                array(
                    "type" => "number",
                    "class" => "",
                    "heading" => __("Border Radius", "educa"),
                    "param_name" => "box_radius",
                    "value" => 3,
                    "min" => 0,
                    "max" => 500,
                    "suffix" => "px",
                    "description" => "",
                    "group" => "Custom Style",
                    'dependency' => array(
                        'element' => 'box_border',
                        'value' => 'true',
                    ),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Extra class name', 'educatito'),
                    'param_name' => 'el_class',
                    'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'educatito'),
                ),
                array(
                    "type" => "ult_param_heading",
                    "param_name" => "title_text_typography",
                    "heading" => __("Title settings", "educa"),
                    "value" => "",
                    "group" => "Typography",
                    'edit_field_class' => 'ult-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
                ),
                array(
                    "type" => "ultimate_google_fonts",
                    "heading" => __("Font Family", "educa"),
                    "param_name" => "title_font",
                    "value" => "",
                    "group" => "Typography"
                ),
                array(
                    "type" => "ultimate_google_fonts_style",
                    "heading" => __("Font Style", "educa"),
                    "param_name" => "title_font_style",
                    "value" => "",
                    "group" => "Typography"
                ),
                array(
                    "type" => "ultimate_responsive",
                    "class" => "",
                    "heading" => __("Font size", 'educatito'),
                    "param_name" => "title_font_size",
                    "unit" => "px",
                    "media" => array(
                        "Desktop" => '',
                        "Tablet" => '',
                        "Tablet Portrait" => '',
                        "Mobile Landscape" => '',
                        "Mobile" => '',
                    ),
                    "group" => "Typography",
                ),
                array(
                    "type" => "ultimate_responsive",
                    "class" => "",
                    "heading" => __("Line Height", 'educatito'),
                    "param_name" => "title_font_line_height",
                    "unit" => "px",
                    "media" => array(
                        "Desktop" => '',
                        "Tablet" => '',
                        "Tablet Portrait" => '',
                        "Mobile Landscape" => '',
                        "Mobile" => '',
                    ),
                    "group" => "Typography",
                ),
                array(
                    "type" => "colorpicker",
                    "param_name" => "title_font_color",
                    "heading" => __("Color", "educa"),
                    "group" => "Typography"
                ),
                array(
                    "type" => "ult_param_heading",
                    "param_name" => "desc_text_typography",
                    "heading" => __("Description settings", "educa"),
                    "value" => "",
                    "group" => "Typography",
                    'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
                ),
                array(
                    "type" => "ultimate_google_fonts",
                    "heading" => __("Font Family", "educa"),
                    "param_name" => "desc_font",
                    "value" => "",
                    "group" => "Typography"
                ),
                array(
                    "type" => "ultimate_google_fonts_style",
                    "heading" => __("Font Style", "educa"),
                    "param_name" => "desc_font_style",
                    "value" => "",
                    "group" => "Typography"
                ),
                array(
                    "type" => "ultimate_responsive",
                    "class" => "",
                    "heading" => __("Font size", 'educatito'),
                    "param_name" => "desc_font_size",
                    "unit" => "px",
                    "media" => array(
                        "Desktop" => '',
                        "Tablet" => '',
                        "Tablet Portrait" => '',
                        "Mobile Landscape" => '',
                        "Mobile" => '',
                    ),
                    "group" => "Typography",
                ),
                array(
                    "type" => "ultimate_responsive",
                    "class" => "",
                    "heading" => __("Line Height", 'educatito'),
                    "param_name" => "desc_font_line_height",
                    "unit" => "px",
                    "media" => array(
                        "Desktop" => '',
                        "Tablet" => '',
                        "Tablet Portrait" => '',
                        "Mobile Landscape" => '',
                        "Mobile" => '',
                    ),
                    "group" => "Typography",
                ),
                array(
                    "type" => "colorpicker",
                    "param_name" => "desc_font_color",
                    "heading" => __("Color", "educa"),
                    "group" => "Typography"
                ),
            )
        ));
    }

}
    