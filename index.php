<?php
/**
* Plugin Name: Greenbackend Code
* Plugin URI: https://greenbackend.com
* Description: Custom Code from greenbackend and myweb.ps to enable Arabic Fonts and Support Links
* Version: 1.0
* Author: Greenbackend
* Author URI: https://greenbackend.com
**/

function enqueue_related_pages_scripts_and_styles(){
       
//wp_enqueue_script('releated-script', plugins_url( '/js/custom.js' , __FILE__ ), array('jquery','jquery-ui-droppable','jquery-ui-draggable', 'jquery-ui-sortable'));
		

wp_enqueue_style("arabic-fonts",plugins_url('/arabic-fonts/arabicfonts.css', __FILE__));
  
wp_enqueue_style("whatsapp-chat-support",plugins_url('/arabic-fonts/plugin/whatsapp-chat-support.css', __FILE__));
wp_enqueue_style("font-awesome",plugins_url('/arabic-fonts/plugin/components/Font Awesome/css/font-awesome.min.css', __FILE__));
wp_enqueue_script("moment",plugins_url('/arabic-fonts/plugin/components/moment/moment.min.js', __FILE__));
wp_enqueue_script("moment-timezone",plugins_url('/arabic-fonts/plugin/components/moment/moment-timezone-with-data.min.js', __FILE__), array('moment'));
wp_enqueue_script("whatsapp-chat-support-script",plugins_url('/arabic-fonts/plugin/whatsapp-chat-support.js?ref13', __FILE__));	
		
//wp_enqueue_script("moment",plugins_url('/plugin/components/moment/moment.min.js', __FILE__));
	
		
    }
add_action('wp_enqueue_scripts','enqueue_related_pages_scripts_and_styles');

function greenbackend_custom_footer() {
 
    // Can't continue if the current view is not RTL.
 
	?>
 	<div class="whatsapp_chat_support wcs_fixed_left" id="example_1">
		<div class="wcs_button wcs_button_circle">
			<span class="fa fa-whatsapp"></span>
		</div>	
		<div class="wcs_button_label">
 			Questions? Let's Chat
 		</div>	

		<div class="wcs_popup">
			<div class="wcs_popup_close">
				<span class="fa fa-close"></span>
			</div>
			<div class="wcs_popup_header">
				<span class="fa fa-whatsapp"></span>
				<strong>Customer Support</strong>
				
				<div class="wcs_popup_header_description">Need Help? Chat with us on Whatsapp</div>
			</div>	
			<div class="wcs_popup_input" data-number="1">
				<input type="text" placeholder="Ask anything!" />
				<i class="fa fa-play"></i>
			</div>
			<div class="wcs_popup_avatar">
				<img src="<?php echo plugins_url('/arabic-fonts/plugin/img/user.jpg', __FILE__); ?>" alt="">
			</div>
		</div>
	</div>
	<script type="text/javascript">
	
jQuery(document).ready(function( $ ) {
	var wcount = 0;
			$('#example_1').whatsappChatSupport({
			defaultMsg: 'Ask me on Whatsapp!',
		});




});



    </script>
	<style>
 .xoo-wsc-close {
    transform: translateY(-50%);
    top: 50%;
    right: auto;
    left: 20px;
    background: #d0cece;
    padding: 10px;
    border-radius: 20px;
}
      .xoo-wsc-footer, .xoo-wsc-footer a.button {
    width: 93% !important;
}
      .xoo-wsc-product {
    padding: 15px;
   width: 93% !important;
      }
      .scroll-top.on {
    bottom: 120px;
    right: 14px;
    opacity: 1;
    z-index: 109;
}
      span.menu-text {
    font-family: smart4dsTitles, sans-serif !important;
}
.switcher-wrap .woocommerce-ordering select {
    margin-right: 5px;
    padding-right: 21px;
    margin-bottom: 0;
    direction: ltr !important;
}
      .single-product aside#sidebar {
    display: none;
}


.single-product .sidebar-right .wf-container-main {
    -ms-grid-columns: calc(100% - 25px) 50px;
    grid-template-columns: calc(100% - 25px);
}
.single-product .product-content {
    margin-right: 10px;
}
      .woocommerce-billing-fields {
    padding-bottom: 10px;
    margin-left: 15px;
}
      .woocommerce-info {
    padding: 10px;
    background: #f7f7f7;
    border: 2px dashed pink;
}
      a.same-logo {
    width: 100px;
}
      .flex-viewport {
    direction: ltr !important;
}
      #bottom-bar > div > div > div.wf-float-left {
    display: none;
}
	</style><?php
}
add_action('wp_footer', 'greenbackend_custom_footer');

