<?PHP
/*
Plugin Name: Flowplayer for Wordpress
Plugin URI: http://saiweb.co.uk/wordpress-flowplayer
Description: Flowplayer Wordpress Extension
Version: 2.0.9.92
Author: David Busby
Author URI: http://saiweb.co.uk
*/

//class include
require_once(realpath(dirname(__FILE__)).'/classes/flowplayer.class.php');
//setup defines
flowplayer::setup();

/**
 * WP Hooks
 */
 //plugin setting menu
 add_action('admin_menu', 'flowplayer_admin');
 //save menu callback
// add_action('save_post', 'fp_save');
 //javascript head
 add_action('wp_head', 'flowplayer_head', 20);
 //content callback
 add_filter('the_content','flowplayer_content');
 //activate plugin callback
 register_activation_hook(__FILE__,'flowplayer_activate');
 //deactivate plugin callback
 register_deactivation_hook(__FILE__,'flowplayer_deactivate');
 
 /**
  * END WP Hooks
  */


function flowplayer_content($content){
	$content = flowplayer::legacy_hook($content);
	return $content;
}

function flowplayer_admin(){
	if (function_exists('add_submenu_page')) {
		add_options_page(
							'Wordpress Flowplayer', 
							'Wordpress Flowplayer', 
							8, 
							basename(__FILE__), 
							'flowplayer_settings'
						);
	}
	/*
	//page meta box
	add_meta_box( 'flowplayer_box', __( 'Wordpress Flowplayer', 'Wordpress Flowplayer' ), 
                'flowplayer_box', 'page', 'advanced' );
    //post meta box
    add_meta_box( 'flowplayer_box', __( 'Wordpress Flowplayer', 'Wordpress Flowplayer' ), 
                'flowplayer_box', 'post', 'advanced' );*/
}

function fp_save($postID){
	if (!wp_verify_nonce( $_POST['fp_noncename'], plugin_basename(__FILE__) )) {
		return $postID;
	} else {
		$i=1;
		while(!empty($_POST['fpMedia_'.$i])){
			$i++; 
		}
	}
}

function flowplayer_box(){
?>
<script type="text/javascript">
 jQuery(document).ready(function(){
 	jQuery('#fpAdd').click(function(){
 		
 	});
 });
</script>
<p>You can configure Flowplayer using this box, any setting applied here will be for this post only</p>
<p><img src="<?PHP bloginfo('siteurl'); ?>/wp-admin/images/media-button-video.gif" id="fpAdd" style="cursor:pointer" /></p>
<input type="hidden" name="fp_noncename" id="fp_noncename" value="<?PHP echo wp_create_nonce( plugin_basename(__FILE__) ); ?>" />
<?PHP
}
/**
 * deactivate plugin callback function removes wordpress options
 * @todo add cleanup of post meta data?
 */
function flowplayer_deactivate(){
	delete_option('flowplayer_autoplay');
    delete_option('flowplayer_key');
    delete_option('flowplayer_autobuffer');
    delete_option('flowplayer_backgroundColor');	
	delete_option('flowplayer_canvas');
	delete_option('flowplayer_sliderColor');
	delete_option('flowplayer_buttonColor');
	delete_option('flowplayer_buttonOverColor');
	delete_option('flowplayer_durationColor');
	delete_option('flowplayer_timeColor');
	delete_option('flowplayer_progressColor');
	delete_option('flowplayer_bufferColor');
	delete_option('flowplayer_logo');
	delete_option('flowplayer_logolink');
}

/**
 * Plugin activate callback, sets up wordpress options
 */
function flowplayer_activate(){
	add_option('flowplayer_autoplay');
    add_option('flowplayer_key');
    add_option('flowplayer_autobuffer');
    add_option('flowplayer_backgroundColor');	
	add_option('flowplayer_canvas');
	add_option('flowplayer_sliderColor');
	add_option('flowplayer_buttonColor');
	add_option('flowplayer_buttonOverColor');
	add_option('flowplayer_durationColor');
	add_option('flowplayer_timeColor');
	add_option('flowplayer_progressColor');
	add_option('flowplayer_bufferColor');
	add_option('flowplayer_logo');
	add_option('flowplayer_logolink');
}

/**
 * Render the plugin settings menu
 */
function flowplayer_settings(){
	echo flowplayer::admin_head();
	flowplayer::get_nonce();
	if (wp_verify_nonce( $_POST['flowplayer_noncename'], FLOWPLAYER_NONCE_FILE )) {
    	flowplayer::_setautoplay($_POST['flowplayer_autoplay']);
    	flowplayer::_setkey($_POST['flowplayer_key']);
    	flowplayer::_setautobuffer($_POST['flowplayer_autobuffer']);
    	flowplayer::_setbackgroundColor($_POST['flowplayer_backgroundColor']);	
		flowplayer::_setcanvas($_POST['flowplayer_canvas']);
		flowplayer::_setsliderColor($_POST['flowplayer_sliderColor']);
		flowplayer::_setbuttonColor($_POST['flowplayer_buttonColor']);
		flowplayer::_setbuttonOverColor($_POST['flowplayer_buttonOverColor']);
		flowplayer::_setdurationColor($_POST['flowplayer_durationColor']);
		flowplayer::_settimeColor($_POST['flowplayer_timeColor']);
		flowplayer::_setprogressColor($_POST['flowplayer_progressColor']);
		flowplayer::_setbufferColor($_POST['flowplayer_bufferColor']);
		flowplayer::_setlogo($_POST['flowplayer_logo']);
		flowplayer::_setlogolink($_POST['flowplayer_logolink']);
  	}
 
  	echo flowplayer::flowplayer_settings();
  	
}  

function flowplayer_head(){
	echo flowplayer::player_head();
} 
 

?>