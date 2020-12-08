<?php
class Style{

	public static function addStyle($data)
	{
		$right = $data['right'];
		$bottom = $data['bottom'];

		$custom_css_zalo = "
        .zalo-chat-widget{
                right: {$right}px!important;
                bottom: {$bottom}px!important;
        }
        .btn.btn-primary{background-color:red}";
		wp_add_inline_style( 'zcb_fe_style', $custom_css_zalo );

		$bg_color = $data['bg-color'];
		$custom_css_tel = "
		.social-button svg, .social-button i {
			 background: {$bg_color};
		}
		";
		wp_add_inline_style( 'zcb_fe_style', $custom_css_tel );

		$custom_css_fb = "
		.ctrlq.fb-overlay {
			 width: 48px !important;
		    height: 48px !important;
		    z-index: 9999999999 !important;
		    bottom: 46px !important;
		    right: 5px !important;
		}
		.ctrlq.fb-button{ 
			 width: 48px !important;
		    height: 48px !important;
		    z-index: 9999999999 !important;
		    bottom: 46px !important;
		    right: 5px !important;	
		}

		.bubble-msg{
			font-size: 10px!important;
		}
		";
		wp_add_inline_style( 'zcb_fe_style', $custom_css_fb );
		
		//WP_Styles::add_inline_style( 'zcb_admin_style', $custom_css );
		//Ref: https://stackoverflow.com/questions/40805925/how-set-style-from-an-option-in-wordpress-settings-api}
		//more ref: https://stackoverflow.com/questions/43689560/right-way-for-pass-variable-php-to-css-in-wordpress
	}
}


