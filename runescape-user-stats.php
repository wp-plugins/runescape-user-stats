<?php
/*
Plugin Name: Runescape User Stats
Plugin URI: http://runescape-quest.info/wordpress
Description: Display runescape game stats on any page of your blog
Author: Rakesh Muraharishetty
Version: 1.0
Author URI: http://www.rakesh.ms/
*/
/*  Copyright 2009 Rakesh Muraharishetty

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

*/
//======================================
// @Description: Add runescape user field in form
function rs_custom(){
	$meta = rs_get_runescape_stats();
	?>
	<h3><?php _e('Runescape User Stats'); ?></h3>
	
	<table class="form-table" id="clonehere"><?php
	if ($meta) {
	 	foreach($meta as $key => $value) {?>
		<tr id="tr_<?php echo $key; ?>">
			<th><label for="<?php echo $key ?>"><?php echo str_replace('rs_','',$key) ?></label></th>
			<td>
				<input type="text" value="<?php echo $value ?>" id="<?php echo $key ?>" name="<?php echo $key ?>" /> 
				<a class="remove_meta" href="#" onClick="jQuery('#tr_<?php echo $key; ?>').remove(); return false;" rel="<?php echo $key ?>"title="<?php _e('Delete'); ?>"></a>
			</td>
		</tr>
		<?php
		}
	}
	?>
	</table>
	<p class="form-table">
		<input type="text" name="rs_meta" id="rs_meta" /> <input type="text" name="rs_value" id="rs_value" /> <span id="rs_addmeta" class="button"><?php _e('Add Meta'); ?></span>
	</p>
	<?php
}

//======================================
// Description: The form to add runescape user stats
function rs_static() {
global $wpdb;
	// Loads the Usermetadata into $meta array - !DO NOT CHANGE THE NEXT LINES!
	$meta = rs_get_runescape_stats();
	$static_fields = array('rs_input');
	// ---------- You can edit the next lines ?>
	<h3><?php _e('Runescape User Stats'); ?></h3>
	
	<table class="form-table">
		<tr>
			<th><label for="rs_input">Label</label></th>
			<td><input type="text" name="rs_input" id="rs_input" value="<?php echo $meta->rs_input; ?>" /></td>
		</tr>
		<?php
		if ($meta) {
		 	foreach($meta as $key => $value) {
				if (!in_array($key, $static_fields)) {
				?>
				<tr id="tr_<?php echo $key; ?>">
					<th><label for="<?php echo $key ?>"><?php echo str_replace('rs_','',$key) ?></label></th>
					<td>
						<input type="text" value="<?php echo $value ?>" id="<?php echo $key ?>" name="<?php echo $key ?>" /> 
						<a class="remove_meta" href="#" onClick="jQuery('#tr_<?php echo $key; ?>').remove(); return false;" rel="<?php echo $key ?>"title="<?php _e('Delete'); ?>"></a>
					</td>
				</tr>
				<?php
				}
			}
		}
		?>
	</table>	
	<? // ---------- No more editing
}

//======================================
// @Description: 
// @Require: 
// @Optional: 
// @Return: 
function rs_dynamic(){
	// Loads the Usermetadata into $meta array - !DO NOT CHANGE THE NEXT LINES!
	$meta = rs_get_runescape_stats();
	?>
	<h3><?php _e('Runescape User Stats'); ?></h3>
	
	<table class="form-table" id="clonehere">
		<tr>
			<th><label for="input">Label</label></th>
			<td><input type="text" name="input" id="input" value="<?php echo $meta->input; ?>" /></td>
		</tr>
	</table>
	<p class="form-table">
		<input type="text" name="rs_meta" id="rs_meta" /> <input type="text" name="rs_value" id="rs_value" /> <span id="rs_addmeta" class="button"><?php _e('Add Meta'); ?></span>
	</p>
	
	<?php
}


function rs_get_runescape_stats($id = ""){
global $wpdb, $user_ID;
	if (preg_match('&profile.php&', $_SERVER['REQUEST_URI'])) {
		$id = $user_ID;
	}
	elseif($_GET['user_id']) {
		$id = $_GET['user_id'];
	}
	
	$meta = get_usermeta($id,'rs_profile',TRUE);
	return $meta;
}

//======================================
// @Description: Options for Runescape User Stats
function rs_options(){
	$options = array(
		'rs_profile' => 'custom', // custom, static, build
		'rs_profile_max' => '0', //
	);
	return $options;
}

function rs_save(){
global $wpdb, $user_ID;
	if (preg_match('&profile.php&', $_SERVER['REQUEST_URI'])) {
		$id = $user_ID;
	}
	elseif($_GET['user_id']) {
		$id = $_GET['user_id'];
	}
	foreach($_POST as $key => $value) {
		if (preg_match('&rs_&', $key) && $key != 'rs_value' && $key != 'rs_meta' && $value) {
			$profile[$key] = $value;
		}
	}
	update_usermeta($id, 'rs_profile', $profile);
}

//======================================
// Description: Hack to save the metadata in $wpdb->usermeta ( Called in wp-login.php )
function rs_registration_save() {
global $wpdb;

}

//======================================
// @Description: Runs on plugin activation
function rs_install(){
	$options = rs_options();
	foreach($options as $key => $value) {
		add_option($key,$value);
	}
}

//======================================
// @Description: Runs on plugin deactivation
function rs_deinstall(){
	$options = rs_options();
	foreach($options as $key => $value) {
		delete_option($key,$value);
	}
}

//======================================
// Description: Getting all relevant usermeta data
// Param: str user; - UserID
// Param: Experimental
function call_usermeta($id="", $run="") {
global $wpdb,$user_ID, $author_name;
	/** DEPRACTED **/
}

//======================================
// Description: Script should ignore these data
function rs_ignore(){
	
}

//======================================
// @Description: jQuery Script for Runescape User Stats
function rs_adminhead(){?>
	<style type="text/css">
	.remove_meta {
		background: url(./images/xit.gif) left center no-repeat;
		padding: 4px 10px 0 0;
	}
	.remove_meta:hover {
		background: url(./images/xit.gif) right center no-repeat;
		padding: 4px 10px 0 0;
	}
	</style>
	<script type="text/javascript">
		jQuery(document).ready(function(){		
			function add_meta(){
				if (jQuery('#rs_meta').val()){
					jQuery('#clonehere').append('<tr id="tr_' + jQuery('#rs_meta').val() + '"><th><label for="rs_' + jQuery('#rs_meta').val() + '">' + jQuery('#rs_meta').val() + '</label></th><td><input type="text" id="rs_' + jQuery('#rs_meta').val() + '" name="rs_' + jQuery('#rs_meta').val() + '" value="' + jQuery('#rs_value').val() +'" /> <a class="remove_meta" href="#" onClick="jQuery(\'#tr_'+jQuery('#rs_meta').val()+'\').remove(); return false;" title="<?php _e('Delete'); ?>"></a></td></tr>');
					jQuery('#rs_meta').attr('value','').focus();
					jQuery('#rs_value').attr('value','');
				}
			}	
			jQuery('#rs_addmeta').click(function(){
					add_meta();
			});
			jQuery('#rs_value').keypress(function(e){
				if (e.which == 13) {
					add_meta();
				}
			});
			// jQuery("#clonehere").sortable();
		});
	</script><?php
}

//======================================
// WP HOOKS

// Install / Deinstall Hooks
register_activation_hook(__FILE__, 'rs_install');
register_deactivation_hook(__FILE__, 'rs_deinstall');

// Which Profile should be included
$rs_profile = get_option('rs_profile');
if ($rs_profile == 'custom') {
	add_action('show_user_profile', 'rs_custom');
	add_action('edit_user_profile', 'rs_custom');
}
elseif ($rs_profile == 'static') {
	add_action('show_user_profile', 'rs_static');
	add_action('edit_user_profile', 'rs_static');
}
elseif ($rs_profile == 'dynamic') {
	add_action('show_user_profile', 'rs_dynamic');
	add_action('edit_user_profile', 'rs_dynamic');
}

add_action('profile_update', 'rs_save');
add_action('admin_head', 'rs_adminhead')

?>