<?PHP

class flowplayer {
	
	function setup(){
		flowplayer::plugin_url();
		flowplayer::commercial_url();
		flowplayer::gpl_url();
		flowplayer::player();
	}
	
	function commercial_url(){
		if(!defined('FLOWPLAYER_COMMERCIAL')){
			define('FLOWPLAYER_COMMERCIAL',flowplayer::plugin_url().'/flowplayer/commercial/flowplayer.commercial-3.1.0-dev3.swf');
		}
	}
	
	function gpl_url(){
		if(!defined('FLOWPLAYER_GPL')){
			define('FLOWPLAYER_GPL',flowplayer::plugin_url().'/flowplayer/gpl/flowplayer-3.1.0-dev3.swf');
		}
	}
	
	function player(){
		if(!defined('FLOWPLAYER_URL')){
			if(flowplayer::_getkey()){
				define('FLOWPLAYER_URL',flowplayer::commercial_url());
			} else {
				define('FLOWPLAYER_URL',flowplayer::gpl_url());
			}
		}
	}
	
	function plugin_url(){
		if(!defined('PLUGIN_URL')){
			define('PLUGIN_URL',get_option('siteurl').'/wp-content/plugins/word-press-flow-player');
		}	
		return PLUGIN_URL;
	}
	
	function _getkey(){
		return get_option('flowplayer_key');
	}
	
	function _setkey($val){
		add_option('flowplayer_key',$val);
	}
	
	function _getautoplay(){
		return get_option('flowplayer_autoplay');
	}
	
	function _setautoplay($val){
		add_option('flowplayer_autoplay', $val);
	}
	
	function _getautobuffer(){
		return get_option('flowplayer_autobuffer');
	}
	
	function _setautobuffer($val){
		add_option('flowplayer_autobuffer',$val);	
	}
	
	function player_head(){
		if(!defined('FLOWPLAYER_HEAD')){
			$html = "\n<!-- Saiweb.co.uk Flowplayer For Wordpress Javascript Start -->\n";
			$html .= '<script type="text/javascript" src="'.flowplayer::plugin_url().'/flowplayer/flowplayer-3.1.0-dev.min.js"></script>';
 			$html .= "\n<!-- Saiweb.co.uk Flowplayer For Wordpress Javascript END -->\n";
			define('FLOWPLAYER_HEAD', $html);	
		}		
		return FLOWPLAYER_HEAD;
	}
	
	function admin_head(){
		if(!defined('FLOWPLAYER_ADMIN_JS')){
			$html = "\n<!-- Saiweb.co.uk Flowplayer For Wordpress ADMIN Javascript Start -->\n";
 			$html .= '<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>';	
 			$html .= "\n".'<script type="text/javascript" src="'.flowplayer::plugin_url().'/js/farbtastic/farbtastic.js"></script>';
 			$html .= "\n".'<script src="http://svn.saiweb.co.uk/branches/jquery_plugin/tags/latest/jquery.saiweb.min.js" type="text/javascript"></script>';
 			$html .= "\n".'<link rel="stylesheet" href="'.flowplayer::plugin_url().'/js/farbtastic/farbtastic.css" type="text/css" />';
 			$html .= "\n<!-- Saiweb.co.uk Flowplayer For Wordpress ADMIN Javascript END -->\n";
 			$html .= flowplayer::player_head();
			define('FLOWPLAYER_ADMIN_HEAD',$html);
		}
		
		return FLOWPLAYER_ADMIN_HEAD;
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
	
	function flowplayer_colours(){
		$html ='<ul>
		<li><input disabled type="radio" name="tgt" value="flowplayer_backgroundColor" checked /> controlbar</li>		
		<li><input disabled type="radio" name="tgt" value="flowplayer_canvas" /> canvas</li>
		<li><input disabled type="radio" name="tgt" value="flowplayer_sliderColor" /> sliders</li>
		<li><input disabled type="radio" name="tgt" value="flowplayer_buttonColor" /> buttons</li>
		<li><input disabled type="radio" name="tgt" value="flowplayer_buttonOverColor" /> mouseover</li>
		<li><input disabled type="radio" name="tgt" value="flowplayer_durationColor" /> total time</li>
		<li><input disabled type="radio" name="tgt" value="flowplayer_timeColor" /> time</li>
		<li><input disabled type="radio" name="tgt" value="flowplayer_progressColor" /> progress</li>
		<li><input disabled type="radio" name="tgt" value="flowplayer_bufferColor" /> buffer</li>
		</ul>
		';
		
		$html .= 
			'
			<input type="hidden" name="flowplayer_backgroundColor" value="'.get_option('flowplayer_backgroundColor').'" />		
			<input type="hidden" name="flowplayer_canvas" value="'.get_option('flowplayer_canvas').'" />
			<input type="hidden" name="flowplayer_sliderColor" value="'.get_option('flowplayer_sliderColor').'" />
			<input type="hidden" name="flowplayer_buttonColor" value="'.get_option('flowplayer_buttonColor').'" />
			<input type="hidden" name="flowplayer_buttonOverColor" value="'.get_option('flowplayer_buttonOverColor').'" />
			<input type="hidden" name="flowplayer_durationColor" value="'.get_option('flowplayer_durationColor').'" />
			<input type="hidden" name="flowplayer_timeColor" value="'.get_option('flowplayer_timeColor').'" />
			<input type="hidden" name="flowplayer_progressColor" value="'.get_option('flowplayer_progressColor').'" />
			<input type="hidden" name="flowplayer_bufferColor" value="'.get_option('flowplayer_bufferColor').'" />
		';
		return $html;
	}
	
	function flowplayer_settings(){
		$html = '
					<script language="Javascript" type="text/javascript">
	$(document).ready(function() {
		//load player
		$f("player", "'.(flowplayer::_getkey()?flowplayer::commercial_url():flowplayer::gpl_url()).'", {
				'.(flowplayer::_getkey()?'key:\''.flowplayer::_getkey().'\',':'').'
				plugins: {
  					 controls: {    					
      					buttonOverColor: \''.$fp->conf['buttonOverColor'].'\',
      					sliderColor: \''.$fp->conf['sliderColor'].'\',
      					bufferColor: \''.$fp->conf['bufferColor'].'\',
      					sliderGradient: \'none\',
      					progressGradient: \'medium\',
      					durationColor: \''.$fp->conf['durationColor'].'\',
      					progressColor: \''.$fp->conf['progressColor'].'\',
      					backgroundColor: \''.$fp->conf['backgroundColor'].'\',
      					timeColor: \''.$fp->conf['timeColor'].'\',
      					buttonColor: \''.$fp->conf['buttonColor'].'\',
      					backgroundGradient: \'none\',
      					bufferGradient: \'none\',
   						opacity:1.0
   						}
				},
				clip: {
					url:\'http://saiweb.co.uk/wp-content/videos/wpfp_config_demo.mp4\',
					autoPlay: '.(flowplayer::_getautoplay()?'true':'false').',
       				autoBuffering: '.(flowplayer::_getautobuffer()?'true':'false').'
				},';
if($fp->conf['logoenable'] == 'true'){
	$html .= '
		logo: {  
        url: \'http://'.$fp->conf['logo'].'\',  
        fullscreenOnly: '.$fp->conf['fullscreenonly'].',  
        displayTime: 0,
        linkUrl: \'http://'.$fp->conf['logolink'].'\' 
    },';
}
$html .= '
				canvas: {
					backgroundColor:\''.$fp->conf['backgroungColor'].'\'
				},
				onLoad: function() {
					$(":input[name=tgt]").removeAttr("disabled");		
				},
				onUnload: function() {
					$(":input[name=tgt]").attr("disabled", true);		
				}
			});
		//colour picker call back to api and hidden vars		
		$(\'#colourpicker\').farbtastic(function(color){
			var tgt = $(":input[name=tgt]:checked").val();
			//set to hidden input
			$(":input[name="+tgt+"]").val(color);
			var player = $f("player");
				
			if (player.isLoaded()) {						

			// adjust canvas bgcolor. uses undocumented API call. not stabilized yet
			if (tgt == \'canvas\') {					
				player._api().fp_css("canvas", {backgroundColor:color});
				
			// adjust controlbar coloring
			} else {
	
				window.canvasColor = color;
				player.getControls().css(tgt, color);	
			}			
			
		} else {
			player.load();	
		}			
		});
	});
</script>
						<div class="wrap">
						<form id="wpfp_options" method="post">
						<div id="icon-options-general" class="icon32"><br></div>
						<h2><a href="http://www.saiweb.co.uk">Saiweb</a> Flowplayer for Wordpress</h2>
						<h3>Like this plugin?</h3>
							A lot of development time and effort went into Flowplayer and this plugin, you can help support further development by purchasing a comercial license for flowplayer.
						<h3><a href="http://flowplayer.org/download/index.html?aff=100&src=saiweb_plugin&domain='.$_SERVER['SERVER_NAME'].'" target="_blank">Get a commercial license now!</a></h3>
						<h3>Please set your default player options below</h3>
						<table>
							<tr>
								<td>AutoPlay: </td>
								<td>
		 							<select name="autoplay">
										'.flowplayer::bool_select(flowplayer::_getautoplay()).'
		 							</select>
		 						</td>
							</tr>
							<tr>
								<td>Commercial License Key: </td>
								<td>
									<input type="text" size="20" name="key" id="key" value="'.flowplayer::_getkey().'" />	
									(Required for certain features i.e. custom logo)
								</td>
							</tr>
							<tr>
								<td>Auto Buffering:</td>
								<td><select name="autobuffer">'.flowplayer::bool_select(get_option('flowplayer_autobuffer')).'</select></td>
							</tr>
							<tr>
								<td><div id="colourpicker"></div></td>
								<td>
									'.flowplayer::flowplayer_colours().'
								</td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td>
									<input type="submit" name="submit" class="button-primary" value="Save Changes" />
								</td>
							</tr>
						</table>
						<input type="hidden" name="flowplayer_noncename" id="flowplayer_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />
						</form>
						div id="player" style="width:300px;height:200px;"></div>
					</div>


';
		return $html;
	}
}

?>