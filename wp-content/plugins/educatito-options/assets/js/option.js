/**
 * CUSTOM js
 *
 * contains the core functionalities to be used
 * inside CUSTOM
 */

jQuery.noConflict();

/** Fire up jQuery - let's dance! 
 */
jQuery(document).ready(function ($) {
    jQuery("#educatito_options-jrb_enable_import_demo_data .cb-enable").click(function () {
        jQuery("#demo_import_bt").css("display", "block");
    });
    jQuery("#educatito_options-jrb_enable_import_demo_data .cb-disable").click(function () {
        jQuery("#demo_import_bt").css("display", "none");
    });

    var import_checked = $('#jrb_enable_import_demo_data:checked').length;
    if (import_checked) {
        $('#demo_import_bt').css('display', 'block');
    } else {
        $('#demo_import_bt').css('display', 'none');
    }
}); //end doc ready
(function ($) {
    "use strict";
    jQuery.noConflict(); 
    jQuery(document).ready(function ($) {
        var colorschemes = new Array('default1','default2','default3','default4','default5','default6','default7','default8','default9','default10'); 
        colorschemes['default1'] = new Array('jrb_primary_color','jrb_link_color','jrb_link_hover_color','jrb_background_submenu','jrb_menu_acti_color','jrb_menu_background_hover_color','jrb_button_text_color','jrb_color_link_hover_footer');
        colorschemes['default1']['jrb_primary_color'] = '#f9bf0f';
        colorschemes['default1']['jrb_link_color'] = '#4e5453';
        colorschemes['default1']['jrb_link_hover_color'] = '#f9bf0f';
        colorschemes['default1']['jrb_background_submenu'] = '#ffffff';
        colorschemes['default1']['jrb_menu_acti_color'] = '#f9bf0f';
        colorschemes['default1']['jrb_menu_background_hover_color'] = 'tranparent';
        colorschemes['default1']['jrb_button_text_color'] = '#f9bf0f';
        colorschemes['default1']['jrb_color_link_hover_footer'] = '#f9bf0f';
        colorschemes['default2'] = new Array('jrb_primary_color','jrb_link_color','jrb_link_hover_color','jrb_background_submenu','jrb_menu_acti_color','jrb_menu_background_hover_color','jrb_button_text_color','jrb_color_link_hover_footer'); 
        colorschemes['default2']['jrb_primary_color'] = '#f8c767';
        colorschemes['default2']['jrb_link_color'] = '#f8c767';
        colorschemes['default2']['jrb_link_hover_color'] = '#005ca8';
        colorschemes['default2']['jrb_background_submenu'] = '#f8c767';
        colorschemes['default2']['jrb_menu_acti_color'] = '#f8c767';
        colorschemes['default2']['jrb_menu_background_hover_color'] = '#f8c767';
        colorschemes['default2']['jrb_button_text_color'] = '#f8c767';
        colorschemes['default2']['jrb_color_link_hover_footer'] = '#f8c767';
        colorschemes['default3'] = new Array('jrb_primary_color','jrb_link_color','jrb_link_hover_color','jrb_background_submenu','jrb_menu_acti_color','jrb_menu_background_hover_color','jrb_button_text_color','jrb_color_link_hover_footer');
        colorschemes['default3']['jrb_primary_color'] = '#ff8d00';
        colorschemes['default3']['jrb_link_color'] = '#ff8d00';
        colorschemes['default3']['jrb_link_hover_color'] = '#ce4f00';
        colorschemes['default3']['jrb_background_submenu'] = '#ff8d00';
        colorschemes['default3']['jrb_menu_acti_color'] = '#ff8d00';
        colorschemes['default3']['jrb_menu_background_hover_color'] = '#ff8d00';
        colorschemes['default3']['jrb_button_text_color'] = '#ff8d00';
        colorschemes['default3']['jrb_color_link_hover_footer'] = '#ff8d00';
        colorschemes['default4'] = new Array('jrb_primary_color','jrb_link_color','jrb_link_hover_color','jrb_background_submenu','jrb_menu_acti_color','jrb_menu_background_hover_color','jrb_button_text_color','jrb_color_link_hover_footer');
        colorschemes['default4']['jrb_primary_color'] = '#cc2149';
        colorschemes['default4']['jrb_link_color'] = '#cc2149';
        colorschemes['default4']['jrb_link_hover_color'] = '#74132a';
        colorschemes['default4']['jrb_background_submenu'] = '#74132a';
        colorschemes['default4']['jrb_menu_acti_color'] = '#74132a';
        colorschemes['default4']['jrb_menu_background_hover_color'] = '#74132a';
        colorschemes['default4']['jrb_button_text_color'] = '#74132a';
        colorschemes['default4']['jrb_color_link_hover_footer'] = '#74132a';
        colorschemes['default5'] = new Array('jrb_primary_color','jrb_link_color','jrb_link_hover_color','jrb_background_submenu','jrb_menu_acti_color','jrb_menu_background_hover_color','jrb_button_text_color','jrb_color_link_hover_footer');
        colorschemes['default5']['jrb_primary_color'] = '#ff804e';
        colorschemes['default5']['jrb_link_color'] = '#ff804e';
        colorschemes['default5']['jrb_link_hover_color'] = '#e74100';
        colorschemes['default5']['jrb_background_submenu'] = '#e74100';
        colorschemes['default5']['jrb_menu_acti_color'] = '#e74100';
        colorschemes['default5']['jrb_menu_background_hover_color'] = '#e74100';
        colorschemes['default5']['jrb_button_text_color'] = '#e74100';
        colorschemes['default5']['jrb_color_link_hover_footer'] = '#e74100';
        colorschemes['default6'] = new Array('jrb_primary_color','jrb_link_color','jrb_link_hover_color','jrb_background_submenu','jrb_menu_acti_color','jrb_menu_background_hover_color','jrb_button_text_color','jrb_color_link_hover_footer');
        colorschemes['default6']['jrb_primary_color'] = '#6576c2';
        colorschemes['default6']['jrb_link_color'] = '#6576c2';
        colorschemes['default6']['jrb_link_hover_color'] = '#5361a0';
        colorschemes['default6']['jrb_background_submenu'] = '#6576c2';
        colorschemes['default6']['jrb_menu_acti_color'] = '#6576c2';
        colorschemes['default6']['jrb_menu_background_hover_color'] = '#6576c2';
        colorschemes['default6']['jrb_button_text_color'] = '#6576c2';
        colorschemes['default6']['jrb_color_link_hover_footer'] = '#6576c2';
        colorschemes['default7'] = new Array('jrb_primary_color','jrb_link_color','jrb_link_hover_color','jrb_background_submenu','jrb_menu_acti_color','jrb_menu_background_hover_color','jrb_button_text_color','jrb_color_link_hover_footer');
        colorschemes['default7']['jrb_primary_color'] = '#a2e000';
        colorschemes['default7']['jrb_link_color'] = '#a2e000';
        colorschemes['default7']['jrb_link_hover_color'] = '#587a00';
        colorschemes['default7']['jrb_background_submenu'] = '#a2e000';
        colorschemes['default7']['jrb_menu_acti_color'] = '#a2e000';
        colorschemes['default7']['jrb_menu_background_hover_color'] = '#a2e000';
        colorschemes['default7']['jrb_button_text_color'] = '#a2e000';
        colorschemes['default7']['jrb_color_link_hover_footer'] = '#a2e000';
        colorschemes['default8'] = new Array('jrb_primary_color','jrb_link_color','jrb_link_hover_color','jrb_background_submenu','jrb_menu_acti_color','jrb_menu_background_hover_color','jrb_button_text_color','jrb_color_link_hover_footer');
        colorschemes['default8']['jrb_primary_color'] = '#a16a2a';
        colorschemes['default8']['jrb_link_color'] = '#a16a2a';
        colorschemes['default8']['jrb_link_hover_color'] = '#773a1b';
        colorschemes['default8']['jrb_background_submenu'] = '#a16a2a';
        colorschemes['default8']['jrb_menu_acti_color'] = '#a16a2a';
        colorschemes['default8']['jrb_menu_background_hover_color'] = '#a16a2a';
        colorschemes['default8']['jrb_button_text_color'] = '#a16a2a';
        colorschemes['default8']['jrb_color_link_hover_footer'] = '#a16a2a';
        colorschemes['default9'] = new Array('jrb_primary_color','jrb_link_color','jrb_link_hover_color','jrb_background_submenu','jrb_menu_acti_color','jrb_menu_background_hover_color','jrb_button_text_color','jrb_color_link_hover_footer');
        colorschemes['default9']['jrb_primary_color'] = '#4ec7aa';
        colorschemes['default9']['jrb_link_color'] = '#4ec7aa';
        colorschemes['default9']['jrb_link_hover_color'] = '#3a9684';
        colorschemes['default9']['jrb_background_submenu'] = '#4ec7aa';
        colorschemes['default9']['jrb_menu_acti_color'] = '#4ec7aa';
        colorschemes['default9']['jrb_menu_background_hover_color'] = '#4ec7aa';
        colorschemes['default9']['jrb_button_text_color'] = '#4ec7aa';
        colorschemes['default9']['jrb_color_link_hover_footer'] = '#4ec7aa';
        colorschemes['default10'] = new Array('jrb_primary_color','jrb_link_color','jrb_link_hover_color','jrb_background_submenu','jrb_menu_acti_color','jrb_menu_background_hover_color','jrb_button_text_color','jrb_color_link_hover_footer');
        colorschemes['default10']['jrb_primary_color'] = '#d6d233';
        colorschemes['default10']['jrb_link_color'] = '#d6d233'; 
        colorschemes['default10']['jrb_link_hover_color'] = '#af9b2a';
        colorschemes['default10']['jrb_background_submenu'] = '#d6d233'; 
        colorschemes['default10']['jrb_menu_acti_color'] = '#d6d233';
        colorschemes['default10']['jrb_menu_background_hover_color'] = '#d6d233';
        colorschemes['default10']['jrb_button_text_color'] = '#d6d233';
        colorschemes['default10']['jrb_color_link_hover_footer'] = '#d6d233';
 
        $('#jrb_preset_color_scheme-select').change(function () {
            var colorscheme = $(this).val();
            var colorscheme_val; 
            if(colorscheme === 'default1') colorscheme_val = colorschemes.default1;
            if(colorscheme === 'default2') colorscheme_val = colorschemes.default2;
            if(colorscheme === 'default3') colorscheme_val = colorschemes.default3;
            if(colorscheme === 'default4') colorscheme_val = colorschemes.default4;
            if(colorscheme === 'default5') colorscheme_val = colorschemes.default5;
            if(colorscheme === 'default6') colorscheme_val = colorschemes.default6;
            if(colorscheme === 'default7') colorscheme_val = colorschemes.default7;
            if(colorscheme === 'default8') colorscheme_val = colorschemes.default8;
            if(colorscheme === 'default9') colorscheme_val = colorschemes.default9;
            if(colorscheme === 'default10') colorscheme_val = colorschemes.default10;
            
            $('#educatito_options-jrb_primary_color').find('.redux-color').val(colorscheme_val.jrb_primary_color).change();
            $('#educatito_options-jrb_link_color').find('.redux-color').val(colorscheme_val.jrb_link_color).change();
            $('#educatito_options-jrb_link_hover_color').find('.redux-color').val(colorscheme_val.jrb_link_hover_color).change();
            $('#educatito_options-jrb_background_submenu').find('.redux-color').val(colorscheme_val.jrb_background_submenu).change();
            $('#educatito_options-jrb_menu_acti_color').find('.redux-color').val(colorscheme_val.jrb_menu_acti_color).change();
            $('#educatito_options-jrb_menu_background_hover_color').find('.redux-color').val(colorscheme_val.jrb_menu_background_hover_color).change();
            $('#educatito_options-jrb_button_text_color').find('.redux-color').val(colorscheme_val.jrb_button_text_color).change();
            $('#educatito_options-jrb_color_link_hover_footer').find('.redux-color').val(colorscheme_val.jrb_color_link_hover_footer).change(); 
        });     
    });
})(jQuery);

