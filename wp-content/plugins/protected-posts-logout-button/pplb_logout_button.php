<?php 
/*
	Plugin Name: Protected Posts Logout Button
	Plugin URI: http://omfgitsnater.com/protected-posts-logout-button/
	Description: A plugin built to add a logout button automatically to protected posts.
	Version: 1.3
	Author: Nate Reist
	Author URI: http://omfgitsnater.com
*/

/*
	Add the logout button to posts which require a password and the password has been provided.
*/

function pplb_logout_filter( $content ){
	global $post;
	$html = '';
	
	//Check if the post has a password and we are inside the loop.
	if(!empty($post->post_password) && in_the_loop()){
		//Check to see if the password has been provided.
		if(!post_password_required(get_the_ID())){
			//add the logout button to the output.
			$options = get_option('pplb_options');
			$class = (array_key_exists('pplb_button_class', $options)) ? $options['pplb_button_class'] : '';
			$html .= ' <input type="button" class="button logout '.esc_attr($class).'" value="logout">';
		}
	}
	return $html.$content;
	
}

/* 
	Adds for use in wordpress shortcode or php.
*/

function pplb_logout_button(){
	$qid = get_queried_object_id();
	$qpost = get_post($qid);
	$html = '';
	// Check if the post has a password
	if(!empty($qpost->post_password)){
		// Check to see if the password has been provided.
		if(!post_password_required($qid)){
			$options = get_option('pplb_options');
			$class = (array_key_exists('pplb_button_class', $options)) ? $options['pplb_button_class'] : '';
			$html = ' <input type="button" class="button logout '.esc_attr($class).'" value="logout">';
		}
	}
	return $html;
	
}

/*
	Ajax function to reset the cookie in wordpress.
*/

function pplb_protected_logout(){
	// Set the cookie to expire ten days ago... instantly logged out.
	setcookie('wp-postpass_' . COOKIEHASH, stripslashes( '' ), time() - 864000, COOKIEPATH);
	$options = get_option('pplb_options');
	$pplb_alert = (array_key_exists('pplb_alert', $options)) ? $options['pplb_alert'] : 'no';
	if($pplb_alert == 'yes'){
		echo stripslashes($options['pplb_message']);
	}
	else{
		echo 0;
	}
	die();
}

/*
	Enqueue the scripts.
*/
function pplb_logout_js(){
	wp_register_script('pplb_logout_js', plugins_url('/logout.js', __FILE__), array('jquery'));
	wp_enqueue_script('pplb_logout_js');
	wp_localize_script( 'pplb_logout_js', 'MyAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
}

/*
	The settings page in admin
*/
function pplb_settings_page(){
	if(isset($_POST['pplb_action'])){
		//update the option.
		$options = array();
		$options['pplb_alert'] = (array_key_exists('pplb_alert', $_POST)) ? $_POST['pplb_alert']: 'no';
		$options['pplb_message'] = esc_js($_POST['pplb_message']);
		$options['pplb_button_class'] = esc_attr($_POST['pplb_button_class']);
		update_option('pplb_options', $options);
		
		$filter = isset($_POST['pplb_button_filter']) ? $_POST['pplb_button_filter']: 'yes';
		update_option('pplb_button_filter', $filter);
	}
	$new_options = get_option('pplb_options');
	if(is_array($new_options)){
		extract($new_options);	
	}
	?>
		<div class="wrap">
			<h2>Protected Posts Logout Settings</h2>
			<p>Thanks for using this plugin.  If you encounter any errors please report them to <a href="mailto:nate@omfgitsnater.com">nate@omfgitsnater.com</a></p>
			<form action="" method="post">
					<input type="hidden" name="pplb_action" value="update" />
			<table class='form-table'>
				<tbody>
					<tr>
						<th><label>Alert user log out was successful?</label></th><td><input type="checkbox" name="pplb_alert" value="yes" <?php checked($pplb_alert, 'yes'); ?> /></td>
					</tr>
					<tr>
						<th><label>Logout Message:</label></th><td> <input type="text" name="pplb_message" value="<?php echo stripslashes($pplb_message); ?>" /></td>
					</tr>
					<tr>
						<th><label>Button CSS class:</label></th><td> <input type="text" name="pplb_button_class" value="<?php echo stripslashes($pplb_button_class); ?>" /></td>
					</tr>
					
					<tr>
						<th><label>Automatically add button to protected pages:</label></th><td>
						<select name="pplb_button_filter">
							<option value='yes' <?php selected(get_option('pplb_button_filter'), 'yes'); ?>>Yes</option>
							<option value='no' <?php selected(get_option('pplb_button_filter'), 'no'); ?>>No</option>
						</select>
						</td>
					</tr>
				</tbody>
			</table>
			<br />
			<p><input type="submit" value="Update" class="button-primary" /></p>
			</form>
			<h2>Usage</h2>
			<p>This plugin is meant to add a logout button to a <b>single</b> protected post or page automatically.</p>
			<p>It does so by attaching a button to the beginning of the content using a <b>filter</b> hooked to <code>the_content</code> when it is outputting that post's content. This means it inherently will not work for archives, where Wordpress is actually running <code>the_content</code> for other posts.</p>
			<p>Also, if other plugins, or theme code, are manipulating the protected posts content using a <b>filter</b> as well, they may remove the button inadvertently.</p>
			<p>To solve this, you can now place the button via a shortcode or <code>php</code> function:</p>
			<p>Shortcode:</p>
			<style type='text/css'>
				.pplb-pre{ display:block; white-space: normal; padding:20px; width:300px; background:#eee; border:1px solid #ccc; font-family: arial; }
			</style>
			<pre class='pplb-pre'>[logout_btn]</pre>
			<p>PHP:</p>
			<pre class='pplb-pre'>&lt;?php echo pplb_logout_button(); ?&gt;</pre>
		</div><!-- .wrap pplb -->
		
	<?php 
}

/*
	Add the admin page
*/
function pplb_add_admin(){
	add_options_page('Protected Post Logout Settings', 'Protected Post Logout', 'manage_options', 'pplb-settings-page', 'pplb_settings_page');
}

/*
	Activation hook to install the options if they haven't been installed before.
*/
function install_pplb_options(){
	if(!get_option('pplb_options')){
		$options = array(
			'pplb_alert' => 'no',
			'pplb_message' => 'Successfully logged out.',
			'pplb_button_class' => ''
		);
		update_option('pplb_options', $options);
	}
	if(!get_option('pplb_button_filter')){
		update_option('pplb_button_filter', 'yes');
	}
}

/* 
	Only add the filter if the option declares it
*/
function add_pplb_filter(){
	if(!get_option('pplb_button_filter')){
		// if the option isn't set, assume we want it there.
		update_option('pplb_button_filter', 'yes');
	}
	$add_filter = get_option('pplb_button_filter');
	if($add_filter == 'yes'){
		add_filter('the_content', 'pplb_logout_filter', 9999, 1); 	// adds the button.
	}
}

register_activation_hook( __FILE__ , 'install_pplb_options' );		// set up options

add_action('init', 'add_pplb_filter', 10, 1);						// add the filter on load.

add_action('admin_menu', 'pplb_add_admin');
add_action('wp_enqueue_scripts','pplb_logout_js'); 					// adds the script to the header.
add_action('wp_ajax_nopriv_pplb_logout', 'pplb_protected_logout'); 	// logout for non-logged in wp users
add_action('wp_ajax_pplb_logout', 'pplb_protected_logout'); 		// logout for logged in wp users

add_shortcode('logout_btn','pplb_logout_button');					// adds the shortcode.

?>