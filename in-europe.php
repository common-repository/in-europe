<?php
/**
* Plugin Name: IN Europe
* Plugin URI: http://ineurope.veedoogroup.com/
* Description: IN Europe banner/support.
* Version: 0.2.2.1
* Author: VidPlane
* Author URI: http://vidplane.com/
**/
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! defined( 'WPINC' ) ) die;

require_once( plugin_dir_path( __FILE__ ) . 'class-proeuropa.php' );
require_once( plugin_dir_path( __FILE__ ) . 'class-proeuropa-admin-settings.php' );

$options = "";

function proeuropa_start(){

	$plugin = new Proeuropa();
	$plugin->initialize();

}
proeuropa_start();


function proeuropa_bottom_bar() { ?>
	<?php 

	$plugin = new Proeuropa();
	$plugin->configure();
	$options = $plugin->getOptions();

	?>
	<a href="<?php echo $options->campaigns[$options->support_campaign]['proeuropa_link_to']; ?>" target="_blank">
		<div class="proeuropa_bottom_bar" style="background-color: <?php echo $options->campaigns[$options->support_campaign]['bottom_bar_background']; ?>;">
			<div class="bottom_bar <?php echo $options->proeuropa_align ?>">
				<?php 
					if ($options->icon_type == "custom"){
						$icon_url = $options->proeuropa_bottom_bar_icon;
					}else{
						$icon_url = $options->campaigns[$options->support_campaign]['icon_presets'][$options->icon];
					}
				?>
				<div class="icon"><img src="<?php echo $icon_url; ?>" alt="proeuropa_icon"></div>
				<div class="text" style="color:<?php echo $options->bottom_bar_text_color ?>"><?php echo $options->bottom_bar_text; ?></div>
			</div>
		</div> 
	</a>  
<?php }
add_action( 'wp_footer', 'proeuropa_bottom_bar' );