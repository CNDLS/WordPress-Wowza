<?PHP
/*
Plugin Name: Flowplayer for Wordpress
Plugin URI: http://saiweb.co.uk/wordpress-flowplayer
Description: Flowplayer Wordpress Extension
Version: 2.1.0.0-DEV-PREVIEW
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
 add_action('admin_menu', 'flowplayer_admin');
 add_action('wp_head', 'flowplayer_head');
 /**
  * END WP Hooks
  */

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
}

function flowplayer_settings(){
	echo flowplayer::admin_head();
	
	if (wp_verify_nonce( $_POST['flowplayer_noncename'], plugin_basename(__FILE__) )) {
    	add_option('flowplayer_autoplay',$_POST['flowplayer_autoplay']);
    	add_option('flowplayer_key',$_POST['flowplayer_key']);
    	add_option('flowplayer_autobuffer',$_POST['flowplayer_autobuffer']);
    	add_option('flowplayer_backgroundColor'.$fp->conf['backgroundColor']);	
		add_option('flowplayer_canvas',$_POST['flowplayer_canvas']);
		add_option('flowplayer_sliderColor',$_POST['flowplayer_sliderColor']);
		add_option('flowplayer_buttonColor',$_POST['flowplayer_buttonColor']);
		add_option('flowplayer_buttonOverColor',$_POST['flowplayer_buttonOverColor']);
		add_option('flowplayer_durationColor',$_POST['flowplayer_durationColor']);
		add_option('flowplayer_timeColor',$_POST['flowplayer_timeColor']);
		add_option('flowplayer_progressColor',$_POST['flowplayer_progressColor']);
		add_option('flowplayer_bufferColor',$_POST['flowplayer_bufferColor']);
		add_option('flowplayer_logo',$_POST['flowplayer_logo']);
		add_option('flowplayer_logolink',$_POST['flowplayer_logolink']);
  	}
  	
  	echo flowplayer::flowplayer_settings();
  	
}  

function flowplayer_head(){
	echo flowplayer::player_head();
} 
 

?>