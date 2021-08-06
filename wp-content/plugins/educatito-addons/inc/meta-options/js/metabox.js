(function ($) {
    "use strict";
    jQuery(document).ready(function ($) {
        $(".tabs-menu a").click(function (event) {
            event.preventDefault();
            $(this).parent().addClass("current");
            $(this).parent().siblings().removeClass("current");
            var tab = $(this).attr("href");
            $(".tab-content").not(tab).css("display", "none");
            $(tab).fadeIn();
        });
        $('select[name="_jrb_header_position"]').change(function () {
            var value = $(this).val();
            if (value === 'top') {
                $('#page_header_enable_menu').show();
            } else {
                $('#page_header_enable_menu').hide();
            }
        });
        $('select[name="_jrb_footer_layout"]').change(function () {
            var value = $(this).val();
            var i;
            for (i = 1; i <= 5; ++i) {
                if (i <= value) {
                    $('.footer_widget_' + i).show();
                } else {
                    $('.footer_widget_' + i).hide();
                }
            }
        });



        $('#post-formats-select input').change(checkformat);
        $('.wp-post-format-ui .post-format-options > a').click(checkformat);
        videoType();
        audioType();
        checkformat();
        quoteType();

        $("#educatito_post_quote_type").change(function () {
            quoteType();
        });

        $("#educatito_post_video_source").change(function () {
            videoType();
        });

        $("#educatito_post_audio_type").change(function () {
            audioType();
        });

        function checkformat() {
            "use strict";
            var formats = ["gallery", "link", "image", "quote", "video", "audio", "chat"];
            var format = $('#post-formats-select input:checked').attr('value');
            var i = 0;
            for (i = 0; i < formats.length; i++) {
                if (formats[i] == format) {
                    $("#educatito_post_" + format + "").css('display', 'block');
                } else {
                    $("#educatito_post_" + formats[i] + "").css('display', 'none');
                }
            }
        }

        function quoteType() {
            "use strict";
            switch ($("#educatito_post_quote_type").val()) {
                case 'custom':
                    $("#post_quote_custom").css('display', 'block');
                    break;
                default:
                    $("#post_quote_custom").css('display', 'none');
                    break;
            }
        }

        function audioType() {
            "use strict";
            switch ($("#educatito_post_audio_type").val()) {
                case '':
                    $("#educatito_metabox_field_post_audio_url").css('display', 'none');
                    break;
                case 'content':
                    $("#educatito_metabox_field_post_audio_url").css('display', 'none');
                    break;
                default:
                    $("#educatito_metabox_field_post_audio_url").css('display', 'block');
                    break;
            }
        }
        function videoType() {
            "use strict";
            switch ($("#educatito_post_video_source").val()) {
                case '':
                    $("#educatito_video_setting").css('display', 'none');
                    break;
                case 'post':
                    $("#educatito_video_setting").css('display', 'none');
                    break;
                case 'media':
                    $("#educatito_metabox_field_post_video_type").css('display', 'block');
                    $("#educatito_metabox_field_post_video_url").css('display', 'block');
                    $("#educatito_metabox_field_post_preview_image").css('display', 'block');
                    $("#educatito_metabox_field_post_video_youtube").css('display', 'none');
                    $("#educatito_metabox_field_post_video_vimeo").css('display', 'none');
                    $("#educatito_video_setting").css('display', 'block');
                    break;
                case 'youtube':
                    $("#educatito_metabox_field_post_video_type").css('display', 'none');
                    $("#educatito_metabox_field_post_video_url").css('display', 'none');
                    $("#educatito_metabox_field_post_preview_image").css('display', 'none');
                    $("#educatito_metabox_field_post_video_youtube").css('display', 'block');
                    $("#educatito_metabox_field_post_video_vimeo").css('display', 'none');
                    $("#educatito_video_setting").css('display', 'block');
                    break;
                case 'vimeo':
                    $("#educatito_metabox_field_post_video_type").css('display', 'none');
                    $("#educatito_metabox_field_post_video_url").css('display', 'none');
                    $("#educatito_metabox_field_post_preview_image").css('display', 'none');
                    $("#educatito_metabox_field_post_video_youtube").css('display', 'none');
                    $("#educatito_metabox_field_post_video_vimeo").css('display', 'block');
                    $("#educatito_video_setting").css('display', 'block');
                    break;
            }
        }
		
		// Uploading files
        var file_frame;

        jQuery.fn.upload_bg_title_bar = function (button) {
            var button_id = button.attr('id');
            var field_id = button_id.replace('_button', '');

            // If the media frame already exists, reopen it.
            if (file_frame) {
                file_frame.open();
                return;
            }

            // Create the media frame.
            file_frame = wp.media.frames.file_frame = wp.media({
                title: jQuery(this).data('uploader_title'),
                button: {
                    text: jQuery(this).data('uploader_button_text'),
                },
                multiple: false
            });

            // When an image is selected, run a callback.
            file_frame.on('select', function () {
                var attachment = file_frame.state().get('selection').first().toJSON();
                jQuery("#" + field_id).val(attachment.id);
                jQuery("#introimagediv img").attr('src', attachment.url);
                jQuery("#introimagediv img").attr('srcset', attachment.url);
                jQuery('#introimagediv img').show();
                jQuery('#' + button_id).attr('id', 'remove_bg_title_bar_button');
                jQuery('#remove_bg_title_bar_button').text('Remove background image');
            });

            // Finally, open the modal
            file_frame.open();
        };

        jQuery('#introimagediv').on('click', '#upload_bg_title_bar_button', function (event) {
            event.preventDefault();
            jQuery.fn.upload_bg_title_bar(jQuery(this));
        });

        jQuery('#introimagediv').on('click', '#remove_bg_title_bar_button', function (event) {
            event.preventDefault();
            jQuery('#upload_bg_title_bar').val('');
            jQuery('#introimagediv img').attr('src', '');
            jQuery('#introimagediv img').hide();
            jQuery(this).attr('id', 'upload_bg_title_bar_button');
            jQuery('#upload_bg_title_bar_button').text('Set background image');
        });

    });
})(jQuery);