<?php 

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Proeuropa_Admin_Settings{

	private $_options = "";

	public function initialize($options){

		add_action('admin_menu', array( $this, 'proeuropa_admin_menu' ) );
		add_action( 'admin_init', array( $this, 'register_my_plugin_settings' ) );

		$this->setOptions($options);

	}

	//Getters and Setters
	public function setOptions($options){ $this->_options = $options; }
	public function getOptions(){ return $this->_options; }

	public function proeuropa_admin_menu(){

		add_menu_page(
			'Plug-IN Europe', 
			'IN Europe', 
			'manage_options', 
			'in-europe', 
			array( $this, 'show_admin_page' )
		);

	}

	public function register_my_plugin_settings() {
		register_setting( 'proeuropa-option-group', 'bottom_bar_enabled' );
		register_setting( 'proeuropa-option-group', 'proeuropa_bottom_bar_icon' );
		register_setting( 'proeuropa-option-group', 'icon_type' );
		register_setting( 'proeuropa-option-group', 'icon' );
		register_setting( 'proeuropa-option-group', 'bottom_bar_background' );
		register_setting( 'proeuropa-option-group', 'bottom_bar_text_color' );
		register_setting( 'proeuropa-option-group', 'bottom_bar_text' );
		register_setting( 'proeuropa-option-group', 'proeuropa_align' );
		register_setting( 'proeuropa-option-group', 'proeuropa_link_to' );
		register_setting( 'proeuropa-option-group', 'support_campaign' );
	}

	public function show_admin_page(){

		$options = $this->getOptions();
		include( plugin_dir_path( __FILE__ ) . 'admin_page.php' );

	}

}