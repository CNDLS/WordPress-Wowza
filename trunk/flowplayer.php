<?PHP
/*
Plugin Name: Flowplayer for Wordpress
Plugin URI: http://saiweb.co.uk/wordpress-flowplayer
Description: Flowplayer Wordpress Extension GPL Edition
Version: 2.0.0.0
Author: David Busby
Author URI: http://saiweb.co.uk
*/
/**
 * FlowPlayer for Wordpress
 * ©2008 David Busby
 * @see http://creativecommons.org/licenses/by-nc-sa/2.0/uk
 */

/**
 * WP Hooks
 */
add_filter('the_content', 'flowplayer_content');
add_action('admin_menu', 'flowplayer_admin');
/**
 * END WP Hooks
 */
 
/**
 * Admin menu function!
 */
function flowplayer_admin () {
	/**
	 * We're in the admin page
	 */
	 if (function_exists('add_submenu_page')) {
		add_options_page(
							'Wordpress Flowplayer', 
							'Wordpress Flowplayer', 
							8, 
							basename(__FILE__), 
							'flowplayer_page'
						);
	}
}

function flowplayer_page() {
	$html = 
'<div class="wrap">
 <h2>Saiweb Flowplayer for Wordpress</h2> 
<table>
	<tr>
		<td>AutoPlay</td>
		<td><select name="autoplay"><option value="true">true</option><option value="false">false</option></select></td>
	</tr>
</table>
 </div>';
}

function flowplayer_content( $content ) {
	$fp = new flowplayer();
	
	$regex = '/\[FLOWPLAYER=([a-z0-9\.\-\&\_]+)\,([0-9]+)\,([0-9]+)\]/';
	$matches = array();

	preg_match_all($regex, $content, $matches);
	
	if($matches[0][0] != '') {
		foreach($matches[0] as $key => $data) {
			/**
			 * 0 = string
			 * 1 = media
			 * 2 = width
			 * 3 = height
			 */
			$content = str_replace($matches[0][$key], $fp->build_min_player($matches[2][$key], $matches[3][$key], $matches[1][$key]),$content);

		}
	
	} else {
		$regex = '/\[FLOWPLAYER=([a-z0-9\.\-\&\_\:\/]+)\,([a-z0-9\.\-\&\_]+)\,([0-9]+)\,([0-9]+)\]/';
		$matches = array();
		preg_match_all($regex, $content, $matches);
		if($matches[0][0] != '') {
			foreach($matches[0] as $key => $data) {
				/**
		 		* 0 = string
		 		* 1 = server
		 		* 2 = media
		 		* 3 = width
			 	* 4 = height
			 	*/
				$content = str_replace($matches[0][$key], $fp->build_min_player($matches[3][$key], $matches[4][$key], $matches[2][$key], $matches[1][$key]),$content);
			}
		}
		
	}
	
	return $content;
}

class flowplayer
{
	private $count = 0;
	
	const RELATIVE_PATH = '/wp-content/plugins/word-press-flow-player';
	const VIDEO_PATH = '/wp-content/videos/';
	
	/**
	 * Salt function
	 * @return string salt
	 */
	private function _salt() {
        $salt = substr(md5(uniqid(rand(), true)), 0, 10);    
        return $salt;
	}
	
	public function build_min_player($width, $height, $media, $server=false) {
			$this->count++;
			$html = '';
			
			
			if($this->count == 1){
				/**
				 * includes once only :-) 
				 * @todo per post, multi post pages include more than once, possible to use a WP hook to write header?
				 */
				$html = '<script type="text/javascript" src="'.flowplayer::RELATIVE_PATH.'/flowplayer_3.0.1_gpl/flowplayer.min.js"></script>';
			}
			
			/**
			 * Fix #2 
			 * @see http://trac.saiweb.co.uk/saiweb/ticket/2
			 */
			$hash = md5($media.$this->_salt());
			
			/**
			 * Very basic integration of flowplayer 3.0.1
			 */
			$html .= '<a href="'.flowplayer::VIDEO_PATH.$media.'" style="display:block;width:425px;height:300px;" id="saiweb_'.$hash.'"></a>';
    		$html .= '<script language="JavaScript"> flowplayer("saiweb_'.$hash.'", "'.flowplayer::RELATIVE_PATH.'/flowplayer_3.0.1_gpl/flowplayer-3.0.1.swf"); </script>';

		return $html;
	}
}
?>