<?php
/**
 * Shortcode Educatito Register.
 *
 * @package Educatito
 * @author JRB Themes
 * @link http://educatito.jrbthemes.com
 */
/* -------------------Educatito Register---------------------- */
if (!function_exists('educatito_educatito_register_template')):

    function educatito_educatito_register_template($atts) {
        ob_start();
        extract(shortcode_atts(array(
            'el_class' => '',
                        ), $atts));
        global $post;
        ?>
        <div class="flat-form-register <?php echo esc_attr($el_class); ?>">
            <div class="uk-container uk-container-center">
                <form class="form-educatito-register" action="" method="post">
                    <h5 class="title-form"><?php echo esc_html__('Create Your Free Account', 'educatito') ?></h5>
                    <span class="error-user-signup error-user-password error-user-repassword error"></span>
                    <input type="hidden" name="search" value="advanced">
                    <div class="field uk-clearfix">
                        <p class="field-user-name ">
                            <input type="email" size="30" placeholder="Email" id="user_signup" name="user_signup">
                        </p>
                        <p class="field-password">
                            <input type="password" size="30" placeholder="Password" id="user_password" name="user_password">
                        </p>
                        <p class="field-repassword">
                            <input type="password" size="30" placeholder="Confirm Password" id="user_repassword" name="user_repassword">
                        </p>
                        <p class="field-submit">
                            <button class="btn btn-lg btn-primary btn-block hover-button" id="bt-signup" type="button"><?php echo esc_html__('Get it now', 'oceanwp') ?></button>
                        </p>
                    </div>
                    <?php wp_nonce_field('vb_new_user', 'vb_new_user_nonce', true, true); ?>
                </form>
            </div>
        </div>
        <script type="text/javascript">
            jQuery("#bt-signup").click(function () {

                var reg_nonce = jQuery('#vb_new_user_nonce').val();
                var user_signup = jQuery('#user_signup').val();
                var user_password = jQuery('#user_password').val();
                var user_repassword = jQuery('#user_repassword').val();
                if (jQuery.trim(user_signup) == '') {
                    jQuery('.form-educatito-register').find('.error-user-signup').html("Please enter username or email address...");
                    jQuery('#user_signup').on('keyup', function () {
                        jQuery('.form-educatito-register').find('.error-user-signup').html(" ");
                    });
                } else if (jQuery.trim(user_password) == '') {
                    jQuery('.form-educatito-register').find('.error-user-password').html("Please enter password...");
                    jQuery('#user_password').on('keyup', function () {
                        jQuery('.form-educatito-register').find('.error-user-password').html(" ");
                    });
                } else if (jQuery.trim(user_repassword) == '') {
                    jQuery('.form-educatito-register').find('.error-user-repassword').html("Please enter confirm password...");
                    jQuery('#user_repassword').on('keyup', function () {
                        jQuery('.form-educatito-register').find('.error-user-repassword').html(" ");
                    });
                } else if (jQuery.trim(user_repassword) != jQuery.trim(user_password)) {
                    jQuery('.form-educatito-register').find('.error-user-repassword').html("Incorrect password...");
                    jQuery('#user_repassword').on('keyup', function () {
                        jQuery('.form-educatito-register').find('.error-user-repassword').html(" ");
                    });
                } else {
                    load_ajax();

                    function load_ajax() {
                        jQuery.ajax({
                            url: '<?php echo admin_url('admin-ajax.php'); ?>',
                            type: "post",
                            data: {
                                action: 'register_user',
                                nonce: reg_nonce,
                                mail: user_signup,
                                pass: user_password
                            },
                            success: function (data) {
                                console.log(data);
                                if (data == 1) {
                                    swal('Please confirm your email to start', 'Check your email and open confirmation link', 'success');
                                } else {
                                    swal('Register Failed!', 'Incorrect Username or email already exists!', 'error').then(okay => {
                                        if (okay) {
                                            window.location.href = "<?php echo esc_url(home_url('/')) ?>user-register";
                                        }
                                    });
                                }
                            },
                        });
                    }
                }
            });
        </script>
        <?php
        $html_output = ob_get_contents();
        ob_end_clean();
        return $html_output;
    }

endif;

if (!function_exists('educatito_educatito_register_admin')) {
    add_action('vc_before_init', 'educatito_educatito_register_admin');

    function educatito_educatito_register_admin() {
        vc_map(array(
            'name' => esc_html__('Educatito Register', 'educatito'),
            'base' => 'educatito_educatito_register',
            'icon' => get_template_directory_uri() . "/assets/images/icon/educatito-icon.png",
            'category' => esc_html__('JRB Themes', 'educatito'),
            'description' => esc_html__('Educatito Register for theme.', 'educatito'),
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
    