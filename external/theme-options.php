<?php

/**
* Marginal Theme Options
* @package 		WordPress
* @subpackage 	Marginal
* @since 		Marginal 1.1
*
*/

function marginal_theme_options_page() {  
	// Check that the user is allowed to update options  
	if (!current_user_can('manage_options')) {  
		wp_die('You do not have sufficient permissions to access this page.');  
	}

	$external_stylesheets = get_option("marginal_external_stylesheets");

	if (isset($_POST["update_settings"])) {

		if (isset($_POST["headline-font"])) {
			update_option("headline_font",esc_attr($_POST["headline-font"]));
		}

		if (isset($_POST["body-font"])) {
			update_option("body_font",esc_attr($_POST["body-font"]));
		}

		$external_stylesheets = array();
	  
		$max_id = esc_attr($_POST["element-max-id"]);  
		for ($i = 0; $i < $max_id; $i ++) {  
			$field_name = "external-css-url-" . $i;  
			if (isset($_POST[$field_name])) {  
				$external_stylesheets[] = esc_attr($_POST[$field_name]);  
			}  
		}
		update_option("marginal_external_stylesheets", $external_stylesheets);
		?>  
			<div id="message" class="updated">Settings saved</div>  
		<?php 
	} 
	?>
	<div class="wrap">  
		<h2>Marginal Theme Options</h2>  
	  
		<form method="POST" action="">
			 <ul>
			 	<li><label for="headline-font">Headline font-family:</label>   
					<input type="text" name="headline-font" value="<?php echo get_option("headline_font"); ?>" size="25" />  
				</li>
				<li><label for="body-font">Body font-family:</label>   
					<input type="text" name="body-font" value="<?php echo get_option("body_font"); ?>" size="25" />  
				</li>
			</ul>

			<h3>External resources</h3>  
	  
			<?php if ($external_stylesheets) { ?><p class="description"><?php echo count($external_stylesheets); ?> stylesheet(s) loaded</p><?php }?>
			<ul id="external-css-list">
			<?php if ($external_stylesheets) { ?>
			<?php $element_counter = 0; 
				foreach ($external_stylesheets as $element) : ?>  
					<li class="external-css-element" id="external-css-element-<?php echo $element_counter; ?>">  
						<label for="external-css-url-<?php echo $element_counter; ?>">External CSS file:</label>
						
						<input type="text" name="external-css-url-<?php echo $element_counter; ?>" value="<?php echo $element; ?>" size="80"/>
						
						<a href="#" onclick="removeElement(jQuery(this).closest('.external-css-element'));">Remove</a>  
					</li>   
			<?php 
					$element_counter++; 
				endforeach;
			}
			?>
			</ul>  

			<a href="#" id="add-external-css">Add stylesheet</a>

			<p><input type="submit" value="Save settings" class="button-primary"/></p>
			<input type="hidden" name="element-max-id" value="<?php echo count($external_stylesheets); ?>"/>  
			<input type="hidden" name="update_settings" value="Y" />
		</form>  
		  
		<li class="external-css-element" id="external-css-element-placeholder"   
			style="display:none;">  
			<label for="external-css-url">External CSS file:</label>
			<input type="text" name="external-css-url" value="http://" size="80" />
			<a href="#" onclick="removeElement(jQuery(this).closest('.external-css-element'));">Remove</a>  
		</li>  
	</div>  
	<script type="text/javascript">  
		jQuery(document).ready(function() {	 
			jQuery("#add-external-css").click(function() {
				var elementCounter = jQuery("input[name='element-max-id']").val();
				var elementRow = jQuery("#external-css-element-placeholder").clone();  
				var newId = "external-css-element-" + elementCounter;  
					 
				elementRow.attr("id", newId);  
				elementRow.show();  
					 
				var inputField = jQuery("input", elementRow);  
				inputField.attr("name", "external-css-url-" + elementCounter);   
					  
				var labelField = jQuery("label", elementRow);  
				labelField.attr("for", "external-css-url-" + elementCounter);   
	  
				elementCounter++;  
				jQuery("input[name=element-max-id]").val(elementCounter);  
					  
				jQuery("#external-css-list").append(elementRow);  
					 
				return false;  
			});		   
		});  
		function removeElement(element) {  
			jQuery(element).remove();  
		}
		var removeLink = jQuery("a", elementRow).click(function() {  
			removeElement(elementRow);	
			return false;  
		}); 
	</script>

<?php
} 

function marginal_customize_register($wp_customize) {
	// SETTINGS
	$wp_customize->add_setting( 'header_background_color' , array(
		'default'	 => '#073642',
		'type' => 'option',
		'transport'   => 'refresh',
	) );

	$wp_customize->add_setting( 'hyperlink_color' , array(
		'default'	 => '#DC322F',
		'type' => 'option',
		'transport'   => 'refresh',
	) );

	// CONTROLS
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_background_color', array(
		'label'	  => __( 'Header Background Color', 'marginal' ),
		'section'	=> 'colors',
		'settings'   => 'header_background_color',
	) ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'hyperlink_color', array(
		'label'	  => __( 'Link Color', 'marginal' ),
		'section'	=> 'colors',
		'settings'   => 'hyperlink_color',
	) ) );

}