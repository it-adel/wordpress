<?php

/**
 * @package Educatito
 * @since 3.0.0
 * @uses Walker_Nav_Menu
 */
class Walker_Nav_Menu_Edit_Custom extends Walker_Nav_Menu {

    /**
     * @see Walker_Nav_Menu::start_lvl()
     * @since 3.0.0
     *
     * @param string $output Passed by reference.
     */
    function start_lvl(&$output, $depth = 0, $args = array()) {
        
    }

    /**
     * @see Walker_Nav_Menu::end_lvl()
     * @since 3.0.0
     *
     * @param string $output Passed by reference.
     */
    function end_lvl(&$output, $depth = 0, $args = array()) {
        
    }

    /**
     * @see Walker::start_el()
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item Menu item data object.
     * @param int $depth Depth of menu item. Used for padding.
     * @param object $args
     */
    function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0) {
        global $_wp_nav_menu_max_depth;
        $_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;

        $indent = ( $depth ) ? str_repeat("\t", $depth) : '';

        ob_start();
        $item_id = esc_attr($item->ID);
        $removed_args = array(
            'action',
            'customlink-tab',
            'edit-menu-item',
            'menu-item',
            'page-tab',
            '_wpnonce',
        );

        $original_title = '';
        if ('taxonomy' == $item->type) {
            $original_title = get_term_field('name', $item->object_id, $item->object, 'raw');
            if (is_wp_error($original_title))
                $original_title = false;
        } elseif ('post_type' == $item->type) {
            $original_object = get_post($item->object_id);
            $original_title = $original_object->post_title;
        }

        $classes = array(
            'menu-item menu-item-depth-' . $depth,
            'menu-item-' . esc_attr($item->object),
            'menu-item-edit-' . ( ( isset($_GET['edit-menu-item']) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive'),
        );

        $title = $item->title;

        if (!empty($item->_invalid)) {
            $classes[] = 'menu-item-invalid';
            $title = sprintf(esc_html__('%s (Invalid)', 'educatito'), $item->title);
        } elseif (isset($item->post_status) && 'draft' == $item->post_status) {
            $classes[] = 'pending';
            $title = sprintf(esc_html__('%s (Pending)', 'educatito'), $item->title);
        }

        $title = empty($item->label) ? $title : $item->label;
        ?>
        <li data-menuanchor="" id="menu-item-<?php echo '' . $item_id; ?>" class="<?php echo implode(' ', $classes); ?>">
            <dl class="menu-item-bar">
                <dt class="menu-item-handle">
                    <span class="item-title"><?php echo esc_html($title); ?></span>
                    <span class="item-controls">
                        <span class="item-type"><?php echo esc_html($item->type_label); ?></span>
                        <span class="item-order hide-if-js">
                            <a href="<?php
                            echo wp_nonce_url(
                                    add_query_arg(
                                            array(
                                'action' => 'move-up-menu-item',
                                'menu-item' => $item_id,
                                            ), remove_query_arg($removed_args, admin_url('nav-menus.php'))
                                    ), 'move-menu_item'
                            );
                            ?>" class="item-move-up"><abbr title="<?php echo esc_html__('Move up', 'educatito'); ?>">&#8593;</abbr></a>
                            |
                            <a href="<?php
                            echo wp_nonce_url(
                                    add_query_arg(
                                            array(
                                'action' => 'move-down-menu-item',
                                'menu-item' => $item_id,
                                            ), remove_query_arg($removed_args, admin_url('nav-menus.php'))
                                    ), 'move-menu_item'
                            );
                            ?>" class="item-move-down"><abbr title="<?php echo esc_html__('Move down', 'educatito'); ?>">&#8595;</abbr></a>
                        </span>
                        <a class="item-edit" id="edit-<?php echo '' . $item_id; ?>" title="<?php echo esc_html__('Edit Menu Item', 'educatito'); ?>" href="<?php
                        echo ( isset($_GET['edit-menu-item']) && $item_id == $_GET['edit-menu-item'] ) ? admin_url('nav-menus.php') : add_query_arg('edit-menu-item', $item_id, remove_query_arg($removed_args, admin_url('nav-menus.php#menu-item-settings-' . $item_id)));
                        ?>"><?php esc_html_e('Edit Menu Item', 'educatito'); ?></a>
                    </span>
                </dt>
            </dl>

            <div class="menu-item-settings" id="menu-item-settings-<?php echo '' . $item_id; ?>">
                <?php if ('custom' == $item->type) : ?>
                    <p class="field-url description description-wide">
                        <label for="edit-menu-item-url-<?php echo '' . $item_id; ?>">
                            <?php esc_html_e('URL', 'educatito'); ?><br />
                            <input type="text" id="edit-menu-item-url-<?php echo '' . $item_id; ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo '' . $item_id; ?>]" value="<?php echo esc_attr($item->url); ?>" />
                        </label>
                    </p>
                <?php endif; ?>
                <p class="description description-thin">
                    <label for="edit-menu-item-title-<?php echo '' . $item_id; ?>">
                        <?php esc_html_e('Navigation Label', 'educatito'); ?><br />
                        <input type="text" id="edit-menu-item-title-<?php echo '' . $item_id; ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo '' . $item_id; ?>]" value="<?php echo esc_attr($item->title); ?>" />
                    </label>
                </p>
                <p class="description description-thin">
                    <label for="edit-menu-item-attr-title-<?php echo '' . $item_id; ?>">
                        <?php esc_html_e('Title Attribute', 'educatito'); ?><br />
                        <input type="text" id="edit-menu-item-attr-title-<?php echo '' . $item_id; ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo '' . $item_id; ?>]" value="<?php echo esc_attr($item->post_excerpt); ?>" />
                    </label>
                </p>
                <p class="field-link-target description">
                    <label for="edit-menu-item-target-<?php echo '' . $item_id; ?>">
                        <input type="checkbox" id="edit-menu-item-target-<?php echo '' . $item_id; ?>" value="_blank" name="menu-item-target[<?php echo '' . $item_id; ?>]"<?php checked($item->target, '_blank'); ?> />
                        <?php esc_html_e('Open link in a new window/tab', 'educatito'); ?>
                    </label>
                </p>
                <p class="field-css-classes description description-thin">
                    <label for="edit-menu-item-classes-<?php echo '' . $item_id; ?>">
                        <?php esc_html_e('CSS Classes (optional)', 'educatito'); ?><br />
                        <input type="text" id="edit-menu-item-classes-<?php echo '' . $item_id; ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo '' . $item_id; ?>]" value="<?php echo esc_attr(implode(' ', $item->classes)); ?>" />
                    </label>
                </p>
                <p class="field-xfn description description-thin">
                    <label for="edit-menu-item-xfn-<?php echo '' . $item_id; ?>">
                        <?php esc_html_e('Link Relationship (XFN)', 'educatito'); ?><br />
                        <input type="text" id="edit-menu-item-xfn-<?php echo '' . $item_id; ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo '' . $item_id; ?>]" value="<?php echo esc_attr($item->xfn); ?>" />
                    </label>
                </p>
                <p class="field-description description description-wide">
                    <label for="edit-menu-item-description-<?php echo '' . $item_id; ?>">
                        <?php esc_html_e('Description', 'educatito'); ?><br />
                        <textarea id="edit-menu-item-description-<?php echo '' . $item_id; ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo '' . $item_id; ?>]"><?php echo esc_html($item->description); ?></textarea>
                        <span class="description"><?php esc_html_e('The description will be displayed in the menu if the current theme supports it.', 'educatito'); ?></span>
                    </label>
                </p>
                <?php
                /*
                 * This is the added field
                 */
                if (!$depth) {
                    $title = 'Submenu Type';
                    $key = "menu-item-submenu_type";
                    $value = $item->submenu_type;
                    ?>
                    <p class="description description-wide description_width_100">
                        <?php echo esc_html($title); ?><br />
                        <label for="edit-<?php echo '' . $key . '-' . $item_id; ?>">
                            <select id="edit-<?php echo '' . $key . '-' . $item_id; ?>" class=" <?php echo '' . $key; ?>" name="<?php echo '' . $key . "[" . $item_id . "]"; ?>">
                                <option value="standard" <?php echo ( $value == 'standard' ) ? ' selected="selected" ' : ''; ?>><?php esc_html_e('Standard Dropdown', 'educatito'); ?></option>
                                <option value="columns2" <?php echo ( $value == 'columns2' ) ? ' selected="selected" ' : ''; ?>><?php esc_html_e('2 columns dropdown', 'educatito'); ?></option>
                                <option value="columns3" <?php echo ( $value == 'columns3' ) ? ' selected="selected" ' : ''; ?>><?php esc_html_e('3 columns dropdown', 'educatito'); ?></option>
                                <option value="columns4" <?php echo ( $value == 'columns4' ) ? ' selected="selected" ' : ''; ?>><?php esc_html_e('4 columns dropdown', 'educatito'); ?></option>
                                <option value="columns5" <?php echo ( $value == 'columns5' ) ? ' selected="selected" ' : ''; ?>><?php esc_html_e('5 columns dropdown', 'educatito'); ?></option>
                            </select>
                        </label>
                    </p>
                    <?php
                    $title = 'Side of Dropdown Elements';
                    $key = "menu-item-dropdown";
                    $value = $item->dropdown;
                    ?>
                    <p class="description description-wide description_width_100">
                        <?php echo esc_html($title); ?><br />
                        <label for="edit-<?php echo '' . $key . '-' . $item_id; ?>">
                            <select id="edit-<?php echo '' . $key . '-' . $item_id; ?>" class=" <?php echo '' . $key; ?>" name="<?php echo '' . $key . "[" . $item_id . "]"; ?>">
                                <option value="autodrop_submenu" <?php echo ( $value == 'autodrop_submenu' ) ? ' selected="selected" ' : ''; ?>><?php esc_html_e('Auto drop', 'educatito'); ?></option>
                                <option value="drop_full_width" <?php echo ( $value == 'drop_full_width' ) ? ' selected="selected" ' : ''; ?>><?php esc_html_e('Full width', 'educatito'); ?></option>
                            </select>
                        </label>
                    </p>
                    <?php
                }
                if ($depth) {
                    $title = 'Widget Area';
                    $key = "menu-item-widget_area";
                    $value = $item->widget_area;
                    $sidebars = $GLOBALS['wp_registered_sidebars'];
                    ?>
                    <p class="description description-wide description_width_100 el_widget_area">
                        <?php echo esc_html($title); ?><br />
                        <label for="edit-<?php echo '' . $key . '-' . $item_id; ?>">
                            <select id="edit-<?php echo '' . $key . '-' . $item_id; ?>" class=" <?php echo '' . $key; ?>" name="<?php echo '' . $key . "[" . $item_id . "]"; ?>">
                                <option value="" <?php echo ( $value == '' ) ? ' selected="selected" ' : ''; ?>><?php esc_html_e('Select Widget Area', 'educatito'); ?></option>
                                <?php
                                foreach ($sidebars as $sidebar) {
                                    echo '<option value="' . $sidebar['id'] . '" ' . ( ( $value == $sidebar['id'] ) ? ' selected="selected" ' : '' ) . '>[' . $sidebar['id'] . '] - ' . $sidebar['name'] . '</option>';
                                }
                                ?>
                            </select>
                        </label>
                    </p>
                    <?php
                }
                if ($depth) {
                    $title = 'Hide title';
                    $key = "menu-item-hide_link";
                    $value = $item->hide_link;
                    ?>
                    <p class="description description-wide description_width_100">
                        <?php echo esc_html($title); ?><br />
                        <label for="edit-<?php echo '' . $key . '-' . $item_id; ?>">
                            <select id="edit-<?php echo '' . $key . '-' . $item_id; ?>" class=" <?php echo '' . $key; ?>" name="<?php echo '' . $key . "[" . $item_id . "]"; ?>">
                                <option value="0" <?php echo ( $value == '0' ) ? ' selected="selected" ' : ''; ?>><?php esc_html_e('No', 'educatito'); ?></option>
                                <option value="1" <?php echo ( $value == '1' ) ? ' selected="selected" ' : ''; ?>><?php esc_html_e('Yes', 'educatito'); ?></option>
                            </select>
                        </label>
                    </p>
                <?php } ?>
                <?php
                $title = 'Menu Icon';
                $key = "menu-item-menu_icon";
                $value = $item->menu_icon;
                ?>
                <div id="<?php echo '' . $key . '-' . $item_id . '-popup'; ?>" data-item_id="<?php echo '' . $item_id; ?>" class="menu_icon_wrap" style="display:none;">
                    <?php
                    $icons = array('adjust', 'adn', 'align-center', 'align-justify', 'align-left', 'align-right', 'ambulance', 'anchor', 'android', 'angle-double-down', 'angle-double-left', 'angle-double-right', 'angle-double-up', 'angle-down', 'angle-left', 'angle-right', 'angle-up', 'apple', 'archive', 'arrow-circle-down', 'arrow-circle-left', 'arrow-circle-o-down', 'arrow-circle-o-left', 'arrow-circle-o-right', 'arrow-circle-o-up', 'arrow-circle-right', 'arrow-circle-up', 'arrow-down', 'arrow-left', 'arrow-right', 'arrow-up', 'arrows', 'arrows-alt', 'arrows-h', 'arrows-v', 'asterisk', 'automobile', 'backward', 'ban', 'bank', 'bar-chart-o', 'barcode', 'bars', 'beer', 'behance', 'behance-square', 'bell', 'bell-o', 'bitbucket', 'bitbucket-square', 'bitcoin', 'bold', 'bolt', 'bomb', 'book', 'bookmark', 'bookmark-o', 'briefcase', 'btc', 'bug', 'building', 'building-o', 'bullhorn', 'bullseye', 'cab', 'calendar', 'calendar-o', 'camera', 'camera-retro', 'car', 'caret-down', 'caret-left', 'caret-right', 'caret-square-o-down', 'caret-square-o-left', 'caret-square-o-right', 'caret-square-o-up', 'caret-up', 'certificate', 'chain', 'chain-broken', 'check', 'check-circle', 'check-circle-o', 'check-square', 'check-square-o', 'chevron-circle-down', 'chevron-circle-left', 'chevron-circle-right', 'chevron-circle-up', 'chevron-down', 'chevron-left', 'chevron-right', 'chevron-up', 'child', 'circle', 'circle-o', 'circle-o-notch', 'circle-thin', 'clipboard', 'clock-o', 'cloud', 'cloud-download', 'cloud-upload', 'cny', 'code', 'code-fork', 'codepen', 'coffee', 'cog', 'cogs', 'columns', 'comment', 'comment-o', 'comments', 'comments-o', 'compass', 'compress', 'copy', 'credit-card', 'crop', 'crosshairs', 'css3', 'cube', 'cubes', 'cut', 'cutlery', 'dashboard', 'database', 'dedent', 'delicious', 'desktop', 'deviantart', 'digg', 'dollar', 'dot-circle-o', 'download', 'dribbble', 'dropbox', 'drupal', 'edit', 'eject', 'ellipsis-h', 'ellipsis-v', 'empire', 'envelope', 'envelope-o', 'envelope-square', 'eraser', 'eur', 'euro', 'exchange', 'exclamation', 'exclamation-circle', 'exclamation-triangle', 'expand', 'external-link', 'external-link-square', 'eye', 'eye-slash', 'facebook', 'facebook-square', 'fast-backward', 'fast-forward', 'fax', 'female', 'fighter-jet', 'file', 'file-archive-o', 'file-audio-o', 'file-code-o', 'file-excel-o', 'file-image-o', 'file-movie-o', 'file-o', 'file-pdf-o', 'file-photo-o', 'file-picture-o', 'file-powerpoint-o', 'file-sound-o', 'file-text', 'file-text-o', 'file-video-o', 'file-word-o', 'file-zip-o', 'files-o', 'film', 'filter', 'fire', 'fire-extinguisher', 'flag', 'flag-checkered', 'flag-o', 'flash', 'flask', 'flickr', 'floppy-o', 'folder', 'folder-o', 'folder-open', 'folder-open-o', 'font', 'forward', 'foursquare', 'frown-o', 'gamepad', 'gavel', 'gbp', 'ge', 'gear', 'gears', 'gift', 'git', 'git-square', 'github', 'github-alt', 'github-square', 'gittip', 'glass', 'globe', 'google', 'google-plus', 'google-plus-square', 'graduation-cap', 'group', 'h-square', 'hacker-news', 'hand-o-down', 'hand-o-left', 'hand-o-right', 'hand-o-up', 'hdd-o', 'header', 'headphones', 'heart', 'heart-o', 'history', 'home', 'hospital-o', 'html5', 'image', 'inbox', 'indent', 'info', 'info-circle', 'inr', 'instagram', 'institution', 'italic', 'joomla', 'jpy', 'jsfiddle', 'key', 'keyboard-o', 'krw', 'language', 'laptop', 'leaf', 'legal', 'lemon-o', 'level-down', 'level-up', 'life-bouy', 'life-ring', 'life-saver', 'lightbulb-o', 'link', 'linkedin', 'linkedin-square', 'linux', 'list', 'list-alt', 'list-ol', 'list-ul', 'location-arrow', 'lock', 'long-arrow-down', 'long-arrow-left', 'long-arrow-right', 'long-arrow-up', 'magic', 'magnet', 'mail-forward', 'mail-reply', 'mail-reply-all', 'male', 'map-marker', 'maxcdn', 'medkit', 'meh-o', 'microphone', 'microphone-slash', 'minus', 'minus-circle', 'minus-square', 'minus-square-o', 'mobile', 'mobile-phone', 'money', 'moon-o', 'educatito-board', 'music', 'navicon', 'openid', 'outdent', 'pagelines', 'paper-plane', 'paper-plane-o', 'paperclip', 'paragraph', 'paste', 'pause', 'paw', 'pencil', 'pencil-square', 'pencil-square-o', 'phone', 'phone-square', 'photo', 'picture-o', 'pied-piper', 'pied-piper-alt', 'pied-piper-square', 'pinterest', 'pinterest-square', 'plane', 'play', 'play-circle', 'play-circle-o', 'plus', 'plus-circle', 'plus-square', 'plus-square-o', 'power-off', 'print', 'puzzle-piece', 'qq', 'qrcode', 'question', 'question-circle', 'quote-left', 'quote-right', 'ra', 'random', 'rebel', 'recycle', 'reddit', 'reddit-square', 'refresh', 'renren', 'reorder', 'repeat', 'reply', 'reply-all', 'retweet', 'rmb', 'road', 'rocket', 'rotate-left', 'rotate-right', 'rouble', 'rss', 'rss-square', 'rub', 'ruble', 'rupee', 'save', 'scissors', 'search', 'search-minus', 'search-plus', 'send', 'send-o', 'share', 'share-alt', 'share-alt-square', 'share-square', 'share-square-o', 'shield', 'shopping-cart', 'sign-in', 'sign-out', 'signal', 'sitemap', 'skype', 'slack', 'sliders', 'smile-o', 'sort', 'sort-alpha-asc', 'sort-alpha-desc', 'sort-amount-asc', 'sort-amount-desc', 'sort-asc', 'sort-desc', 'sort-down', 'sort-numeric-asc', 'sort-numeric-desc', 'sort-up', 'soundcloud', 'space-shuttle', 'spinner', 'spoon', 'spotify', 'square', 'square-o', 'stack-exchange', 'stack-overflow', 'star', 'star-half', 'star-half-empty', 'star-half-full', 'star-half-o', 'star-o', 'steam', 'steam-square', 'step-backward', 'step-forward', 'stethoscope', 'stop', 'strikethrough', 'stumbleupon', 'stumbleupon-circle', 'subscript', 'suitcase', 'sun-o', 'superscript', 'support', 'table', 'tablet', 'tachometer', 'tag', 'tags', 'tasks', 'taxi', 'tencent-weibo', 'terminal', 'text-height', 'text-width', 'th', 'th-large', 'th-list', 'thumb-tack', 'thumbs-down', 'thumbs-o-down', 'thumbs-o-up', 'thumbs-up', 'ticket', 'times', 'times-circle', 'times-circle-o', 'tint', 'toggle-down', 'toggle-left', 'toggle-right', 'toggle-up', 'trash-o', 'tree', 'trello', 'trophy', 'truck', 'try', 'tumblr', 'tumblr-square', 'turkish-lira', 'twitter', 'twitter-square', 'umbrella', 'underline', 'undo', 'university', 'unlink', 'unlock', 'unlock-alt', 'unsorted', 'upload', 'usd', 'user', 'user-md', 'users', 'video-camera', 'vimeo-square', 'vine', 'vk', 'volume-down', 'volume-off', 'volume-up', 'warning', 'wechat', 'weibo', 'weixin', 'wheelchair', 'windows', 'won', 'wordpress', 'wrench', 'xing', 'xing-square', 'yahoo', 'yen', 'youtube', 'youtube-play', 'youtube-square');
                    $html = '<input type="hidden" name="" class="wpb_vc_param_value" value="' . $value . '" id="trace"/> ';
                    $html .= '<div class="icon-preview icon-preview-' . $item_id . '"><i class=" fa fa-' . $value . '"></i></div>';
                    $html .= '<div id="' . $key . '-' . $item_id . '-icon-dropdown" >';
                    $html .= '<ul class="icon-list">';
                    $n = 1;
                    foreach ($icons as $icon) {
                        $selected = ( $icon == $value ) ? 'class="selected"' : '';
                        $id = 'icon-' . $n;
                        $html .= '<li ' . $selected . ' data-icon="' . $icon . '"><i class="icon fa fa-' . $icon . '"></i></li>';
                        $n ++;
                    }
                    $html .= '</ul>';
                    $html .= '</div>';
                    echo '' . $html;
                    ?>
                </div>
                <p class="description description-wide obtheme_checkbox obtheme_mega_menu obtheme_mega_menu_d1">
                    <label for="edit-<?php echo '' . $key . '-' . $item_id; ?>">
                        <?php echo esc_html($title); ?><br />
                        <input type="text" value="<?php echo '' . $value; ?>" id="edit-<?php echo '' . $key . '-' . $item_id; ?>" class=" <?php echo '' . $key; ?>" name="<?php echo '' . $key . "[" . $item_id . "]"; ?>" />
                        <input alt="#TB_inline?height=400&width=500&inlineId=<?php echo '' . $key . '-' . $item_id . '-popup'; ?>" title="<?php esc_html_e('Click to browse icon', 'educatito') ?>" class="thickbox button-secondary submit-add-to-menu" type="button" value="<?php esc_html_e('Browse Icon', 'educatito') ?>" />
                        <a class="button btn_clear button-primary" href="javascript: void(0);">Clear</a>
                        <span class="icon-preview  icon-preview<?php echo '-' . $item_id; ?>"><i class=" fa fa-<?php echo '' . $value; ?>"></i></span>
                    </label>
                </p>
                <?php
                $title = 'Sub text';
                $key = "menu-item-sub_text";
                $value = $item->sub_text;
                ?>
                <p class="description description-thin">
                    <?php echo esc_html($title); ?><br />
                    <label for="edit-<?php echo '' . $key . '-' . $item_id; ?>">
                        <input type="text" class="widefat" value="<?php echo '' . $value; ?>" id="edit-<?php echo '' . $key . '-' . $item_id; ?>" class=" <?php echo '' . $key; ?>" name="<?php echo '' . $key . "[" . $item_id . "]"; ?>" />
                    </label>
                </p>
                <?php
                $title = 'Sub text color';
                $key = "menu-item-sub_text_color";
                $value = $item->sub_text_color;
                ?>
                <p class="description description-thin">
                    <?php echo esc_html($title); ?><br />
                    <label for="edit-<?php echo '' . $key . '-' . $item_id; ?>">
                        <input type="text" class="widefat" value="<?php echo '' . $value; ?>" id="edit-<?php echo '' . $key . '-' . $item_id; ?>" class=" <?php echo '' . $key; ?>" name="<?php echo '' . $key . "[" . $item_id . "]"; ?>" />
                    </label>
                </p>
                <div class="menu-item-actions description-wide submitbox">
                    <?php if ('custom' != $item->type && $original_title !== false) : ?>
                        <p class="link-to-original">
                            <?php printf(esc_html__('Original: %s', 'educatito'), '<a href="' . esc_attr($item->url) . '">' . esc_html($original_title) . '</a>'); ?>
                        </p>
                    <?php endif; ?>
                    <a class="item-delete submitdelete deletion" id="delete-<?php echo '' . $item_id; ?>" href="<?php
                    echo wp_nonce_url(
                            add_query_arg(
                                    array(
                        'action' => 'delete-menu-item',
                        'menu-item' => $item_id,
                                    ), remove_query_arg($removed_args, admin_url('nav-menus.php'))
                            ), 'delete-menu_item_' . $item_id
                    );
                    ?>"><?php esc_html_e('Remove', 'educatito'); ?></a> <span class="meta-sep"> | </span> <a class="item-cancel submitcancel" id="cancel-<?php echo '' . $item_id; ?>" href="<?php echo esc_url(add_query_arg(array('edit-menu-item' => $item_id, 'cancel' => time()), remove_query_arg($removed_args, admin_url('nav-menus.php'))));
                    ?>#menu-item-settings-<?php echo '' . $item_id; ?>"><?php esc_html_e('Cancel', 'educatito'); ?></a>
                </div>
                <input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo '' . $item_id; ?>]" value="<?php echo '' . $item_id; ?>" />
                <input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo '' . $item_id; ?>]" value="<?php echo esc_attr($item->object_id); ?>" />
                <input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo '' . $item_id; ?>]" value="<?php echo esc_attr($item->object); ?>" />
                <input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo '' . $item_id; ?>]" value="<?php echo esc_attr($item->menu_item_parent); ?>" />
                <input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo '' . $item_id; ?>]" value="<?php echo esc_attr($item->menu_order); ?>" />
                <input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo '' . $item_id; ?>]" value="<?php echo esc_attr($item->type); ?>" />
            </div><!-- .menu-item-settings-->
            <ul class="menu-item-transport"></ul>
            <?php
            $output .= ob_get_clean();
        }

    }

    class EducatitoMenuWalker extends Walker_Nav_Menu {

        function display_element($element, &$children_elements, $max_depth, $depth, $args, &$output) {
            if (!$element) {
                return;
            }
            $id_field = $this->db_fields['id'];
            //display this element
            if (isset($args[0]) && is_array($args[0])) {
                $args[0]['has_children'] = !empty($children_elements[$element->$id_field]);
            }
            $cb_args = array_merge(array(&$output, $element, $depth), $args);
            call_user_func_array(array($this, 'start_el'), $cb_args);

            $id = $element->$id_field;

            // descend only when the depth is right and there are childrens for this element
            if (( $max_depth == 0 || $max_depth > $depth + 1 ) && isset($children_elements[$id])) {
                $b = $args[0];
                $b->element = $element;
                $b->count_child = count($children_elements[$id]);
                $args[0] = $b;
                foreach ($children_elements[$id] as $child) {
                    if (!isset($newlevel)) {
                        $newlevel = true;
                        //start the child delimiter
                        $cb_args = array_merge(array(&$output, $depth), $args);
                        $cb_args = array_merge(array(&$output, $depth), $args);
                        call_user_func_array(array($this, 'start_lvl'), $cb_args);
                    }
                    $this->display_element($child, $children_elements, $max_depth, $depth + 1, $args, $output);
                }
                unset($children_elements[$id]);
            }

            if (isset($newlevel) && $newlevel) {
                //end the child delimiter
                $cb_args = array_merge(array(&$output, $depth), $args);
                call_user_func_array(array($this, 'end_lvl'), $cb_args);
            }

            //end this element
            $cb_args = array_merge(array(&$output, $element, $depth), $args);
            call_user_func_array(array($this, 'end_el'), $cb_args);
        }

        function start_lvl(&$output, $depth = 0, $args = array()) {
            $submenu_type = isset($args->element->submenu_type) ? $args->element->submenu_type : 'standard';
            $dropdown = isset($args->element->dropdown) ? $args->element->dropdown : 'drop_to_left';
            $class = null;
            $style = 'style="';
            $columns = array('columns2' => 1, 'columns3' => 3, 'columns4' => 4, 'columns5' => 5);
            if ($submenu_type != 'standard' && $depth == 0) {
                if (isset($columns[$submenu_type])) {
                    $class = 'multicolumn mega-columns-' . $columns[$submenu_type];
                }
                $class = 'multicolumn';
            } else if ($depth == 0) {
                $class = 'standar-dropdown';
            }
            $class .= ' ' . $submenu_type;
            $class .= ' ' . $dropdown;
            $class .= ' sub-menu ';
            $style .= '"';
            $indent = str_repeat("\t", $depth);

            $output .= "\n$indent<ul class='$class' $style>\n";
        }

        public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
            $indent = ( $depth ) ? str_repeat("\t", $depth) : '';
            $class_names = '';
            $menu_icon = isset($item->menu_icon) ? $item->menu_icon : '';
            $sub_text = isset($item->sub_text) ? $item->sub_text : '';
            $sub_text_color = isset($item->sub_text_color) ? $item->sub_text_color : '';
            $dropdown = isset($item->dropdown) ? $item->dropdown : '';
            $hide_link = isset($item->hide_link) ? $item->hide_link : 0;
            $classes = empty($item->classes) ? array() : (array) $item->classes;
            if ($dropdown == "drop_full_width") {
                $classes[] = 'menu_full_width';
            }
            if ($hide_link) {
                $classes[] = ' hidden-menu-item';
            }
            $classes[] = 'menu-item-' . $item->ID;
            $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
            $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
            $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
            $id = $id ? ' id="' . esc_attr($id) . '"' : '';
            $output .= $indent . '<li' . $id . $class_names . ' data-depth="' . $depth . '">';
            $atts = array();
            $atts['target'] = !empty($item->target) ? $item->target : '';
            $atts['rel'] = !empty($item->xfn) ? $item->xfn : '';
            $atts['href'] = !empty($item->url) ? $item->url : '';
            $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args);
            $attributes = '';
            foreach ($atts as $attr => $value) {
                if (!empty($value)) {
                    $value = ( 'href' === $attr ) ? esc_url($value) : esc_attr($value);
                    $attributes .= ' ' . $attr . '="' . $value . '"';
                }
            }
            $attr_title = !empty($item->attr_title) ? $item->attr_title : '';
            $item_output = isset($args->before) ? $args->before : '';
            $link_before = isset($args->link_before) ? $args->link_before : '';
            $link_after = isset($args->link_after) ? $args->link_after : '';
            $after = isset($args->after) ? $args->after : '';
            $item_output .= '<a' . $attributes . '>';
            $item_output .= '<span class="menu-title">';
            if ($menu_icon) {
                $item_output .= '<i class="fa fa-fw fa-' . $menu_icon . '"></i> ';
            } else {
                $item_output .= ' ';
            }
            $item_output .= '<span class="title-menu">' . $link_before . apply_filters('the_title', $item->title, $item->ID) . $link_after . "</span>";
            if ($attr_title) {
                $item_output .= '<span class="title-attribute">' . $attr_title . '</span> ';
            }
            if ($sub_text) {
                if ($sub_text_color) {
                    $item_output .= '<span class="sub_text" style="border-color: ' . $sub_text_color . ';border: 1px solid ' . $sub_text_color . '; background-color: ' . $sub_text_color . ';">' . $sub_text . '</span> ';
                } else {
                    $item_output .= '<span class="sub_text">' . $sub_text . '</span> ';
                }
            }
            $item_output .= '</span></a>';
            $widget_area = $item->widget_area;
            if ($widget_area && $depth != 0) {
                ob_start();
                dynamic_sidebar($widget_area);
                $content = ob_get_clean();
                if ($content) {
                    $item_output .= $content;
                }
            }
            $item_output .= $after;

            $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
        }

    }

    if (!function_exists('educatito_get_main_menu_parent_items')) {

        function educatito_get_main_menu_parent_items() {
            $menu_name = 'cs_main_menu';
            $locations = get_nav_menu_locations();
            $items = array();

            if (isset($locations[$menu_name]) && $locations[$menu_name] != 0) {
                $menu_id = $locations[$menu_name];
                $items = educatito_get_menu_parent_items($menu_id);
                $trans_items = educatito_get_translation_items($menu_id);
                if (!empty($trans_items)) {
                    $items = array_merge($items, $trans_items);
                }
            }

            return $items;
        }

    }

    if (!function_exists('educatito_get_menu_parent_items')) {

        function educatito_get_menu_parent_items($menu_id) {
            $menu = wp_get_nav_menu_object($menu_id);
            $menu_items = wp_get_nav_menu_items($menu->term_id);
            $items = array();

            if (sizeof($menu_items)) {
                foreach ($menu_items as $item) {
                    if ($item->menu_item_parent == 0) {
                        $items[] = array('id' => $item->ID, 'name' => $item->title);
                    }
                }
            }

            return $items;
        }

    }

    /*
     * Saves new field to post meta for navigation
     */
    add_filter('wp_nav_menu_args', 'educatito_modify_arguments', 100);

    function educatito_modify_arguments($arguments) {
        $arguments['walker'] = new EducatitoMenuWalker();
        return $arguments;
    }

    add_action('wp_update_nav_menu_item', 'educatito_custom_nav_update', 10, 3);

    function educatito_custom_nav_update($menu_id, $menu_item_db_id, $args) {
        $fields = array('submenu_type', 'dropdown', 'widget_area', 'column_width', 'hide_link', 'menu_icon', 'sub_text', 'sub_text_color');
        foreach ($fields as $i => $field) {
            if (isset($_REQUEST['menu-item-' . $field][$menu_item_db_id])) {
                $mega_value = $_REQUEST['menu-item-' . $field][$menu_item_db_id];
                update_post_meta($menu_item_db_id, '_menu_item_' . $field, $mega_value);
            } else {
                update_post_meta($menu_item_db_id, '_menu_item_' . $field, '');
            }
        }
    }

    /*
     * Adds value of new field to $item object that will be passed to Walker_Nav_Menu_Edit_Custom
     */
    add_filter('wp_setup_nav_menu_item', 'educatito_custom_nav_item');

    function educatito_custom_nav_item($menu_item) {
        $fields = array('submenu_type', 'dropdown', 'widget_area', 'column_width', 'hide_link', 'menu_icon', 'sub_text', 'sub_text_color');
        foreach ($fields as $i => $field) {
            $menu_item->$field = get_post_meta($menu_item->ID, '_menu_item_' . $field, true);
        }
        return $menu_item;
    }

    add_action('admin_enqueue_scripts', 'educatito_add_js_mega_menu');

    function educatito_add_js_mega_menu() {
        wp_enqueue_script('mega_menu_js', EDUCATITO_PLUGIN_URL . '/inc/megamenu/js/megamenu.js', array('jquery', 'jquery-ui-sortable'), false, true);
        wp_enqueue_style('mega_menu_css', EDUCATITO_PLUGIN_URL . '/inc/megamenu/css/megamenu.css');
        wp_enqueue_style('font-awesome');
        wp_enqueue_media();
        add_thickbox();
    }

    add_filter('wp_edit_nav_menu_walker', 'educatito_custom_nav_edit_walker', 10, 2);

    function educatito_custom_nav_edit_walker($walker, $menu_id) {
        return 'Walker_Nav_Menu_Edit_Custom';
    }
    