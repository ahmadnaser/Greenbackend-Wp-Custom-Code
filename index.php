<?php
/**
* Plugin Name: Greenbackend Code
* Plugin URI: https://greenbackend.com
* Description: Custom Code from greenbackend and myweb.ps to enable Arabic Fonts and Support Links
* Version: 1.0
* Author: Greenbackend
* Author URI: https://greenbackend.com
**/

class PageTemplater {

	/**
	 * A reference to an instance of this class.
	 */
	private static $instance;

	/**
	 * The array of templates that this plugin tracks.
	 */
	protected $templates;

	/**
	 * Returns an instance of this class.
	 */
	public static function get_instance() {

		if ( null == self::$instance ) {
			self::$instance = new PageTemplater();
		}

		return self::$instance;

	}

	/**
	 * Initializes the plugin by setting filters and administration functions.
	 */
	private function __construct() {

		$this->templates = array();


		// Add a filter to the attributes metabox to inject template into the cache.
		if ( version_compare( floatval( get_bloginfo( 'version' ) ), '4.7', '<' ) ) {

			// 4.6 and older
			add_filter(
				'page_attributes_dropdown_pages_args',
				array( $this, 'register_project_templates' )
			);

		} else {

			// Add a filter to the wp 4.7 version attributes metabox
			add_filter(
				'theme_page_templates', array( $this, 'add_new_template' )
			);

		}

		// Add a filter to the save post to inject out template into the page cache
		add_filter(
			'wp_insert_post_data',
			array( $this, 'register_project_templates' )
		);


		// Add a filter to the template include to determine if the page has our
		// template assigned and return it's path
		add_filter(
			'template_include',
			array( $this, 'view_project_template')
		);


		// Add your templates to this array.
		$this->templates = array(
			'anbilarabi-template.php' => 'Mobile App Template',
		);

	}

	/**
	 * Adds our template to the page dropdown for v4.7+
	 *
	 */
	public function add_new_template( $posts_templates ) {
		$posts_templates = array_merge( $posts_templates, $this->templates );
		return $posts_templates;
	}

	/**
	 * Adds our template to the pages cache in order to trick WordPress
	 * into thinking the template file exists where it doens't really exist.
	 */
	public function register_project_templates( $atts ) {

		// Create the key used for the themes cache
		$cache_key = 'page_templates-' . md5( get_theme_root() . '/' . get_stylesheet() );

		// Retrieve the cache list.
		// If it doesn't exist, or it's empty prepare an array
		$templates = wp_get_theme()->get_page_templates();
		if ( empty( $templates ) ) {
			$templates = array();
		}

		// New cache, therefore remove the old one
		wp_cache_delete( $cache_key , 'themes');

		// Now add our template to the list of templates by merging our templates
		// with the existing templates array from the cache.
		$templates = array_merge( $templates, $this->templates );

		// Add the modified cache to allow WordPress to pick it up for listing
		// available templates
		wp_cache_add( $cache_key, $templates, 'themes', 1800 );

		return $atts;

	}

	/**
	 * Checks if the template is assigned to the page
	 */
	public function view_project_template( $template ) {
		// Return the search template if we're searching (instead of the template for the first result)
		if ( is_search() ) {
			return $template;
		}

		// Get global post
		global $post;

		// Return template if post is empty
		if ( ! $post ) {
			return $template;
		}

		// Return default template if we don't have a custom one defined
		if ( ! isset( $this->templates[get_post_meta(
			$post->ID, '_wp_page_template', true
		)] ) ) {
			return $template;
		}

		// Allows filtering of file path
		$filepath = apply_filters( 'page_templater_plugin_dir_path', plugin_dir_path( __FILE__ ) );

		$file =  $filepath . get_post_meta(
			$post->ID, '_wp_page_template', true
		);

		// Just to be safe, we check if the file exist first
		if ( file_exists( $file ) ) {
			return $file;
		} else {
			echo $file;
		}

		// Return template
		return $template;

	}

}
add_action( 'plugins_loaded', array( 'PageTemplater', 'get_instance' ) );





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

