<?php 

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Proeuropa {

	private $_bottom_bar_background =  "#000";
	private $_bottom_bar_text_color = "#fff";
	private $_bottom_bar_text = "Keep Britain in the EU";
	private $_icon_type = "preset";
	private $_proeuropa_align = "right";
	private $_bottom_bar_enabled = "on";
	private $_proeuropa_bottom_bar_icon = "";
	private $_icon = 1;
	private $_proeuropa_link_to = "";
	private $_campaigns;
	private $_support_campaign;

	public function initialize(){

		$this->configure();

		$admin_page = new Proeuropa_Admin_Settings();
		$admin_page->initialize($this->getOptions());

		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_public_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

	}

	public function configure(){

		$this->_campaigns = array(
			"custom" => array(
				"icon_presets" => array(
					1 => plugins_url( 'assets/img/GB_in_EU_icon_150x150_v1.png', __FILE__ ),
					2 => plugins_url( 'assets/img/GB_in_EU_icon_150x150_v2.png', __FILE__ ),
					3 => plugins_url( 'assets/img/GB_in_EU_icon_150x150_v3.png', __FILE__ ),
					4 => plugins_url( 'assets/img/GB_in_EU_icon_150x150_v4.png', __FILE__ ),
				),
				"admin_icon_width" => 150,
				"icon" => plugins_url( 'assets/img/custom_campaign.png', __FILE__ ),
				"proeuropa_link_to" => get_option('proeuropa_link_to') != '' ? $this->addHTTP(get_option('proeuropa_link_to')) : $this->_proeuropa_link_to,
				"bottom_bar_background" => get_option('bottom_bar_background') != '' ? get_option('bottom_bar_background') : $this->_bottom_bar_background,
				"edit_link" => true,
			), 
			"liberal_democrats" => array(
				"icon_presets"=> array(
					1 => plugins_url( 'assets/img/White_Long.png', __FILE__ ),
					2 => plugins_url( 'assets/img/Black_Long.png', __FILE__ ),
				),
				"admin_icon_width" => 324,
				"icon" => plugins_url( 'assets/img/liberal_democrats_campaign.png', __FILE__ ),
				"proeuropa_link_to" => get_option('proeuropa_link_to') != '' ? $this->addHTTP(get_option('proeuropa_link_to')) : "http://ineurope.veedoogroup.com/goto/?url=83y7fg93y",
				"bottom_bar_background" => get_option('bottom_bar_background') != '' ? get_option('bottom_bar_background') : $this->_bottom_bar_background,
				"edit_link" => false,
			),
			"proeuropa" => array(
				"icon_presets"=> array(
					1 => plugins_url( 'assets/img/PELogoNoStrapWhiteGrey_transparent.png', __FILE__ ),
					2 => plugins_url( 'assets/img/PELogoNoStrapWhite_transparent.png', __FILE__ ),
					3 => plugins_url( 'assets/img/PELogoNoStrap_transparent.png', __FILE__ ),
				),
				"admin_icon_width" => 200,
				"icon" => plugins_url( 'assets/img/proeuropa_campaign.png', __FILE__ ),
				"proeuropa_link_to" => get_option('proeuropa_link_to') != '' ? $this->addHTTP(get_option('proeuropa_link_to')) : "http://ineurope.veedoogroup.com/goto/?url=398bv9ub3",
				"bottom_bar_background" => get_option('bottom_bar_background') != '' ? get_option('bottom_bar_background') : "#00245a",
				"edit_link" => false,
			),
		);

	}

	public function getOptions(){
		$options = (object) array(
				"bottom_bar_text_color" => get_option('bottom_bar_text_color') != '' ? get_option('bottom_bar_text_color') : $this->_bottom_bar_text_color,
				"bottom_bar_text" => get_option('bottom_bar_text') != '' ? get_option('bottom_bar_text') : $this->_bottom_bar_text,
				"proeuropa_align" => get_option('proeuropa_align') != '' ? get_option('proeuropa_align') : $this->_proeuropa_align,
				"bottom_bar_enabled" => get_option('bottom_bar_enabled') != '' ? get_option('bottom_bar_enabled') : $this->_bottom_bar_enabled,
				"proeuropa_bottom_bar_icon" => get_option('proeuropa_bottom_bar_icon') != '' ? get_option('proeuropa_bottom_bar_icon') : $this->_proeuropa_bottom_bar_icon,
				"icon" => get_option('icon') != '' ? get_option('icon') : $this->_icon,
				"icon_type" => get_option('icon_type') != '' ? get_option('icon_type') : $this->_icon_type,
				"campaigns" => $this->_campaigns,
				"support_campaign" => get_option('support_campaign') != '' ? get_option('support_campaign') : $this->_support_campaign,
			);

		return $options;
	}

	private function addHTTP($url) {
	    if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
	        $url = "http://" . $url;
	    }
	    return $url;
	}

	public function enqueue_styles(){

		$screen = get_current_screen();
		if ( 'toplevel_page_in-europe' != $screen->id ){
			return;
		}

		wp_enqueue_style(
			'plug_in_europe_admin',
			plugins_url( 'assets/css/admin.css', __FILE__ ),
			array(),
			'0.2.0'
		);

	}

	public function enqueue_public_styles(){

		wp_enqueue_style(
			'plug_in_europe',
			plugins_url( 'assets/css/public.css', __FILE__ ),
			array(),
			'0.2.0'
		);

	}

	public function enqueue_scripts(){

		$screen = get_current_screen();
		if ( 'toplevel_page_in-europe' != $screen->id ){
			return;
		}


		wp_enqueue_script('jquery');
 
        wp_enqueue_script('thickbox');
        wp_enqueue_style('thickbox');
 
        wp_enqueue_script('media-upload');

        // Add the color picker css file       
        wp_enqueue_style( 'wp-color-picker' );

		wp_enqueue_script(
			'plug_in_europe_admin',
			plugins_url( 'assets/js/admin.js', __FILE__ ),
			array( 'jquery', 'wp-color-picker' ),
			'0.2.0'
		);

	}

}