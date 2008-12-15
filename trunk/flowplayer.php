<?PHP
/*
Plugin Name: Flowplayer for Wordpress
Plugin URI: http://saiweb.co.uk/wordpress-flowplayer
Description: Flowplayer Wordpress Extension GPL Edition
Version: 1.0.0.36
Author: David Busby
Author URI: http://saiweb.co.uk
*/
/**
 * FlowPlayer for Wordpress
 * ©2008 David Busby
 * @see http://creativecommons.org/licenses/by-nc-sa/2.0/uk
 */

add_filter('the_content', 'flowplayer_content');

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
	
	const RELATIVE_PATH = '/wp-content/plugins/word-press-flow-player/';
	const VIDEO_PATH = '/wp-content/videos/';
	
	/**
	 * Salt function
	 * @return string salt
	 */
	private function _salt() {
        $salt = substr(md5(uniqid(rand(), true)), 0, 10);
        $salt = substr($salt, 0, 10);      
        return $salt;
	}
	
	public function build_min_player($width, $height, $media, $server=false) {
			$this->count++;
			
			$html = '';
			
			if($this->count == 1){
				/**
				 * includes once only :-)
				 */
				$html = '<script type="text/javascript" src="'.flowplayer::RELATIVE_PATH.'js/flashembed.min.js"></script>';
			}
			
			/**
			 * Fix #2 
			 * @see http://trac.saiweb.co.uk/saiweb/ticket/2
			 */
			$hash = md5($media.$this->_salt());
			
			//old 2.x code
			$html .= '
			<script type="text/javascript">
	 /*
		use flashembed to place flowplayer into HTML element 
		whose id is "example" (below this script tag)
	 */
	 flashembed("media_'.$hash.'", 
	
		/* 
			first argument supplies standard Flash parameters. See full list:
			http://kb.adobe.com/selfservice/viewContent.do?externalId=tn_12701
		*/
		{
			src:\''.flowplayer::RELATIVE_PATH .'FlowPlayerDark.swf\',
			width: '.$width.', 
			height: '.$height.'
		},
		
		/*
			second argument is Flowplayer specific configuration. See full list:
			http://flowplayer.org/player/configuration.html
		*/
		{config: {   
			autoPlay: false,
			autoBuffering: false,
			loop: false,
			controlBarBackgroundColor:\'0x007062\',
			initialScale: \'scale\',';
			if(!$server) { 
				$html .='videoFile: \'http://'.$_SERVER['SERVER_NAME'];
				if(!file_exists($_SERVER['DOCUMENT_ROOT'].flowplayer::VIDEO_PATH)) {
					//temp legacy this will be removed in 1.1.0.0 make sure you move your media!
					$html .= '/videos/';
				} else {
					$html .= flowplayer::VIDEO_PATH;
				}
				$html .= $media.'\''; 
			} else {
				$html 	.= "\n".'videoFile: \''.$media.'\','
						.  "\n".'streamingServerURL: \''.$server.'\',';
			}
			$html .='
		}}
		);
		</script>
		<div id="media_'.$hash.'"></div>
	';
	
	//new 3.x
	$html = '<a href="'.flowplayer::VIDEO_PATH.$media.'"  
    style="display:block;width:425px;height:300px;"  
    id="saiweb_'.$hash.'"></a>';
    $html .= '<script language="JavaScript"> 
    flowplayer("saiweb_"'.$hash.', "/swf/flowplayer-3.0.1.swf"); 
</script>';

		return $html;
	}
}
?>