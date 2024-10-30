<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<style>
	.preset_icon input:checked+label{
		background-color: <?php echo $options->campaigns[$options->support_campaign]['bottom_bar_background']; ?>;
	}
</style>

<form id="settings_form" method="post" action="options.php">
<?php settings_fields( 'proeuropa-option-group' ); ?>
<?php do_settings_sections( 'proeuropa-option-group' ); ?>

<?php if (!$options->support_campaign) : ?>

<h1>Choose your campaign</h1>

<div class="preset_icon">
<?php foreach ($options->campaigns as $key => $campaign) : ?>
	<input type="radio" name="support_campaign" id="icon<?php echo $key; ?>" value="<?php echo $key; ?>" <?php echo $options->support_campaign == $key ? "checked" : ""; ?> >
	<label for="icon<?php echo $key; ?>"><img src="<?php echo $campaign["icon"]; ?>" alt="ProEuropa Icon v<?php echo $key; ?>" width="150" height="150"></label>
<?php endforeach; ?>
</div>

<?php else : ?>

<h1>Configure your banner</h1>

<h2>Banner preview:</h2>

<input type="hidden" id="support_campaign" name="support_campaign" value="<?php echo $options->support_campaign; ?>">

<div class="bar_preview" style="background-color: <?php echo $options->campaigns[$options->support_campaign]['bottom_bar_background']; ?>;">
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
<div style="clear:both"></div>

<h2>Switch the campaign</h2>

<p>To go back and choose another campaign, press <a href="javascript:resetCampain()">here</a> (this action will reset your settings to default).</p>
<script>
	function resetCampain(){
		jQuery('#support_campaign').val('');
		jQuery('#settings_form #submit').click();
	}
</script>

<h2>Choose the position of the banner text/logo:</h2>

<div id="align_chooser">
	<input type="radio" name="proeuropa_align" value="left"  <?php echo $options->proeuropa_align == "left" ? "checked" : ""; ?> > Left
	<input type="radio" name="proeuropa_align" value="right" <?php echo $options->proeuropa_align == "right" ? "checked" : ""; ?> > Right
</div>


<h2>Select the image/icon you want to use:</h2>
<?php /*
<div id="icon_type_chooser">
	<input type="radio" name="icon_type" value="preset" id="preset_icon" <?php echo $icon_type == "preset" ? "checked" : ""; ?> > Use preset icon
	<input type="radio" name="icon_type" value="custom" id="custom_icon" <?php echo $icon_type == "custom" ? "checked" : ""; ?> > Use custom icon
</div>
*/ ?>
<div class="preset_icon">
	<?php foreach ($options->campaigns[$options->support_campaign]['icon_presets'] as $key => $preset) : ?>
		<input type="radio" name="icon" id="icon<?php echo $key; ?>" value="<?php echo $key; ?>" <?php echo $options->icon == $key ? "checked" : ""; ?> >
		<label for="icon<?php echo $key; ?>"><img src="<?php echo $preset; ?>" alt="ProEuropa Icon v<?php echo $key; ?>" width="<?php echo $options->campaigns[$options->support_campaign]['admin_icon_width'] ?>"></label>
	<?php endforeach; ?>
</div>
<?php /*
<div class="custom_icon">
	<table class="form-table">
		<tr valign="top">
			<th scope="row">Upload Your own Image</th>
			<td><input type="text" name="proeuropa_bottom_bar_icon" id="logo_url" value="<?php echo $proeuropa_bottom_bar_icon; ?>" />
			<a class="button" id="upload_logo_button">Upload Logo</a> </td>
		</tr>
	</table>
</div>

*/ ?>

<h2>Set the text and background colours:</h2>

<div class="custom_icon">
	<table class="form-table">
		<tr valign="top">
			<th scope="row">Background colour</th>
			<td><input type="text" name="bottom_bar_background" value="<?php echo $options->campaigns[$options->support_campaign]['bottom_bar_background']; ?>" class="color-picker" ></td>
		</tr>
		<tr valign="top">
			<th scope="row">Text colour</th>
			<td><input type="text" name="bottom_bar_text_color" value="<?php echo $options->bottom_bar_text_color; ?>" class="color-picker" ></td>
		</tr>
	</table>
</div>

<h2>Select the message that will be displayed:</h2>

<select name="bottom_bar_text" id="bottom_bar_text">
	<option value="Keep Britain in Europe" <?php echo $options->bottom_bar_text == "Keep Britain in Europe" ? "selected" : ""; ?>>Keep Britain IN Europe</option>
	<option value="We Support British Membership of the EU" <?php echo $options->bottom_bar_text == "We Support British Membership of the EU" ? "selected" : ""; ?>>We Support British Membership of the EU</option>
	<option value="Vote YES to Keep Britain IN" <?php echo $options->bottom_bar_text == "Vote YES to Keep Britain IN" ? "selected" : ""; ?>>Vote YES to Keep Britain IN</option>
	<option value="Business for the EU" <?php echo $options->bottom_bar_text == "Business for the EU" ? "selected" : ""; ?>>Business for the EU</option>
	<option value="We are a Pro-European Company" <?php echo $options->bottom_bar_text == "We are a Pro-European Company" ? "selected" : ""; ?>>We are a Pro-European Company</option>
	<option value="Stronger Together" <?php echo $options->bottom_bar_text == "Stronger Together" ? "selected" : ""; ?>>Stronger Together</option>
</select>

	<?php if ($options->campaigns[$options->support_campaign]['edit_link']) { ?>

	<h2>Enter a custom link for banner clicks:</h2>
	<input type="text" name="proeuropa_link_to" id="proeuropa_link_to" value="<?php echo $options->campaigns[$options->support_campaign]['proeuropa_link_to']; ?>">

	<?php }else{ ?>

	<h2>The banner link:</h2>
	<p>The banner will be linked to the <a target="_blank" href="<?php echo $options->campaigns[$options->support_campaign]['proeuropa_link_to']; ?>">campaign</a> website.</p>

	<?php } ?>

<?php endif; ?>

<?php submit_button(); ?>
</form>
</div>