<?php
/**
 * Video Popup
 *
 * @package educa
 * @author JRB Themes
 * @link http://jrbthemes.com
 */
/* -------------------Video Popup---------------------- */

if (!function_exists('educatito_video_popup_template')):

    function educatito_video_popup_template($atts) {
        global $educatito_options;
        $image = $link_video = $cover_image = $box_shadow = '';
        extract(shortcode_atts(array(
            'icon_size' => '',
            'icon_color' => '',
            'icon_color_hover' => '',
            'box_shadow' => '',
            'image' => '',
            'link_video' => 'false',
            'title' => '',
            'el_class' => '',
                        ), $atts));

        if (isset($box_shadow) && $box_shadow != '') {
            $box_shadow = "box-shadow";
        } else {
            $box_shadow = '';
        }

        if ($image != '') {
            $cover_image = "cover-image";
        }

        $rand_grid = rand(5, 1231564613);
        $id = md5(time() . ' ' . $rand_grid);
        wp_enqueue_script('html5lightbox');
        ob_start();
        ?>
        <div id="video_popup_<?php echo esc_attr($id); ?>" class="educatito-video-popup <?php echo esc_attr($box_shadow) . ' ' . esc_attr($cover_image) . ' ' . esc_attr($el_class); ?>">
            <div class="box-wrap">
                <?php
                if ($image) {
                    echo wp_get_attachment_image($image, 'full');
                }
                ?>
                <div class="icon-video-play"><a href="<?php echo ($link_video) ? esc_url($link_video) : '#' ?>" class="html5lightbox" title="<?php echo esc_attr($title); ?>"><span class="fa fa-play ic-video"></span></a></div>
            </div>
            <style type="text/css">
                #video_popup_<?php echo esc_attr($id); ?>.educatito-video-popup .box-wrap .icon-video-play a span{
                   <?php
                   if($icon_size != ''){
                       echo "font-size:".$icon_size.'px;';
                   }
                   if($icon_color != ''){
                       echo "color:".$icon_color.';';
                   }
                   ?>
                }
                #video_popup_<?php echo esc_attr($id); ?>.educatito-video-popup .box-wrap .icon-video-play a span:hover{
                    <?php if($icon_color_hover != ''){
                       echo "color:".$icon_color_hover.';';
                   } ?>
                }
            </style>
        </div>
        <?php
        return ob_get_clean();
    }

endif;

add_action('vc_before_init', 'educatito_vc_video_popup_show');
if (!function_exists('educatito_vc_video_popup_show')) {

    function educatito_vc_video_popup_show() {
        vc_map(array(
            "base" => "educatito_video_popup",
            "name" => esc_html__("Video Popup", "educa"),
            'category' => esc_html__('JRB Themes', 'educatito'),
            'icon' => get_template_directory_uri() . "/assets/images/icon/educatito-icon.png",
            //'description' => esc_html__('Adds image/video.', 'educatito'),
            "params" => array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Video link', 'educatito'),
                    'param_name' => 'link_video',
                    'value' => '',
                    'admin_label' => true,
                    "description" => __("Please add your links. EXP: https://vimeo.com/51589652 ','", "educa"),
                ),
                array(
                    'type' => 'attach_image',
                    'heading' => esc_html__('Cover Images', 'educatito'),
                    'param_name' => 'image',
                    'value' => '',
                    'description' => esc_html__('Select images from media library.', 'educatito'),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Title Video', 'educatito'),
                    'param_name' => 'title',
                    'value' => '',
                    'admin_label' => true,
                    "description" => esc_html__("Enter title this video','", "educa"),
                ),
                array(
                    "type" => "checkbox",
                    "heading" => esc_html__("Box Shadow", "educa"),
                    "param_name" => "box_shadow",
                    "value" => "",
                    "description" => esc_html__("Please using checkbox to box shadow an element.", "educa"),
                ),
                array(
                    "type" => "number",
                    //"class" => "font-size",
                    "heading" => esc_html__("Icon size", 'educatito'),
                    "param_name" => "icon_size",
                    "suffix" => "px",
                    'max' => 1000,
                    'min' => 0,
                    'step' => 1,
                    "group" => "Typography"
                ),
                array(
                    "type" => "colorpicker",
                    "class" => "",
                    "heading" => esc_html__("Icon Color", "educa"),
                    "param_name" => "icon_color",
                    "value" => "",
                    "group" => "Typography"
                ),
                array(
                    "type" => "colorpicker",
                    "class" => "",
                    "heading" => esc_html__("Icon Color Hover", "educa"),
                    "param_name" => "icon_color_hover",
                    "value" => "",
                    "group" => "Typography"
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Extra class name", "educa"),
                    "param_name" => "el_class",
                    "value" => "",
                    "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "educa")
                )
            )
        ));
    }

} 
