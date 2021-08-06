<?php

/**
 * @author JRB Themes
 * @since 1.0.0
 */
class MetaOptions {

    public function __construct() {
        add_action('add_meta_boxes', array($this, 'educatito_add_meta_boxes'));
        add_action('admin_enqueue_scripts', array($this, 'educatito_admin_script_loader'));
        add_action('save_post', array($this, 'save_meta_boxes'));
    }

    /* add script */

    function educatito_admin_script_loader() {
        global $pagenow;
        if (is_admin() && ($pagenow == 'post-new.php' || $pagenow == 'post.php')) {
            wp_enqueue_style('educatito-css-metabox', EDUCATITO_PLUGIN_URL . '/inc/meta-options/css/metabox.css');
            wp_enqueue_script('educatito-js-metabox', EDUCATITO_PLUGIN_URL . '/inc/meta-options/js/metabox.js', array('jquery'), true);
            wp_enqueue_script('js-upload', EDUCATITO_PLUGIN_URL . '/inc/meta-options/js/upload.js', array('jquery'), true);
        }
    }

    /* add meta boxs */

    public function educatito_add_meta_boxes() {
        $this->add_meta_box('educatito_page_options', esc_html__('Option Page', 'educatito'), 'page');
        $this->add_meta_box_post('post_link', esc_html__('Link Settings', 'educatito'), 'post');
        $this->add_meta_box_post('post_quote', esc_html__('Quote Settings', 'educatito'), 'post');
        $this->add_meta_box_post('post_video', esc_html__('Video Settings', 'educatito'), 'post');
    }

    public function add_meta_box_post($id, $label, $post_type) {
        add_meta_box(
                'educatito_' . $id, $label, array($this, $id), $post_type
        );
    }

    public function add_meta_box($id, $label, $post_type, $context = 'advanced', $priority = 'default') {
        add_meta_box('_cms_' . $id, $label, array($this, $id), $post_type, $context, $priority);
    }

    /* --------------------- PAGE ---------------------- */

    function educatito_page_options($post) {
        global $educatito_options;
        $meta_data = educatito_option_meta_id($post->ID);
        /* @var $header_position type */
        if ($meta_data) {
            $header_position = $meta_data->_jrb_header_position;
        }

        global $wp_registered_sidebars;
        $sidebar_options = array("" => "None");
        foreach ($wp_registered_sidebars as $sidebar) {
            $sidebar_options[$sidebar['id']] = $sidebar['name'];
        }
        ?>
        <div class="tab-container clearfix">
            <ul class='tabs-menu clearfix'>
                <li class="current"><a href="#tabs-1"><span class="dashicons dashicons-admin-generic"></span><?php echo esc_html('Header', 'educatito'); ?></a></li>
                <li><a href="#tabs-2"><span class="dashicons dashicons-screenoptions"></span><?php echo esc_html('Sidebar', 'educatito'); ?></a></li>
                <li><a href="#tabs-3"><span class="dashicons dashicons-editor-kitchensink"></span><?php echo esc_html('Footer', 'educatito'); ?></a></li>
            </ul>
            <div class='tab'>
                <div id="tabs-1" class="tab-content">
                    <?php
                    /* Header. */
                    educatito_options(array(
                        'id' => 'header',
                        'label' => esc_html__('Custom Header', 'educatito'),
                        'type' => 'switch',
                        'options' => array('on' => '1', 'off' => ''),
                        'follow' => array('1' => array('#page_header_enable'))
                    ));
                    ?>
                    <div id="page_header_enable">
                        <?php
                        educatito_options(array(
                            'id' => 'custom_logo',
                            'label' => esc_html__('Custom Logo', 'educatito'),
                            'type' => 'switch',
                            'options' => array('on' => '1', 'off' => ''),
                            'follow' => array('1' => array('#custom_logo_page'))
                        ));
                        ?> 
                        <div id="custom_logo_page">
                            <?php
                            educatito_options(array(
                                'id' => 'header_logo_page',
                                'label' => esc_html__('Logo', 'educatito'),
                                'type' => 'image',
                                'default' => ''
                            ));
                            ?>
                        </div>

                        <?php
                        educatito_options(array(
                            'id' => 'hidden_page_title',
                            'label' => esc_html__('Hidden Page Title', 'educatito'),
                            'type' => 'switch',
                            'options' => array('on' => '1', 'off' => '')
                        ));
                        educatito_options(array(
                            'id' => 'custom_bg_page_title',
                            'label' => esc_html__('Custom Background Page Title', 'educatito'),
                            'type' => 'switch',
                            'options' => array('on' => '1', 'off' => ''),
                            'follow' => array('1' => array('#custom_bg_page_title'))
                        ));
                        ?> 
                        <div id="custom_bg_page_title">
                            <?php
                            educatito_options(array(
                                'id' => 'bg_page_title',
                                'label' => esc_html__('Background Page Title', 'educatito'),
                                'type' => 'image',
                                'default' => ''
                            ));
                            ?>
                        </div>
                        <?php
                        educatito_options(array(
                            'id' => 'custom_header_layout',
                            'label' => esc_html__('Custom Header Layout', 'educatito'),
                            'type' => 'switch',
                            'options' => array('on' => '1', 'off' => ''),
                            'follow' => array('1' => array('#custom_header_layout_page'))
                        ));
                        ?> 
                        <div id="custom_header_layout_page">
                            <?php
                            educatito_options(array(
                                'id' => 'header_position',
                                'label' => esc_html__('Header Layout', 'educatito'),
                                'type' => 'imegesselect',
                                'options' => array(
                                    '1' => EDUCATITO_PLUGIN_URL . '/images/header/header-1.jpg',
                                    '2' => EDUCATITO_PLUGIN_URL . '/images/header/header-2.jpg',
                                    '3' => EDUCATITO_PLUGIN_URL . '/images/header/header-3.jpg',
                                ),
                            ));
                            ?> 
                        </div>
                        <?php
                        educatito_options(array(
                            'id' => 'custom_color',
                            'label' => esc_html__('Custom Color', 'educatito'),
                            'type' => 'switch',
                            'options' => array('on' => '1', 'off' => ''),
                            'follow' => array('1' => array('#page_custom_color_header'))
                        ));
                        ?>
                        <div id="page_custom_color_header">
                            <?php
                            educatito_options(array(
                                'id' => 'background_color',
                                'label' => esc_html__('Background Header', 'educatito'),
                                'type' => 'color',
                                'default' => '#ffffff',
                                'rgba' => true
                            ));
                            educatito_options(array(
                                'id' => 'menu_color',
                                'label' => esc_html__('Color Menu Item', 'educatito'),
                                'type' => 'color',
                                'default' => '#000000',
                                    //'rgba' => true
                            ));

                            educatito_options(array(
                                'id' => 'custom_header_sticky',
                                'label' => esc_html__('Custom Header Sticky', 'educatito'),
                                'type' => 'switch',
                                'options' => array('on' => '1', 'off' => ''),
                                'follow' => array('1' => array('#page_custom_header_sticky'))
                            ));
                            ?>
                            <div id="page_custom_header_sticky">
                                <?php
                                educatito_options(array(
                                    'id' => 'background_color_sticky',
                                    'label' => esc_html__('Background Header Sticky', 'educatito'),
                                    'type' => 'color',
                                    'default' => '#ffffff',
                                    'rgba' => true
                                ));
                                educatito_options(array(
                                    'id' => 'menu_color_sticky',
                                    'label' => esc_html__('Color Menu Item', 'educatito'),
                                    'type' => 'color',
                                    'default' => '#000000',
                                        //'rgba' => true
                                ));
                                ?>
                            </div>
                        </div>
                        <?php
                        educatito_options(array(
                            'id' => 'educatito_tranparent_header',
                            'label' => esc_html__('Tranparent Header', 'educatito'),
                            'type' => 'switch',
                            'options' => array('on' => '1', 'off' => '')
                        ));
                        educatito_options(array(
                            'id' => 'show_menu_active_page',
                            'label' => esc_html__('Menu active', 'educatito'),
                            'type' => 'switch',
                            'options' => array('on' => '1', 'off' => ''),
                            'follow' => array('1' => array('#page_menu_active'))
                        ));
                        ?>
                        <div id="page_menu_active">
                            <?php
                            educatito_options(array(
                                'id' => 'menu_text_page',
                                'label' => esc_html__('Menu text', 'educatito'),
                                'type' => 'text',
                                'default' => 'FREE QUOTE',
                            ));
                            educatito_options(array(
                                'id' => 'menu_link_page',
                                'label' => esc_html__('Menu link', 'educatito'),
                                'type' => 'text',
                                'default' => '#',
                            ));
                            educatito_options(array(
                                'id' => 'menu_active_target_page',
                                'label' => esc_html__('Open link new tab', 'educatito'),
                                'type' => 'switch',
                                'options' => array('on' => '1', 'off' => ''),
                            ));
                            ?>
                        </div>
                    </div>

                </div>
                <div id="tabs-2" class="tab-content">
                    <?php
                    educatito_options(array(
                        'id' => 'show_sidebar',
                        'label' => esc_html__('Show Sidebar', 'educatito'),
                        'type' => 'switch',
                        'options' => array('on' => '1', 'off' => ''),
                        'follow' => array('1' => array('#show_sidebar_page_left'))
                    ));
                    ?>
                    <div id="show_sidebar_page_left">
                        <?php
                        educatito_options(array(
                            'id' => 'cus_sidebar_page',
                            'label' => esc_html__('Select Sidebar', 'educatito'),
                            'type' => 'select',
                            'options' => $sidebar_options,
                        ));
                        educatito_options(array(
                            'id' => 'educatito_show_sidebar',
                            'label' => esc_html__('Left - Default Right', 'educatito'),
                            'type' => 'switch',
                            'options' => array('on' => '1', 'off' => ''),
                        ));
                        ?>  
                    </div>
                </div>
                <div id="tabs-3" class="tab-content">
                    <?php
                    /* Footer. */
                    educatito_options(array(
                        'id' => 'footer',
                        'label' => esc_html__('Custom Footer', 'educatito'),
                        'type' => 'switch',
                        'options' => array('on' => '1', 'off' => ''),
                        'follow' => array('1' => array('#page_footer_enable'))
                    ));
                    ?>  
                    <div id="page_footer_enable">
                        <?php
                        educatito_options(array(
                            'id' => 'custom_color_footer',
                            'label' => esc_html__('Custom Color', 'educatito'),
                            'type' => 'switch',
                            'options' => array('on' => '1', 'off' => ''),
                            'follow' => array('1' => array('#page_custom_color_footer'))
                        ));
                        ?>
                        <div id="page_custom_color_footer">
                            <?php
                            educatito_options(array(
                                'id' => 'background_color_footer',
                                'label' => esc_html__('Background', 'educatito'),
                                'type' => 'color',
                                'default' => '#000000',
                                'rgba' => true
                            ));
                            educatito_options(array(
                                'id' => 'color_footer',
                                'label' => esc_html__('Footer Text Color', 'educatito'),
                                'type' => 'color',
                                'default' => '#cccccc',
                                'rgba' => true
                            ));
                            educatito_options(array(
                                'id' => 'color_heading_footer',
                                'label' => esc_html__('Footer Heading Color', 'educatito'),
                                'type' => 'color',
                                'default' => '#ffffff',
                                'rgba' => true
                            ));
                            educatito_options(array(
                                'id' => 'color_link_footer',
                                'label' => esc_html__('Footer Link Color', 'educatito'),
                                'type' => 'color',
                                'default' => '#cccccc',
                                'rgba' => true
                            ));
                            educatito_options(array(
                                'id' => 'color_link_hover_footer',
                                'label' => esc_html__('Footer Link Hover Color', 'educatito'),
                                'type' => 'color',
                                'default' => '#77bc25',
                                'rgba' => true
                            ));
                            ?>
                        </div>
                        <?php
                        educatito_options(array(
                            'id' => 'custom_widget_footer',
                            'label' => esc_html__('Custom Footer Widget', 'educatito'),
                            'type' => 'switch',
                            'options' => array('on' => '1', 'off' => ''),
                            'follow' => array('1' => array('#page_custom_widget_footer'))
                        ));
                        ?>
                        <div id="page_custom_widget_footer">
                            <?php
                            educatito_options(array(
                                'id' => 'footer_custom_layout',
                                'label' => esc_html__('Footer Layout', 'educatito'),
                                'type' => 'imegesselect',
                                'options' => array(
                                    '2' => EDUCATITO_PLUGIN_URL . '/inc/meta-options/images/footer/footer-v2.jpg',
                                    '3' => EDUCATITO_PLUGIN_URL . '/inc/meta-options/images/footer/footer-v3.jpg',
                                ),
                            ));
                            ?> 
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <?php
    }

    public function post_link() {
        global $post;
        $value = get_post_meta($post->ID, 'educatito_post_link', true);
        ?>
        <div id="educatito_metabox_field_post_link" class="educatito_metabox_field">
            <label for="educatito_post_link">
                <?php echo esc_html__('Link URL', 'educatito') ?>
            </label>
            <div class="field">
                <input type="text" id="educatito_post_link" name="educatito_post_link" value="<?php echo esc_url($value); ?>" />

                <p><?php echo esc_html__('Please input the URL for your link. http://www.youwebsite.com', 'educatito') ?> </p>
            </div>
        </div>

        <?php
    }

    public function educatito_text($id, $label, $default, $desc = '') {
        global $post;
        $value = get_post_meta($post->ID, 'educatito_' . $id, true);
        if (!$value) {
            $value = $default;
        }
        $html = '';
        $html .= '<label for="educatito_' . $id . '">';
        $html .= $label;
        $html .= '</label>';
        $html .= '<div class="field">';
        $html .= '<input type="text" id="educatito_' . $id . '" name="educatito_' . $id . '" value="' . $value . '" />';
        if ($desc) {
            $html .= '<p>' . $desc . '</p>';
        }
        $html .= '</div>';
        echo '<div id="educatito_metabox_field_' . $id . '" class="educatito_metabox_field">' . $html . '</div>';
    }

    public function educatito_select($id, $label, $options, $defualt, $desc = '') {
        global $post;
        $html = '';
        $html .= '<label for="educatito_' . $id . '">';
        $html .= $label;
        $html .= '</label>';
        $html .= '<div class="field">';
        $html .= '<select id="educatito_' . $id . '" name="educatito_' . $id . '">';
        $value = get_post_meta($post->ID, 'educatito_' . $id, true);
        $defualt = $value == '' ? $defualt = 'global' : $value;

        foreach ($options as $key => $option) {
            $selected = $defualt === (string) $key ? 'selected="selected"' : null;
            $html .= '<option ' . $selected . 'value="' . $key . '">' . $option . '</option>';
        }
        $html .= '</select>';
        if ($desc) {
            $html .= '<p>' . $desc . '</p>';
        }
        $html .= '</div>';

        echo '<div id="educatito_metabox_field_' . $id . '" class="educatito_metabox_field">' . $html . '</div>';
    }

    public function educatito_textarea($id, $label, $desc = '') {
        global $post;

        $html = '';
        $html .= '<label for="educatito_' . $id . '">';
        $html .= $label;
        $html .= '</label>';
        $html .= '<div class="field">';
        $html .= '<textarea cols="30" rows="5" id="educatito_' . $id . '" name="educatito_' . $id . '">' . get_post_meta($post->ID, 'educatito_' . $id, true) . '</textarea>';
        if ($desc) {
            $html .= '<p>' . $desc . '</p>';
        }
        $html .= '</div>';

        echo '<div id="educatito_metabox_field_' . $id . '" class="educatito_metabox_field">' . $html . '</div>';
    }

    public function educatito_upload($id, $label, $desc = '') {
        global $post;
        $html = '';
        $html .= '<label for="educatito_' . $id . '">';
        $html .= $label;
        $html .= '</label>';
        $html .= '<div class="field">';
        $html .= '<input name="educatito_' . $id . '" class="upload_field" id="educatito_' . $id . '" type="text" value="' . get_post_meta($post->ID, 'educatito_' . $id, true) . '" />';
        $html .= '<input class="educatito_upload_button button button-primary button-large" type="button" value="Browse" />';
        if ($desc) {
            $html .= '<p>' . $desc . '</p>';
        }
        $html .= '</div>';

        echo '<div id="educatito_metabox_field_' . $id . '" class="educatito_metabox_field">' . $html . '</div>';
    }

    public function post_quote() {
        ?>
        <div id="educatito-blog-metabox" class='educatito_metabox'>
            <?php
            $this->educatito_select('post_quote_type', 'Quote Content', array(
                '' => 'From Post',
                'custom' => 'Custom'
                    ), '', ''
            );
            ?>
            <div id="post_quote_custom">
                <?php
                $this->educatito_textarea('post_quote', 'Content', esc_html__('Please type the text for your quote here.', 'educatito')
                );
                $this->educatito_text('post_author', 'Author', '', esc_html__('Please type the text for author quote here.', 'educatito')
                );
                ?>
            </div>
        </div>
        <?php
    }

    public function post_video() {
        global $post;
        $video_time_id = get_post_meta($post->ID, '_upload_video_id', true);
        ?>
        <div id="tb-blog-loading" class="tb_loading" style="display: block;">
            <div id="followingBallsG">
                <div id="followingBallsG_1" class="followingBallsG">
                </div>
                <div id="followingBallsG_2" class="followingBallsG">
                </div>
                <div id="followingBallsG_3" class="followingBallsG">
                </div>
                <div id="followingBallsG_4" class="followingBallsG">
                </div>
            </div>
        </div>
        <div class='educatito_metabox' style="display: block;">
            <?php
            $this->educatito_select('post_video_source', 'Select Source', array(
                'post' => 'From Post',
                'media' => 'From Media',
                'youtube' => 'Youtube',
                'vimeo' => 'Vimeo'
                    ), '', ''
            );
            ?>
            <br>
            <label><?php echo esc_html__('Enter time video', 'educatito'); ?></label><br>
            <input type="text" id="upload_video_time" name="_upload_video_time" value="<?php echo esc_attr($video_time_id); ?>" />
            <br>
            <div id="educatito_video_setting">
                <?php
                $this->educatito_select('post_video_type', 'Video Type', array(
                    'mp4' => 'MP4',
                    'webm' => 'WebM',
                    'ogg' => 'Ogg'
                        ), '', ''
                );
                $this->educatito_upload('post_video_url', 'Video URL', esc_html__('Please upload the (MP4,WebM,Ogg) video file. You must include both formats.', 'educatito')
                );
                $this->educatito_upload('post_preview_image', 'Preview Image', esc_html__('Image should be at least 680px wide. Click the "Upload" button to begin uploading your image, followed by "Select File" once you have made your selection. Only applies to self hosted videos.', 'educatito')
                );
                $this->educatito_text('post_video_youtube', 'Youtube', '', esc_html__('Enter in a Youtube (http://youtu.be/ID)', 'educatito')
                );
                $this->educatito_text('post_video_vimeo', 'Vimeo', '', esc_html__('Enter in a Vimeo (http://vimeo.com/ID)', 'educatito')
                );
                ?>
                <p class="educatito_info"><i class="dashicons dashicons-dashboard"></i><a href="<?php echo 'http://www.w3schools.com/html/html5_video.asp'; ?>"><?php echo esc_html__('Video Formats and Browser Support', 'educatito'); ?></a></p>
            </div>
        </div>
        <?php
    }

    public function save_meta_boxes($post_id) {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }
        $educatito_meta = array();
        foreach ($_POST as $key => $value) {
            if (strstr($key, 'educatito_')) {
                update_post_meta($post_id, $key, $value);
            }
        }
    }

}

new MetaOptions();
