<?PHP
/*
Plugin Name: Wowza for Wordpress
Plugin URI: http://cndls.georgetown.edu
Description: Minor Adaptation of the Flowplayer Wordpress Extension from David Busby.
Version: 2.0.9.92
Author: Bill Garr
Author URI: http://cndls.georgetown.edu
License: GPL2
*/

//class include
require_once(realpath(dirname(__FILE__)).'/classes/wowza.class.php');
//setup defines
wowza::setup();

/**
 * WP Hooks
 */
 //plugin setting menu
 add_action('admin_menu', 'wowza_admin');
 //save menu callback
// add_action('save_post', 'ww_save');
 //javascript head
 add_action('wp_head', 'wowza_head', 20);
 //content callback
 add_filter('the_content','wowza_content');
 //activate plugin callback
 register_activation_hook(__FILE__,'wowza_activate');
 //deactivate plugin callback
 register_deactivation_hook(__FILE__,'wowza_deactivate');
 
 /**
  * END WP Hooks
  */


function wowza_content($content){
	$content = wowza::legacy_hook($content);
	return $content;
}

function wowza_admin(){
	if (function_exists('add_submenu_page')) {
		add_options_page(
							'Wordpress Wowza', 
							'Wordpress Wowza', 
							8, 
							basename(__FILE__), 
							'wowza_settings'
						);
	}
	/*
	//page meta box
	add_meta_box( 'wowza_box', __( 'Wordpress Wowza', 'Wordpress Wowza' ), 
                'wowza_box', 'page', 'advanced' );
    //post meta box
    add_meta_box( 'wowza_box', __( 'Wordpress Wowza', 'Wordpress Wowza' ), 
                'wowza_box', 'post', 'advanced' );*/
}

function ww_save($postID){
	if (!wp_verify_nonce( $_POST['ww_noncename'], plugin_basename(__FILE__) )) {
		return $postID;
	} else {
		$i=1;
		while(!empty($_POST['fpMedia_'.$i])){
			$i++; 
		}
	}
}

function wowza_box(){
?>
<script type="text/javascript">
 jQuery(document).ready(function(){
 	jQuery('#fpAdd').click(function(){
 		
 	});
 });
</script>
<p>You can configure Flowplayer using this box, any setting applied here will be for this post only</p>
<p><img src="<?PHP bloginfo('siteurl'); ?>/wp-admin/images/media-button-video.gif" id="fpAdd" style="cursor:pointer" /></p>
<input type="hidden" name="ww_noncename" id="ww_noncename" value="<?PHP echo wp_create_nonce( plugin_basename(__FILE__) ); ?>" />
<?PHP
}
/**
 * deactivate plugin callback function removes wordpress options
 * @todo add cleanup of post meta data?
 */
function wowza_deactivate(){
	delete_option('wowza_autoplay');
    delete_option('wowza_key');
    delete_option('wowza_autobuffer');
    delete_option('wowza_backgroundColor');	
	delete_option('wowza_canvas');
	delete_option('wowza_sliderColor');
	delete_option('wowza_buttonColor');
	delete_option('wowza_buttonOverColor');
	delete_option('wowza_durationColor');
	delete_option('wowza_timeColor');
	delete_option('wowza_progressColor');
	delete_option('wowza_bufferColor');
	delete_option('wowza_logo');
	delete_option('wowza_logolink');
  // directory in <wowza>/content where our assets will live.
	delete_option('wowza_directory');
}

/**
 * Plugin activate callback, sets up wordpress options
 */
function wowza_activate(){
	add_option('wowza_autoplay');
    add_option('wowza_key');
    add_option('wowza_autobuffer');
    add_option('wowza_backgroundColor');	
	add_option('wowza_canvas');
	add_option('wowza_sliderColor');
	add_option('wowza_buttonColor');
	add_option('wowza_buttonOverColor');
	add_option('wowza_durationColor');
	add_option('wowza_timeColor');
	add_option('wowza_progressColor');
	add_option('wowza_bufferColor');
	add_option('wowza_logo');
	add_option('wowza_logolink');
  // directory in <wowza>/content where our assets will live.
	add_option('wowza_directory');
}

/**
 * Render the plugin settings menu
 */
function wowza_settings(){
	echo wowza::admin_head();
	wowza::get_nonce();
	if (wp_verify_nonce( $_POST['wowza_noncename'], WOWZA_NONCE_FILE )) {
    	wowza::_setautoplay($_POST['wowza_autoplay']);
    	wowza::_setkey($_POST['wowza_key']);
    	wowza::_setautobuffer($_POST['wowza_autobuffer']);
    	wowza::_setbackgroundColor($_POST['wowza_backgroundColor']);	
		wowza::_setcanvas($_POST['wowza_canvas']);
		wowza::_setsliderColor($_POST['wowza_sliderColor']);
		wowza::_setbuttonColor($_POST['wowza_buttonColor']);
		wowza::_setbuttonOverColor($_POST['wowza_buttonOverColor']);
		wowza::_setdurationColor($_POST['wowza_durationColor']);
		wowza::_settimeColor($_POST['wowza_timeColor']);
		wowza::_setprogressColor($_POST['wowza_progressColor']);
		wowza::_setbufferColor($_POST['wowza_bufferColor']);
		wowza::_setlogo($_POST['wowza_logo']);
		wowza::_setlogolink($_POST['wowza_logolink']);
    // directory in <wowza>/content where our assets will live.
		wowza::_setdirectory($_POST['wowza_directory']);
		wowza::_uploadcontent($_POST['wowza_directory']);
  	}
 
  	echo 	wowza::wowza_settings();
  	
}  

function wowza_head(){
	echo wowza::player_head();
} 
 

?>