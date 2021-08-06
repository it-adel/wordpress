(function($) { 
    "use strict";
    jQuery(document).ready(function($){
    if($('.cshero_upload_button').length >= 1) {
        window.cshero_uploadfield = '';

        $('.cshero_upload_button').live('click', function() {
            window.cshero_uploadfield = $('.upload_field', $(this).parent());
            tb_show('Upload', 'media-upload.php?type=file&TB_iframe=true', false);

            return false;
        });

        $('.cshero_clear_button').on('click', function () {
			var clear_id = $(this).attr("data-id");
			$("#"+clear_id+"").val("");
		})

        window.cshero_send_to_editor_backup = window.send_to_editor;
        window.send_to_editor = function(html) {
            if(window.cshero_uploadfield) {
                var file_url = $('img', html).attr('src');
                if(file_url == undefined){
                	file_url = $("a", '<div>'+html+'<div>').attr("href");
                }
                console.log(this);
                $(window.cshero_uploadfield).val(file_url);
                window.cshero_uploadfield = '';
                tb_remove();
            } else {
                window.cshero_send_to_editor_backup(html);
            }
        }
    }
});
jQuery(document).ready(function($){
    if($('.educatito_upload_button').length >= 1) {
            window.cshero_uploadfield = '';

            $('.educatito_upload_button').live('click', function() {
                    window.cshero_uploadfield = $('.upload_field', $(this).parent());
                    tb_show('Upload', 'media-upload.php?type=image&TB_iframe=true', false);

                    return false;
            });

            window.educatito_send_to_editor_backup = window.send_to_editor;
            window.send_to_editor = function(html) {
                    if(window.cshero_uploadfield) {
                            var image_url = $('img', html).attr('src');
                            $(window.cshero_uploadfield).val(image_url);
                            window.cshero_uploadfield = '';
                            tb_remove();
                    } else {
                            window.educatito_send_to_editor_backup(html);
                    }
            }
    }
});
})(jQuery);
