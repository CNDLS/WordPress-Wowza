<?PHP

/**
 * FlowPlayer for Wordpress
 * ©2008,2009 David Busby
 * @see license.txt GPLv3
 */
class wowza {
	
	/**
	 * Statup function, sets up defines
	 **/
	function setup(){
		global $post;
		
		wowza::plugin_url();
		wowza::commercial_url();
		wowza::gpl_url();
		wowza::player();
		
		if(!defined('WOWZA_META')){
			define('WOWZA_META','wowza_meta');
		}
		
		/*if(!defined('WOWZA_DATA')){
			define('WOWZA_DATA', get_post_meta($post->ID, WOWZA_META));
		}*/
	}
	
	function data_parse($data){
		$data = explode('|',$data);
		$ret = array(
			'media' => $data[0],
			'width' => $data[1],
			'height' => $data[2]
		);
		return $ret;
	}
	
	function commercial_url(){
		if(!defined('WOWZA_COMMERCIAL')){
			define('WOWZA_COMMERCIAL',wowza::plugin_url().'/flowplayer/commercial/flowplayer.commercial-3.1.5.swf');
		}
		return WOWZA_COMMERCIAL;
	}
	
	function gpl_url(){
		if(!defined('WOWZA_GPL')){
			define('WOWZA_GPL',wowza::plugin_url().'/flowplayer/gpl/flowplayer-3.2.5.swf');
		}
		
		return WOWZA_GPL;
	}
	
	function player(){
		if(!defined('WOWZA_URL')){
			if(wowza::_getkey()){
				define('WOWZA_URL',wowza::commercial_url());
			} else {
				define('WOWZA_URL',wowza::gpl_url());
			}
		}
		return WOWZA_URL;
	}
	
	function plugin_url(){
		if(!defined('PLUGIN_URL')){
			$cwd = realpath(dirname(__FILE__).'/../');
			$plugin_url = str_replace($_SERVER['DOCUMENT_ROOT'],'',$cwd);
			define('PLUGIN_URL',$plugin_url);
		}	
		return PLUGIN_URL;
	}
	
	function _getbackgroundColor(){ return get_option('wowza_backgroundColor'); }		
	function _getcanvas(){ return get_option('wowza_canvas'); }
	function _getsliderColor(){ return get_option('wowza_sliderColor'); }
	function _getbuttonColor(){ return get_option('wowza_buttonColor'); }
	function _getbuttonOverColor(){ return get_option('wowza_buttonOverColor'); }
	function _getdurationColor(){ return get_option('wowza_durationColor'); }
	function _gettimeColor(){ return get_option('wowza_timeColor'); }
	function _getprogressColor(){ return get_option('wowza_progressColor'); }
	function _getbufferColor(){ return get_option('wowza_bufferColor'); }
	function _getautobuffer(){return get_option('wowza_autobuffer');}
	function _getautoplay(){return get_option('wowza_autoplay');}
	function _getkey(){	return get_option('wowza_key');}
	function _getlogo(){ return get_option('wowza_logo');}
	function _getlogolink(){ return get_option('wowza_logolink');}
	
	function _setbackgroundColor($val){ update_option('wowza_backgroundColor',$val); }		
	function _setcanvas($val){ update_option('wowza_canvas',$val); }
	function _setsliderColor($val){ update_option('wowza_sliderColor',$val); }
	function _setbuttonColor($val){ update_option('wowza_buttonColor',$val); }
	function _setbuttonOverColor($val){ update_option('wowza_buttonOverColor',$val); }
	function _setdurationColor($val){ update_option('wowza_durationColor',$val); }
	function _settimeColor($val){ update_option('wowza_timeColor',$val); }
	function _setprogressColor($val){ update_option('wowza_progressColor',$val); }
	function _setbufferColor($val){ update_option('wowza_bufferColor',$val); }
	function _setkey($val){	update_option('wowza_key',$val);}
	function _setautoplay($val){update_option('wowza_autoplay', $val);}
	function _setautobuffer($val){update_option('wowza_autobuffer',$val);}
	function _setlogo($val){update_option('wowza_logo',$val);}
	function _setlogolink($val){update_option('wowza_logolink',$val);}
	
	// directory in <wowza>/content where our assets will live.
	function _getdirectory(){ return get_option('wowza_directory');}
	function _setdirectory($val){update_option('wowza_directory',$val);}
	function _getdirectoryListing(){ return '';}
	
	function get_nonce(){
		if(!defined('WOWZA_NONCE')){
			define('WOWZA_NONCE',wp_create_nonce( plugin_basename(__FILE__) ));
			define('WOWZA_NONCE_FILE', plugin_basename(__FILE__));
		}
		
		return WOWZA_NONCE;
	}
	
	function player_head(){
		if(!defined('WOWZA_HEAD')){
			$html = "\n<!-- Wowza For Wordpress Javascript -->\n";
			$html .= "\n".'<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>';
			$html .= "\n".'<script type="text/javascript">WPFP = jQuery.noConflict();</script>';
			$html .= '<script type="text/javascript" src="'.wowza::plugin_url().'/flowplayer/flowplayer-3.2.4.min.js"></script>';
			define('WOWZA_HEAD', $html);	
		}		
		if(!is_admin()){return WOWZA_HEAD;}
		else {return '';}
	}
	
	function admin_head(){
		if(!defined('WOWZA_ADMIN_HEAD')){
			$html = "\n<!-- Wowza For Wordpress ADMIN Javascript -->\n";
			$html .= "\n".'<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>';	
 			$html .= "\n".'<script type="text/javascript">WPFP = jQuery.noConflict(); $ = jQuery.noConflict();</script>';
 			$html .= "\n".'<script type="text/javascript" src="'.wowza::plugin_url().'/js/farbtastic/farbtastic.js"></script>';
 			$html .= "\n".'<script src="http://svn.saiweb.co.uk/branches/jquery_plugin/tags/latest/jquery.saiweb.min.js" type="text/javascript"></script>';
 			$html .= "\n".'<link rel="stylesheet" href="'.wowza::plugin_url().'/js/farbtastic/farbtastic.css" type="text/css" />';
 			$html .= '<script type="text/javascript" src="'.wowza::plugin_url().'/flowplayer/flowplayer-3.2.4.min.js"></script>';
 			$html .= '
 			<script type="text/javascript">
 				jQuery(document).ready(function(){
 					function _regKeyup(){
 						var tgt = $(":input[name=tgt]:checked").val();
						tgtArr = tgt.split(\'_\');
						$.farbtastic(\'#colourpicker\').setColor($(":input[name="+tgt+"]").val());
						$(":input[name="+tgt+"]").keyup(function(){
							$.farbtastic(\'#colourpicker\').setColor($(":input[name="+tgt+"]").val());
							var player = $f("player");
							if (player.isLoaded()) {						

								// adjust canvas bgcolor. uses undocumented API call. not stabilized yet
								if (tgtArr[1] == \'canvas\') {					
									player._api().ww_css("canvas", {backgroundColor:$(this).val()});
								// adjust controlbar coloring
								} else {
									window.canvasColor = $(this).val();
									player.getControls().css(tgtArr[1], $(this).val());
								}
							}
						});
 					}
 					$(":input[name=tgt]").click(function(){
 						_regKeyup();
 					});
 				});
 			</script>
 			
 			';
 			$html .= wowza::player_head();
			define('WOWZA_ADMIN_HEAD',$html);
		}
		
		return WOWZA_ADMIN_HEAD;
	}
	
	/**
 	* Output 'selected' bool options based on arg passed
 	* @var string true / false
 	* @return string HTML
 	*/
	function bool_select($current) {
		switch($current) {
		 		case "true":
		 			$html = '<option selected value="true">true</option><option value="false">false</option>';
		 		break;
		 		case "false":
		 			$html = '<option value="true" >true</option><option selected value="false">false</option>';
		 		break;
		 		default:
		 			$html = '<option value="true">true</option><option selected value="false">false</option>';
		 		break;
		 	}
		 return $html;
	}
	
	function wowza_storage(){
		$html ='<h3>Manage Your Wowza Content</h3>
    <table>
    	<tr>
      	<td>Wowza Content Directory:</td>
      	<td><input type="text" size="20" name="wowza_directory">'.wowza::_getdirectory().'</input></td>
      </tr>
      <tr>
      	<td>Streamable Files:</td>
      	<td>'.wowza::_getdirectoryListing().'</td>
      </tr>
      <tr>
      	<td>Upload New File for Streaming:</td>
      	<td><input type="file" id="newstream" name="newstream"></input></td>
      </tr>
    </table>';
		
		return $html;
	}
	
	function wowza_colours(){
		$html ='<ul>
		<li><input disabled type="radio" name="tgt" value="wowza_backgroundColor" checked /><input type="text" size="7" name="wowza_backgroundColor" value="'.(wowza::_getbackgroundColor()!=''?wowza::_getbackgroundColor():'#').'" /> controlbar</li>		
		<li><input disabled type="radio" name="tgt" value="wowza_canvas" /><input type="text" size="7" name="wowza_canvas" value="'.(wowza::_getcanvas()!=''?wowza::_getcanvas():'#').'" /> canvas</li>
		<li><input disabled type="radio" name="tgt" value="wowza_sliderColor" /><input type="text" size="7" name="wowza_sliderColor" value="'.(wowza::_getsliderColor()!=''?wowza::_getsliderColor():'#').'" /> sliders</li>
		<li><input disabled type="radio" name="tgt" value="wowza_buttonColor" /><input type="text" size="7" name="wowza_buttonColor" value="'.(wowza::_getbuttonColor()!=''?wowza::_getbuttonColor():'#').'" /> buttons</li>
		<li><input disabled type="radio" name="tgt" value="wowza_buttonOverColor" /><input type="text" size="7" name="wowza_buttonOverColor" value="'.(wowza::_getbuttonOverColor()!=''?wowza::_getbuttonOverColor():'#').'" /> mouseover</li>
		<li><input disabled type="radio" name="tgt" value="wowza_durationColor" /><input type="text" size="7" name="wowza_durationColor" value="'.(wowza::_getdurationColor()!=''?wowza::_getdurationColor():'#').'" /> total time</li>
		<li><input disabled type="radio" name="tgt" value="wowza_timeColor" /><input type="text" size="7" name="wowza_timeColor" value="'.(wowza::_gettimeColor()!=''?wowza::_gettimeColor():'#').'" /> time</li>
		<li><input disabled type="radio" name="tgt" value="wowza_progressColor" /><input type="text" size="7" name="wowza_progressColor" value="'.(wowza::_getprogressColor()!=''?wowza::_getprogressColor():'#').'" /> progress</li>
		<li><input disabled type="radio" name="tgt" value="wowza_bufferColor" /><input type="text" size="7" name="wowza_bufferColor" value="'.(wowza::_getbufferColor()!=''?wowza::_getbufferColor():'#').'" /> buffer</li>
		</ul>
		';
		
		return $html;
	}
	
	function wowza_settings(){
		$html = '
					<script type="text/javascript">
	WPFP(document).ready(function() {
		//load player
		$f("player", "'.(wowza::_getkey()?wowza::commercial_url():wowza::gpl_url()).'", {
				plugins: {
  					 controls: {    					
      					'.(wowza::_getbuttonOverColor()!=''?'buttonOverColor: \''.wowza::_getbuttonOverColor().'\',':'').'
      					'.(wowza::_getsliderColor()!=''?'sliderColor: \''.wowza::_getsliderColor().'\',':'').'
      					'.(wowza::_getbufferColor()!=''?'bufferColor: \''.wowza::_getbufferColor().'\',':'').'
      					sliderGradient: \'none\',
      					progressGradient: \'medium\',
      					'.(wowza::_getdurationColor()!=''?'durationColor: \''.wowza::_getdurationColor().'\',':'').'
      					'.(wowza::_getprogressColor()!=''?'progressColor: \''.wowza::_getprogressColor().'\',':'').'
      					'.(wowza::_getbackgroundColor()!=''?'backgroundColor: \''.wowza::_getbackgroundColor().'\',':'').'
      					'.(wowza::_gettimeColor()!=''?'timeColor: \''.wowza::_gettimeColor().'\',':'').'
      					'.(wowza::_getbuttonColor()!=''?'buttonColor: \''.wowza::_getbuttonColor().'\',':'').'
      					backgroundGradient: \'none\',
      					bufferGradient: \'none\',
   						opacity:1.0
   						}
				},
				clip: {
					url:\'http://saiweb.co.uk/wp-content/videos/wpfp_config_demo.mp4\',
					autoPlay: '.(wowza::_getautoplay()=='true'?'true':'false').',
       				autoBuffering: '.(wowza::_getautobuffer()=='true'?'true':'false').'
				},
				'.(wowza::_getkey()?'key:\''.wowza::_getkey().'\',':'');
if(strlen(wowza::_getlogo()) > 0){
	$html .= '
		logo: {  
        url: \''.wowza::_getlogo().'\',  
        displayTime: 0,
        fullscreenOnly: false,
        linkUrl: \''.wowza::_getlogolink().'\' 
    },';
}
$html .= '
				canvas: {
					backgroundColor:\''.wowza::_getcanvas().'\'
				},
				onLoad: function() {
					$(":input[name=tgt]").removeAttr("disabled");		
				},
				onUnload: function() {
					$(":input[name=tgt]").attr("disabled", true);		
				}
			});
		//colour picker call back to api and hidden vars		
		WPFP(\'#colourpicker\').farbtastic(function(color){
			var tgt = $(":input[name=tgt]:checked").val();
			tgtArr = tgt.split(\'_\');
			//set to hidden input
			$(":input[name="+tgt+"]").val(color);
			var player = $f("player");
				
			if (player.isLoaded()) {						

			// adjust canvas bgcolor. uses undocumented API call. not stabilized yet
			if (tgtArr[1] == \'canvas\') {					
				player._api().ww_css("canvas", {backgroundColor:color});
				
			// adjust controlbar coloring
			} else {
				window.canvasColor = color;
				player.getControls().css(tgtArr[1], color);
			}			
			
		} else {
			player.load();	
		}			
		});
	});
</script>
						<div class="wrap">
						<form id="wpww_options" method="post">
						<div id="icon-options-general" class="icon32"><br></div>
						<h2>Wowza for Wordpress</h2>
						';
						$html .= wowza::wowza_storage().'<h3>Please set your default player options below</h3>
						<table>
							<tr>
								<td>AutoPlay: </td>
								<td>
		 							<select name="wowza_autoplay">
										'.wowza::bool_select(wowza::_getautoplay()).'
		 							</select>
		 							
		 						</td>
							</tr>
							<tr>
								<td>Commercial License Key: </td>
								<td>
									<input type="text" size="20" name="wowza_key" id="wowza_key" value="'.wowza::_getkey().'" />	
									(Required for certain features i.e. custom logo)
								</td>
							</tr>
							<tr>
								<td>Logo URL: </td>
								<td>
									<input type="text" size="20" name="wowza_logo" id="wowza_logo" value="'.wowza::_getlogo().'" />	
									(only works with valid license key)
								</td>
							</tr>
							<tr>
								<td>Logo Link: </td>
								<td>
									<input type="text" size="20" name="wowza_logolink" id="wowza_logolink" value="'.wowza::_getlogolink().'" />	
									(only works with valid license key)
								</td>
							</tr>
							<tr>
								<td>Auto Buffering:</td>
								<td><select name="wowza_autobuffer">'.wowza::bool_select(wowza::_getautobuffer()).'</select></td>
							</tr>
							<tr>
								<td><div id="colourpicker"></div></td>
								<td>
									'.wowza::wowza_colours().'
								</td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td>
									<input type="submit" name="submit" class="button-primary" value="Save Changes" />
								</td>
							</tr>
						</table>
						<input type="hidden" name="wowza_noncename" id="wowza_noncename" value="'.wowza::get_nonce().'" />
						</form>
						<div id="player" style="width:300px;height:200px;"></div>
					</div>


';
		return $html;
	}
	
	 /** 
	  * Salt function
	  * @see http://trac.saiweb.co.uk/saiweb/ticket/2
	  * @return string salt
	  */
	function _salt() {
        $salt = substr(md5(uniqid(rand(), true)), 0, 10);    
        return $salt;
	}
	
	function legacy_hook($content){
		
		$regex = '/\[WOWZA=([a-z0-9\:\.\-\&\_\/\|]+)\,([0-9]+)\,([0-9]+)\]/i';
		$matches = array();
	
		preg_match_all($regex, $content, $matches);
		
		if($matches[0][0] != '') {
			foreach($matches[0] as $key => $data) {
				$content = str_replace($matches[0][$key], wowza::build_player($matches[2][$key], $matches[3][$key], $matches[1][$key]),$content);
			}	
		}
		
		return $content;
	}
	
	function build_player($width,$height,$media){
			/*
			 * Fix #2 
			 * @see http://trac.saiweb.co.uk/saiweb/ticket/2
			 */
			$list = explode('|',$media);
			
			$hash = md5($media.wowza::_salt());
			$html = '<div id="saiweb_'.$hash.'" style="width:'.$width.'px; height:'.$height.'px;" class="flowplayer"></div>';
			$html .= '<script language="Javascript" type="text/javascript">
	WPFP(document).ready(function() {
		//load player
		$f("saiweb_'.$hash.'", "'.(wowza::_getkey()?wowza::commercial_url():wowza::gpl_url()).'", {
				plugins: {
  					 controls: {    					
      					'.(wowza::_getbuttonOverColor()!=''?'buttonOverColor: \''.wowza::_getbuttonOverColor().'\',':'').'
      					'.(wowza::_getsliderColor()!=''?'sliderColor: \''.wowza::_getsliderColor().'\',':'').'
      					'.(wowza::_getbufferColor()!=''?'bufferColor: \''.wowza::_getbufferColor().'\',':'').'
      					sliderGradient: \'none\',
      					progressGradient: \'medium\',
      					'.(wowza::_getdurationColor()!=''?'durationColor: \''.wowza::_getdurationColor().'\',':'').'
      					'.(wowza::_getprogressColor()!=''?'progressColor: \''.wowza::_getprogressColor().'\',':'').'
      					'.(wowza::_getbackgroundColor()!=''?'backgroundColor: \''.wowza::_getbackgroundColor().'\',':'').'
      					'.(wowza::_gettimeColor()!=''?'timeColor: \''.wowza::_gettimeColor().'\',':'').'
      					'.(wowza::_getbuttonColor()!=''?'buttonColor: \''.wowza::_getbuttonColor().'\',':'').'
      					backgroundGradient: \'none\',
      					bufferGradient: \'none\',
   						opacity:1.0
   						},
   						
   						wowza: {
                url:"'.wowza::plugin_url().'/flowplayer/gpl/flowplayer.rtmp-3.2.3.swf",
                netConnectionUrl: "rtmp://uis-cndls-3.georgetown.edu:1935/vod"
              }
				},';
				
	if(count($list) > 1){
		
				
		//splash image code, adapted from user contributed code from James P
		$iRegex = '/\.(jpe?g|gif|png)$/';
		$splash = (preg_match($iRegex,$list[0]) && !preg_match($iRegex,$list[1]));
		
		$html .= '
			clip: {
			    provider: "wowza",
					autoPlay: '.($splash==true?'true':(wowza::_getautoplay()=='true'?'true':'false')).',
       				autoBuffering: '.(wowza::_getautobuffer()=='true'?'true':'false').'
				},';
				
		$html .= 'playlist:[
				 
				';
				$i = 0;
				foreach($list as $item){
					if(!$splash){
						$html .= '{url: \''.$item.'\'},'."\n";
					} else {
						if($i == 0){
							//this is the splash image
							$html .= '{url: \''.$item.'\', autoPlay: true},'."\n";
						} else {
							//next items are not the splash image
							$html .= '{url: \''.$item.'\', autoPlay: false},'."\n";
						}
					}
					$i++;
				}
				$html .= '],'."\n";
	} else {
			$html .= '
			clip: {
					url:\''.(wowza::_getautobuffer()!=''?wowza::_getdirectory().'/':'').$media.'\',
    			provider: "wowza",
					autoPlay: '.(wowza::_getautoplay()=='true'?'true':'false').',
       				autoBuffering: '.(wowza::_getautobuffer()=='true'?'true':'false').'
				},';
	}
		$html .= (wowza::_getkey()?'key:\''.wowza::_getkey().'\',':'');
if(strlen(wowza::_getlogo()) > 0){
	$html .= '
		logo: {  
        url: \''.wowza::_getlogo().'\',  
        displayTime: 0,
        fullscreenOnly: false,
        linkUrl: \''.wowza::_getlogolink().'\' 
    },';
}
$html .= '
				canvas: {
					backgroundColor:\''.wowza::_getcanvas().'\'
				}})
			});</script>
				';
				
		return $html;	
	}
}

?>